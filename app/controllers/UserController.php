<?php
require_once ROOT_PATH . "/app/models/UserModel.php";
require_once ROOT_PATH . "/app/models/OfferModel.php";

class UserController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function selectUserType()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $userType = $_POST['user_type'] ?? 'customer';

            if ($userType === 'merchant') {
                header("Location: /Test_project/public/register-merchant");
            } else {
                header("Location: /Test_project/public/register-customer");
            }
            exit;
        }

        require ROOT_PATH . "/app/views/users/select_type.php";
    }

    public function registerCustomer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$name || !$email || !$password) {
                echo "All fields are required!";
                return;
            }

            $model = new UserModel("customer");
            $success = $model->register($name, $email, $password);

            if ($success) {
                header("Location: /Test_project/public/");
                exit;
            } else {
                echo "Customer registration failed.";
            }
        } 
        else 
        {
            require ROOT_PATH . "/app/views/users/register_customer.php";
        }
    }

    public function registerMerchant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $name     = $_POST['name'] ?? null;
            $email    = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$name || !$email || !$password) {
                echo "All fields are required!";
                return;
            }

            $model = new UserModel("merchant");
            $success = $model->register($name, $email, $password);

            if ($success) {
                header("Location: /Test_project/public/");
                exit;
            }

            echo "Merchant registration failed.";
        } 
        else 
        {
            require ROOT_PATH . "/app/views/users/register_merchant.php";
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Try Customer
            $customerModel = new UserModel("customer");
            $customer = $customerModel->login($email, $password);

            if ($customer) {

                $_SESSION['user'] = [
                    "customer_id" => $customer["customer_id"],
                    "name"        => $customer["name"],
                    "email"       => $customer["email"]
                ];

                $_SESSION['role'] = "customer";

                header("Location: /Test_project/public/");
                exit;
            }

            // Try Merchant
            $merchantModel = new UserModel("merchant");
            $merchant = $merchantModel->login($email, $password);

            if ($merchant) {

                $_SESSION['user'] = [
                    "merchant_id" => $merchant["merchant_id"],
                    "name"        => $merchant["name"],
                    "email"       => $merchant["email"]
                ];

                $_SESSION['role'] = "merchant";

                header("Location: /Test_project/public/merchant/dashboard");
                exit;
            }

            echo "Invalid credentials!";
        }
        else 
        {
            require ROOT_PATH . "/app/views/users/login.php";
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /Test_project/public/");
        exit;
    }

    public function customerHome()
    {
        echo "This page is disabled.";
    }

    public function redeemOffer()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
            echo "Not authorized — Customers only.";
            return;
        }

        // إصلاح: إجبار وجود offer id
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "Offer ID missing.";
            return;
        }

        $offer_id = $_GET['id'];

        $model = new OfferModel();
        $offer = $model->getOfferById($offer_id);

        if (!$offer) {
            echo "Offer not found.";
            return;
        }

        require ROOT_PATH . "/app/views/users/receipt.php";
    }
}
