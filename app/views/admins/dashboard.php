<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: #ddd;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: white;
        }
        .content {
            padding: 30px;
        }
        .card-box {
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="row g-0">

    <div class="col-3 sidebar">
        <h3>Admin Panel</h3>
        <hr>

        <a href="/Test_project/public/admins/dashboard">🏠 Dashboard</a>
        <a href="/Test_project/public/admins/view_customers">👥 View Customers</a>
        <a href="/Test_project/public/admins/view_merchants">🛒 View Merchants</a>
        <a href="/Test_project/public/admins/view_subscriptions">📄 View Subscriptions</a>

        <!-- Logout يبقى كما طلبت: يرجع للهوم بيدج -->
        <a href="/Test_project/public">🚪 Logout</a>
    </div>

    <div class="col-9 content">
        <h2>Welcome, Admin!</h2>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card-box">
                    <h4>Total Customers</h4>
                    <p><?= $customerCount ?? 0 ?></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box">
                    <h4>Total Merchants</h4>
                    <p><?= $merchantCount ?? 0 ?></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box">
                    <h4>Active Subscriptions</h4>
                    <p><?= $subscriptionCount ?? 0 ?></p>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
