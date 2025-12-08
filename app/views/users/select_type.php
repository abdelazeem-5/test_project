<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select User Type</title>

    <style>
        /* ====== FORM CONTAINER ====== */
        form {
            width: 320px;
            margin: 40px auto;
            padding: 20px 25px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }

        /* ====== HEADER ====== */
        h2 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            color: #333;
        }

        /* ====== RADIO LABELS ====== */
        label {
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
            border: 1px solid #ddd;
        }

        label:hover {
            background: #f5f5f5;
        }

        /* ====== HIGHLIGHT SELECTED ====== */
        .selected {
            background: #e8f0ff !important;
            border-color: #007bff !important;
        }

        /* ====== BUTTON ====== */
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
    </style>

</head>
<body>

<h2>Select User Type</h2>

<form method="POST">

    <label>
        <input type="radio" name="user_type" value="customer" checked>
        <span>Customer</span>
    </label>
    <br><br>

    <label>
        <input type="radio" name="user_type" value="merchant">
        <span>Merchant</span>
    </label>
    <br><br>

    <button type="submit">Continue</button>

</form>

<script>
    // تأثير تحديد الخيار المختار
    const labels = document.querySelectorAll("label");
    const radios = document.querySelectorAll("input[type='radio']");

    radios.forEach((radio, index) => {
        radio.addEventListener("change", () => {
            labels.forEach(label => label.classList.remove("selected"));
            labels[index].classList.add("selected");
        });
    });

    // تشغيل أول خيار تلقائياً
    labels[0].classList.add("selected");
</script>

</body>
</html>
