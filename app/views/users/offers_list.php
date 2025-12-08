<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Available Offers</title>
<style>
    body { font-family: Arial; background:#f4f6f9; padding:20px; }
    .offer-card {
        background:white; padding:15px; margin-bottom:15px;
        border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);
    }
    .btn {
        display:inline-block; background:#28a745; padding:8px 15px;
        color:white; text-decoration:none; border-radius:6px; margin-top:10px;
    }
</style>
</head>
<body>

<h2>Available Offers</h2>

<?php if (empty($offers)): ?>

    <p>No offers available now.</p>

<?php else: ?>

    <?php foreach ($offers as $offer): ?>
        <div class="offer-card">
            <h3><?= htmlspecialchars($offer['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($offer['description'])) ?></p>
            <strong><?= htmlspecialchars($offer['discount_value']) ?></strong><br>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === "customer"): ?>
                <a class="btn" href="/Test_project/public/customer/redeem-offer?id=<?= $offer['offer_id'] ?>">
                    Use Offer
                </a>
            <?php else: ?>
                <a class="btn" href="/Test_project/public/login">Use Offer</a>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>
