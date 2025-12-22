<?php

require_once ROOT_PATH . "/app/config/database.php";

class OfferModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function createOffer($merchant_id, $title, $description, $discount)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO offers (merchant_id, title, description, discount_value)
            VALUES (:merchant_id, :title, :description, :discount)
        ");

        return $stmt->execute([
            ":merchant_id" => $merchant_id,
            ":title"       => $title,
            ":description" => $description,
            ":discount"    => $discount
        ]);
    }


    public function getAllOffers()
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM offers
            ORDER BY created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOffersByMerchant(int $merchant_id): array
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM offers
            WHERE merchant_id = :merchant_id
            ORDER BY created_at DESC
        ");

        $stmt->execute([":merchant_id" => $merchant_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateOffer(int $offer_id, string $title, string $description, string $discount): bool
    {
        $stmt = $this->conn->prepare("
            UPDATE offers
            SET title = :title,
                description = :description,
                discount_value = :discount
            WHERE offer_id = :id
        ");

        return $stmt->execute([
            ":title"       => $title,
            ":description" => $description,
            ":discount"    => $discount,
            ":id"          => $offer_id
        ]);
    }


    public function deleteOffer(int $offer_id): bool
    {
        $stmt = $this->conn->prepare("
            DELETE FROM offers
            WHERE offer_id = :id
        ");

        return $stmt->execute([":id" => $offer_id]);
    }


    public function getOfferById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM offers
            WHERE offer_id = :id
            LIMIT 1
        ");

        $stmt->execute([":id" => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isOfferRedeemed($customer_id, $offer_id)
    {
        $stmt = $this->conn->prepare("
            SELECT id FROM customer_offers
            WHERE customer_id = :customer_id AND offer_id = :offer_id
            LIMIT 1
        ");

        $stmt->execute([
            ":customer_id" => $customer_id,
            ":offer_id"    => $offer_id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) 
        {
            return true;
        }
        return false;

    }

    public function logRedeem($customer_id, $offer_id)
    {
        if ($this->isOfferRedeemed($customer_id, $offer_id)) {
            return false;
        }

        $stmt = $this->conn->prepare("
            INSERT INTO customer_offers (customer_id, offer_id)
            VALUES (:customer_id, :offer_id)
        ");

        return $stmt->execute([
            ":customer_id" => $customer_id,
            ":offer_id"    => $offer_id
        ]);
    }


    public function getCustomerRedeemedOffers($customer_id)
{
    $stmt = $this->conn->prepare("
        SELECT o.title, o.description, o.discount_value, co.redeemed_at
        FROM customer_offers co
        JOIN offers o ON co.offer_id = o.offer_id
        WHERE co.customer_id = :customer_id
        ORDER BY co.redeemed_at DESC
    ");

    $stmt->execute([":customer_id" => $customer_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



public function deleteByMerchant(int $merchantId): bool
{
    $stmt = $this->conn->prepare(
        "DELETE FROM offers WHERE merchant_id = :id"
    );

    return $stmt->execute([":id" => $merchantId]);
}


}
