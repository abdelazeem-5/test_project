<?php
require_once __DIR__ . "/../config/database.php";

class SubscriptionModel
{
    private $conn;
    private $table = "subscriptions";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function createSubscription($customer_id, $tier = 'silver', $program_type = 'points_based')
{
    $deleteQuery = "DELETE FROM {$this->table} WHERE customer_id = :customer_id";
    $deleteStmt = $this->conn->prepare($deleteQuery);
    $deleteStmt->execute([":customer_id" => $customer_id]);

    $query = "INSERT INTO {$this->table} 
            (customer_id, tier, program_type, status)
            VALUES (:customer_id, :tier, :program_type, 'active')";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        ":customer_id" => $customer_id,
        ":tier" => $tier,
        ":program_type" => $program_type
    ]);
}


    public function getSubscriptionsByCustomer(int $customer_id): array
    {
        $query = "SELECT * FROM {$this->table} WHERE customer_id = :customer_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([":customer_id" => $customer_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateSubscription(int $subscription_id, ?string $tier = null, ?string $program_type = null): bool
    {
        $updates = [];
        $params = [":id" => $subscription_id];

        if ($tier !== null) {
            $updates[] = "tier = :tier";
            $params[":tier"] = $tier;
        }

        if ($program_type !== null) {
            $updates[] = "program_type = :program_type";
            $params[":program_type"] = $program_type;
        }

        if (empty($updates)) return false;

        $updateFields = implode(", ", $updates);

        $query = "UPDATE {$this->table} 
                  SET $updateFields 
                  WHERE subscription_id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute($params);
    }

    public function cancelSubscription(int $subscription_id): bool
    {
        $query = "UPDATE {$this->table} 
                  SET status = 'cancelled' 
                  WHERE subscription_id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([":id" => $subscription_id]);
    }

    public function getSubscriptionById(int $subscription_id): array|false
    {
        $query = "SELECT * FROM {$this->table} 
                  WHERE subscription_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $subscription_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



public function getSubscriptionByCustomerId($customerId)
{
    $query = "SELECT * FROM subscriptions 
              WHERE customer_id = :customer_id 
              LIMIT 1";

    $stmt = $this->conn->prepare($query);
    $stmt->execute([
        ":customer_id" => $customerId
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function deleteSubscription($id)
{
    $stmt = $this->conn->prepare("
        DELETE FROM subscriptions 
        WHERE subscription_id = :id
    ");

    return $stmt->execute([":id" => $id]);
}




public function deleteByCustomer($customerId)
{
    $stmt = $this->conn->prepare(
        "DELETE FROM subscriptions WHERE customer_id = ?"
    );
    return $stmt->execute([$customerId]);
}


}
