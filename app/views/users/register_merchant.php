<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Registration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            font-size: 26px;
            color: #333;
            margin-top: 50px;
            margin-bottom: 20px;
        }
        form {
            width: 350px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }
        input:focus {
            border-color: #007bff;
            background: #e9f2ff;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
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
        .focused {
            transform: scale(1.02);
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
        }
    </style>

</head>

<body>

<h2>Merchant Registration</h2>

<form action="/Test_project/public/register-merchant" method="POST">
    <input type="text" name="name" placeholder="Merchant Name" required>
    <input type="email" name="email" placeholder="Business Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Register Merchant</button>
</form>

<script>
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
