<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once ROOT_PATH . "/app/models/OfferModel.php";
$model = new OfferModel();
$offers = $model->getAllOffers();

// Check if logged in + role
$isCustomer = isset($_SESSION['role']) && $_SESSION['role'] === "customer";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loyalty Program - Home</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .header {
            background: #007bff;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            text-align: center;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            color: #444;
        }

        .buttons a {
            text-decoration: none;
            padding: 12px 25px;
            margin: 10px;
            background: #007bff;
            color: white;
            border-radius: 6px;
            font-size: 18px;
            display: inline-block;
        }

        .buttons a:hover {
            background: #0056b3;
        }

        .offers-section {
            margin-top: 50px;
        }

        .offers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .offer-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-align: left;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .offer-card h3 {
            margin: 0 0 10px;
            color: #007bff;
        }

        .offer-card p {
            margin: 5px 0;
        }

        .redeem-btn {
            display: inline-block;
            padding: 10px 18px;
            background: #28a745;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 10px;
        }

        .redeem-btn:hover {
            background: #1e7e34;
        }

        footer {
            margin-top: 60px;
            background: #222;
            color: #ddd;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>Loyalty Program</h1>
    <p>Earn points, redeem rewards, and enjoy exclusive merchant offers.</p>
</div>

<div class="container">

    <div class="buttons">
        <a href="/Test_project/public/login">Login</a>
        <a href="/Test_project/public/select-user-type">Register</a>
        <a href="/Test_project/public/subscription/join">Subscriptions</a>
        <a href="/Test_project/public/admins/login">Admins</a>
    </div>

    <!-- Offers Section -->
    <div class="offers-section">
        <h2>🔥 Latest Offers</h2>

        <?php if (empty($offers)): ?>
            <p>No offers available yet.</p>
        <?php else: ?>
            <div class="offers-grid">
                <?php foreach ($offers as $offer): ?>
                    <div class="offer-card">
                        <h3><?= htmlspecialchars($offer['title']) ?></h3>

                        <p><?= nl2br(htmlspecialchars($offer['description'])) ?></p>

                        <p><strong>Discount:</strong> <?= htmlspecialchars($offer['discount_value']) ?></p>


                        <small><strong>Merchant ID:</strong> <?= $offer['merchant_id'] ?></small>

                        <?php if ($isCustomer): ?>
                            <!-- Customer logged in → redeem (Correct Route) -->
                         
                            <a class="redeem-btn" 
                           href="/Test_project/public/customer/redeem-offer?id=<?= $offer['offer_id'] ?>">
                            Use Offer
                            </a>

                        <?php else: ?>
                            <!-- Not logged in → redirect to login -->
                            <a class="redeem-btn" href="/Test_project/public/login">
                                Use Offer
                            </a>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<footer>
    <!-- &copy; <?= date("Y") ?>  -->
    Loyalty Program | All Rights Reserved
</footer>

</body>
</html>
