<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Subscription</title>

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
            margin-bottom: 10px;
        }

        p.info {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }

        form {
            width: 90%;
            max-width: 360px;
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

        select {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        select:focus {
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

        .focused {
            transform: scale(1.02);
        }
    </style>

</head>

<body>

<h2>Join Subscription</h2>
<p class="info">Choose your tier and program type. This subscription is linked to your customer account.</p>

<form action="/Test_project/public/subscription/join" method="POST">

    <label for="tier">Tier:</label>
    <select name="tier" id="tier">
        <option value="silver">Silver</option>
        <option value="gold">Gold</option>
        <option value="platinum">Platinum</option>
    </select>

    <label for="program_type">Program Type:</label>
    <select name="program_type" id="program_type">
        <option value="points_based">Points Based</option>
        <option value="value_based">Value Based</option>
    </select>

    <button type="submit">Create Subscription</button>
</form>

<script>
    const elements = document.querySelectorAll("select");

    elements.forEach(el => {
        el.addEventListener("focus", () => {
            el.classList.add("focused");
        });

        el.addEventListener("blur", () => {
            el.classList.remove("focused");
        });
    });
</script>

</body>
</html>
