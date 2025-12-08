<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            font-size: 28px;
            margin-top: 40px;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 450px;
            margin: 30px auto;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 15px 0;
        }

        a {
            display: block;
            padding: 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 17px;
            transition: 0.3s;
        }

        a:hover {
            background: #0056b3;
        }

        /* Special styling for logout */
        .logout {
            background: #dc3545;
        }

        .logout:hover {
            background: #b52a36;
        }
    </style>
</head>

<body>

<h2>Merchant Dashboard</h2>

<div class="container">

    <p>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</p>

    <ul>

        <li>
            <a href="/Test_project/public/merchant/purchase">
                ➤ Record Purchase
            </a>
        </li>

        <li>
            <a href="/Test_project/public/merchant/offers/create">
                ➤ Add Offers
            </a>
        </li>

        <li>
            <a href="/Test_project/public/merchant/offers/edit-list">
                ➤ Update Offers
            </a>
        </li>

        <li>
            <a href="/Test_project/public/merchant/offers/delete-list">
                ➤ Delete Offers
            </a>
        </li>

        <li>
            <a href="/Test_project/public" class="logout">
                ➤ Logout
            </a>
        </li>

    </ul>

</div>

</body>
</html>
