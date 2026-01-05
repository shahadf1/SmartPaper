<?php
// SmartPaper/frontend/success.php
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تم إرسال الطلب</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form/style.css"> <!-- نعيد استخدام نفس الـ CSS -->
    <style>
        .success-box {
            text-align: center;
            padding: 40px 20px;
        }
        .success-box h2 {
            color: #2e7d32;
            margin-bottom: 20px;
        }
        .success-box p {
            font-size: 18px;
            margin-bottom: 25px;
        }
        .success-box a.button-link {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #000;
            background-color: #ffffff;
            text-decoration: none;
            color: #000;
            font-size: 16px;
        }
        .success-box a.button-link:hover {
            background-color: #7c7d7d;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="success-box">
        <h2>تم إرسال طلبك بنجاح ✅</h2>
        <p>
            تم حفظ بياناتك والتوقيع في النظام.<br>
            سيتم مراجعة الطلب من قبل الجهة المختصة.
        </p>
        <a href="form/index.php" class="button-link">عودة إلى نموذج إصدار الهوية</a>
    </div>
</div>
</body>
</html>
