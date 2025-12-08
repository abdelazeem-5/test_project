<?php
require_once ROOT_PATH . "/app/config/database.php";

class UserModel
{
    private $conn;
    private $table;

    public function __construct(string $userType)
    {
        $db = new Database();
        $this->conn = $db->connect();

        // اختيار الجدول بناءً على نوع المستخدم
        $this->table = match ($userType) {
            'customer' => 'customers',
            'merchant' => 'merchants',
            'admin'    => 'admins',
            default    => throw new Exception("Invalid user type: $userType"),
        };
    }

    // تسجيل مستخدم جديد
    public function register(string $name, string $email, string $password): bool
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO {$this->table} (name, email, password_hash)
                      VALUES (:name, :email, :password_hash)";
            
            $stmt = $this->conn->prepare($query);

            return $stmt->execute([
                ":name"          => htmlspecialchars($name),
                ":email"         => htmlspecialchars($email),
                ":password_hash" => $hash,
            ]);
        } 
        catch (PDOException $e) {
            // لو الإيميل متكرر أو أي خطأ
            return false;
        }
    }

    // تسجيل الدخول
    public function login(string $email, string $password)
    {
        try {
            $query = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
            $stmt  = $this->conn->prepare($query);
            $stmt->execute([":email" => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                return $user;
            }

            return false;
        }
        catch (PDOException $e) {
            return false;
        }
    }
}
