<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Offer</title>

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

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0 15px 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #007bff;
            background: #e9f2ff;
            outline: none;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
        }

        textarea {
            height: 120px;
            resize: vertical;
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

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* تأثير الحركة البسيطة عند التركيز */
        .focused {
            transform: scale(1.02);
        }
    </style>
</head>

<body>

<h2>Add New Offer</h2>

<form action="/Test_project/public/merchant/offers/create" method="POST">

    <input type="text" name="title" placeholder="Offer Title" required>

    <textarea name="description" placeholder="Offer Description"></textarea>

    <input type="text" name="discount_value" placeholder="Discount Value" required>

    <button type="submit">Add Offer</button>
</form>

<a href="/Test_project/public/merchant/dashboard">Back to Dashboard</a>

<script>
    // إضافة تأثير بسيط عند التركيز على العناصر
    const fields = document.querySelectorAll("input, textarea");

    fields.forEach(field => {
        field.addEventListener("focus", () => {
            field.classList.add("focused");
        });

        field.addEventListener("blur", () => {
            field.classList.remove("focused");
        });
    });
</script>

</body>
</html>
