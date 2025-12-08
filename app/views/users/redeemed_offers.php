<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redeemed Offers</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f4f6f9; 
            margin: 0; 
            padding: 20px; 
        }
        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: auto;
        }
        .offer-card {
            background: #fff;
            padding: 20px;
            margin-bottom: 18px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-left: 6px solid #28a745;
            transition: 0.3s;
        }
        .offer-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }
        h3 {
            margin-top: 0;
            color: #007bff;
        }
        p {
            margin: 6px 0;
            color: #444;
        }
        .discount {
            font-weight: bold;
            color: #28a745;
        }
        .date {
            font-size: 14px;
            color: #777;
        }
        .no-offers {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>
<body>

<h2>Your Redeemed Offers</h2>

<div class="container">

<?php $offers = $offers ?? []; ?>

<?php if (empty($offers)): ?>
    <p class="no-offers">You have not redeemed any offers yet.</p>
<?php else: ?>
    <?php foreach ($offers as $offer): ?>
        <div class="offer-card">
            <h3><?= htmlspecialchars($offer['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($offer['description'])) ?></p>
            <p class="discount">
                Discount: <?= htmlspecialchars($offer['discount_value']) ?>
            </p>
            <p class="date">
                Redeemed at: <?= htmlspecialchars($offer['redeemed_at'] ?? '') ?>
            </p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</div>

</body>
</html>
