<?php

require_once ROOT_PATH . "/app/models/AdminModel.php";

class AdminController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $model = new AdminModel();
            $admin = $model->login($email, $password);

            if ($admin) {
                $_SESSION['admin'] = $admin;

                header("Location: /Test_project/public/admins/dashboard");
                exit;
            }

            echo "Invalid admin credentials!";
        } 
        else {
            require ROOT_PATH . "/app/views/admins/login.php";
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /Test_project/public/admins/login");
            exit;
        }

        $model = new AdminModel();

        $customerCount      = $model->countTable("customers");
        $merchantCount      = $model->countTable("merchants");
        $subscriptionCount  = $model->countTable("subscriptions");

        require ROOT_PATH . "/app/views/admins/dashboard.php";
    }

    public function viewCustomers()
    {
        if (!isset($_SESSION['admin'])) {
            echo "Not authorized!";
            return;
        }

        $model = new AdminModel();
        $customers = $model->getAllCustomers();

        require ROOT_PATH . "/app/views/admins/view_customers.php";
    }

    public function viewMerchants()
    {
        if (!isset($_SESSION['admin'])) {
            echo "Not authorized!";
            return;
        }

        $model = new AdminModel();
        $merchants = $model->getAllMerchants();

        require ROOT_PATH . "/app/views/admins/view_merchants.php";
    }

    public function viewSubscriptions()
    {
        if (!isset($_SESSION['admin'])) {
            echo "Not authorized!";
            return;
        }

        $model = new AdminModel();
        $subscriptions = $model->getAllSubscriptions();

        require ROOT_PATH . "/app/views/admins/view_subscriptions.php";
    }
}
