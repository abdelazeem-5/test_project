<?php
// تأكد أن متغير $merchants موجود من AdminController
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Merchants</title>
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">All Merchants</h2>

    <?php if (empty($merchants)): ?>
        <div class="alert alert-warning">No merchants found.</div>
    <?php else: ?>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($merchants as $m): ?>
                <tr>
                    <td><?= $m['merchant_id'] ?></td>
                    <td><?= htmlspecialchars($m['name']) ?></td>
                    <td><?= htmlspecialchars($m['email']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <a href="/Test_project/public/admins/dashboard" class="btn btn-secondary mt-3">← Back</a>
</div>

</body>
</html>
