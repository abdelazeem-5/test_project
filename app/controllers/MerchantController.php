<?php

require_once ROOT_PATH . "/app/models/MerchantModel.php";

class MerchantController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        require ROOT_PATH . "/app/views/merchants/dashboard.php";
    }

    public function purchase()
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['customer_email'];
            $amount = (float)$_POST['amount'];

            $model = new MerchantModel();
            $points = $model->calculatePoints($amount);

            $success = $model->addPoints($email, $points);

            echo $success 
                ? "Purchase recorded. Added $points points automatically!"
                : "Failed to add points. Customer not found.";

        } else {
            require ROOT_PATH . "/app/views/merchants/purchase.php";
        }
    }

    public function offers()
    {
        require ROOT_PATH . "/app/views/merchants/create_offer.php";
    }

    public function createOffer()
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            require_once ROOT_PATH . "/app/models/OfferModel.php";
            $model = new OfferModel();

            $title       = $_POST['title'];
            $description = $_POST['description'];
            $discount    = $_POST['discount_value'];

            $success = $model->createOffer($_SESSION['user']['merchant_id'], $title, $description, $discount);

            if ($success) {
                header("Location: /Test_project/public/merchant/offers");
                exit;
            }

            echo "Failed to add offer!";
            return;
        }

        require ROOT_PATH . "/app/views/merchants/create_offer.php";
    }

    public function editOffers()
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        require_once ROOT_PATH . "/app/models/OfferModel.php";
        $model = new OfferModel();

        $offers = $model->getOffersByMerchant($_SESSION['user']['merchant_id']);

        require ROOT_PATH . "/app/views/merchants/edit_offers.php";
    }

    public function editOfferById($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        require_once ROOT_PATH . "/app/models/OfferModel.php";
        $model = new OfferModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title       = $_POST['title'];
            $description = $_POST['description'];
            $discount    = $_POST['discount_value'];

            $success = $model->updateOffer($id, $title, $description, $discount);

            if ($success) {
                header("Location: /Test_project/public/merchant/offers/edit-list");
                exit;
            }

            echo "Failed to update offer!";
            return;
        }

        // GET → show edit form
        $offer = $model->getOfferById($id);

        // إصلاح: إرسال offer بشكل صريح إلى الـ view
        require ROOT_PATH . "/app/views/merchants/edit_offers.php";
    }

    public function deleteOffers()
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        require_once ROOT_PATH . "/app/models/OfferModel.php";
        $model = new OfferModel();

        $offers = $model->getOffersByMerchant($_SESSION['user']['merchant_id']);

        require ROOT_PATH . "/app/views/merchants/delete_offers.php";
    }

    public function deleteOfferById($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'merchant') {
            echo "Not authorized!";
            return;
        }

        require_once ROOT_PATH . "/app/models/OfferModel.php";
        $model = new OfferModel();

        $success = $model->deleteOffer($id);

        echo $success ? "Offer Deleted Successfully!" : "Failed to delete offer!";
    }
}
