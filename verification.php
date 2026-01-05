<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>التحقق من التوقيع</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>
<div class="container">
    <h2>التحقق من التوقيع</h2>

    <form action="../backend/upload_new_signature.php" method="POST">
        
        <!-- User ID (you must pass it to this page through URL or SESSION) -->
        <input type="hidden" name="applicant_id" value="<?php echo $_GET['id']; ?>">

        <!-- Signature type -->
        <input type="hidden" name="signature_type" value="new">

        <div class="form-group">
            <label>الرجاء إدخال توقيعك مرة أخرى للتحقق:</label>

            <canvas class="signature-pad" width="300" height="120"
                style="border:2px solid #000; background:#fff;"></canvas>

            <div style="margin-top:10px;">
                <button type="button" class="clear-signature">مسح التوقيع</button>
            </div>

            <input type="hidden" name="signature_image" class="signature-data">
        </div>

        <div class="buttons-container">
            <button type="submit" class="next">تحقق الآن</button>
        </div>

    </form>
</div>

<script src="main.js"></script>
</body>
</html>
