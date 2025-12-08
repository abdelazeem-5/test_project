<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Purchase</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        form {
            width: 90%;
            max-width: 380px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        label {
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0 18px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #007bff;
            background: #e9f2ff;
            outline: none;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        /* Focus animation */
        .focused {
            transform: scale(1.02);
        }
    </style>

</head>

<body>

<h2>Record Purchase (Auto Points)</h2>

<form action="/Test_project/public/merchant/purchase" method="POST">

    <label>Customer Email:</label><br>
    <input type="email" name="customer_email" required>

    <label>Purchase Amount (EGP):</label><br>
    <input type="number" step="0.01" name="amount" required>

    <button type="submit">Submit Purchase</button>

</form>

<script>
    // تأثير جميل عند التركيز على الحقول
    const inputs = document.querySelectorAll("input");

    inputs.forEach(input => {
        input.addEventListener("focus", () => {
            input.classList.add("focused");
        });

        input.addEventListener("blur", () => {
            input.classList.remove("focused");
        });
    });
</script>

</body>
</html>
