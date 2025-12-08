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

    // Create subscription (customer only - no merchant)
    public function createSubscription(int $customer_id, string $tier = 'silver', string $program_type = 'points_based'): bool
    {
        $query = "INSERT INTO {$this->table} 
                  (customer_id, tier, program_type) 
                  VALUES (:customer_id, :tier, :program_type)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":customer_id" => $customer_id,
            ":tier"        => $tier,
            ":program_type"=> $program_type
        ]);
    }

    // Get subscriptions for a customer
    public function getSubscriptionsByCustomer(int $customer_id): array
    {
        $query = "SELECT * FROM {$this->table} WHERE customer_id = :customer_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([":customer_id" => $customer_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update subscription (tier/program_type)
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

    // Cancel subscription
    public function cancelSubscription(int $subscription_id): bool
    {
        $query = "UPDATE {$this->table} 
                  SET status = 'cancelled' 
                  WHERE subscription_id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([":id" => $subscription_id]);
    }

    // Get a single subscription
    public function getSubscriptionById(int $subscription_id): array|false
    {
        $query = "SELECT * FROM {$this->table} 
                  WHERE subscription_id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $subscription_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
