<?php if (!isset($offer) || !$offer): ?>
    <p style="text-align:center; color:red; font-size:20px;">
        Offer not found.
    </p>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Offer Receipt</title>
<style>
    body { font-family: Arial; background: #f5f5f5; text-align:center; padding:40px; }
    .receipt {
        background:white; padding:25px; width:400px; margin:auto;
        box-shadow:0 0 10px rgba(0,0,0,0.1); border-radius:8px;
    }
    h2 { color:#007bff; }
    .btn {
        display:inline-block; padding:10px 20px; background:#007bff;
        color:white; border-radius:6px; margin-top:20px; text-decoration:none;
    }
</style>
</head>
<body>

<div class="receipt">
    <h2>Offer Details</h2>

    <p><strong>Offer:</strong> <?= htmlspecialchars($offer['title']) ?></p>
    <p><?= nl2br(htmlspecialchars($offer['description'])) ?></p>
    <p><strong>Discount:</strong> <?= htmlspecialchars($offer['discount_value']) ?></p>

    <hr>
    <p>📍 Please visit the nearest branch to apply the discount.</p>

    <a class="btn" href="/Test_project/public/">Return Home</a>
</div>

</body>
</html>
<?php endif; ?>
