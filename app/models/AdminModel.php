<?php

require_once ROOT_PATH . "/app/config/database.php";

class AdminModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function login($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute([":email" => $email]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin["password_hash"])) {
            return $admin;
        }

        return false;
    }


    public function countTable($table)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAllCustomers()
    {
        $stmt = $this->conn->query("SELECT * FROM customers ORDER BY customer_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllMerchants()
    {
        $stmt = $this->conn->query("SELECT * FROM merchants ORDER BY merchant_id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getAllSubscriptions()
    {
        $query = "
            SELECT s.*, 
                   c.name AS customer_name, 
                   m.name AS merchant_name
            FROM subscriptions s
            LEFT JOIN customers c ON s.customer_id = c.customer_id
            LEFT JOIN merchants m ON s.merchant_id = m.merchant_id
            ORDER BY s.subscription_id DESC
        ";

        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
