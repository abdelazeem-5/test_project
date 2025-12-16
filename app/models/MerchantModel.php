<?php

require_once ROOT_PATH . "/app/config/database.php";

class MerchantModel
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // حساب النقاط تلقائياً
    public function calculatePoints($amount)
    {
        // مثال: كل 1 جنيه = 5 نقاط
        return intval($amount * 5);
    }

    // إضافة النقاط للعميل
    public function addPoints($email, $points)
    {
        $query = "
            UPDATE customers
            SET points = points + :points
            WHERE email = :email
        ";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ":points" => $points,
            ":email" => $email
        ]);
    }
}
