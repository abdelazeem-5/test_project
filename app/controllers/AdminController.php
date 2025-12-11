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

    /* ============================
       ADMIN LOGIN
    ============================= */
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

    /* ============================
       ADMIN DASHBOARD
    ============================= */
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

    /* ============================
       VIEW CUSTOMERS
    ============================= */
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

    /* ============================
       VIEW MERCHANTS
    ============================= */
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

    /* ============================
       VIEW SUBSCRIPTIONS
    ============================= */
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

    /* ============================
       VIEW OFFERS
    ============================= */
    public function getAllOffers()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /Test_project/public/admins/login");
            exit;
        }

        require_once ROOT_PATH . "/app/models/OfferModel.php";
        $model = new OfferModel();

        $offers = $model->getAllOffers();

        require ROOT_PATH . "/app/views/admins/view_offers.php";
    }

    /* ============================
       DELETE CUSTOMER
    ============================= */
    public function deleteCustomer()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /Test_project/public/admins/login");
            exit;
        }

        if (!isset($_GET['id'])) die("Missing ID");

        $id = (int)$_GET['id'];

        require_once ROOT_PATH . "/app/models/UserModel.php";
        $model = new UserModel("customer");
        $model->deleteCustomer($id);

        header("Location: /Test_project/public/admins/view_customers");
        exit;
    }

    /* ============================
       DELETE MERCHANT
    ============================= */
    public function deleteMerchant()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /Test_project/public/admins/login");
            exit;
        }

        if (!isset($_GET['id'])) die("Missing ID");

        $id = (int)$_GET['id'];

        require_once ROOT_PATH . "/app/models/UserModel.php";
        $model = new UserModel("merchant");
        $model->deleteMerchant($id);

        header("Location: /Test_project/public/admins/view_merchants");
        exit;
    }

    /* ============================
       DELETE OFFER
    ============================= */
    public function deleteOffer()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /Test_project/public/admins/login");
            exit;
        }

        if (!isset($_GET['id'])) die("Missing ID");

        $id = (int)$_GET['id'];

        require_once ROOT_PATH . "/app/models/OfferModel.php";
        $model = new OfferModel();
        $model->deleteOffer($id);

        header("Location: /Test_project/public/admins/view_offers");
        exit;
    }

    /* ============================
       DELETE SUBSCRIPTION
    ============================= */
    public function deleteSubscription()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /Test_project/public/admins/login");
            exit;
        }

        if (!isset($_GET['id'])) die("Missing ID");

        $id = (int)$_GET['id'];

        require_once ROOT_PATH . "/app/models/SubscriptionModel.php";
        $model = new SubscriptionModel();
        $model->deleteSubscription($id);

        header("Location: /Test_project/public/admins/view_subscriptions");
        exit;
    }
}
