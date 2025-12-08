<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

        label {
            font-size: 16px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
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

        p {
            text-align: center;
            font-size: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: 0.2s;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Animation on focus */
        .focused {
            transform: scale(1.02);
        }
    </style>

</head>

<body>

<h2>Login</h2>

<form action="/Test_project/public/login" method="POST">

    <label>Email</label><br>
    <input type="email" name="email" placeholder="Enter your email" required><br>

    <label>Password</label><br>
    <input type="password" name="password" placeholder="Enter your password" required><br>

    <button type="submit">Login</button>
</form>

<br>

<p>
    Don't have an account?
    <a href="/Test_project/public/select-user-type">Create an account</a>
</p>

<script>
    // تأثير بسيط عند التركيز على أي input
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
