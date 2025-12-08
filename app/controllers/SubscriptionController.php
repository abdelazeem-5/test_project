<?php

require_once ROOT_PATH . "/app/models/SubscriptionModel.php";

class SubscriptionController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // -----------------------------------------------------------
    // Join subscription (Customer only)
    // -----------------------------------------------------------
    public function join()
    {
        // لازم يكون كاستمر عامل لوجين
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
            // ممكن نعيد توجيهه للوجين
            header("Location: /Test_project/public/login");
            exit;
        }

        // نجيب الـ customer_id من السيشن
        $customer_id = $_SESSION['user']['customer_id'] ?? null;

        if ($customer_id === null) {
            echo "Customer ID not found in session.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            // tier & program_type من الفورم
            $tier         = $_POST['tier']         ?? 'silver';
            $program_type = $_POST['program_type'] ?? 'points_based';

            $model = new SubscriptionModel();
            $success = $model->createSubscription($customer_id, $tier, $program_type);

            if ($success) {

                if ($program_type === 'points_based') {
                    header("Location: /Test_project/public/subscription/points");
                    exit;
                }

                if ($program_type === 'value_based') {
                    header("Location: /Test_project/public/subscription/value");
                    exit;
                }

                // لو نوع غير معروف (احتياط)
                header("Location: /Test_project/public/");
                exit;

            } else {
                echo "Subscription Failed";
            }

        } 
        else 
        {
            // GET → عرض صفحة الاشتراك
            require ROOT_PATH . "/app/views/subscriptions/join.php";
        }
    }

    // -----------------------------------------------------------
    // Cancel subscription
    // -----------------------------------------------------------
    public function cancel($id)
    {
        $model = new SubscriptionModel();
        $success = $model->cancelSubscription((int)$id);

        echo $success ? "Subscription Cancelled" : "Cancel Failed";
    }

    // -----------------------------------------------------------
    // List subscriptions for a customer
    // -----------------------------------------------------------
    public function mySubscriptions($customer_id)
    {
        $model = new SubscriptionModel();
        $subs = $model->getSubscriptionsByCustomer((int)$customer_id);

        echo "<pre>";
        print_r($subs);
        echo "</pre>";
    }

    // -----------------------------------------------------------
    // Upgrade subscription (مثال ثابت)
    // -----------------------------------------------------------
    public function upgrade($id)
    {
        $model = new SubscriptionModel();
        $success = $model->updateSubscription((int)$id, 'gold', null);

        echo $success ? "Tier Upgraded to Gold" : "Upgrade Failed";
    }
}
