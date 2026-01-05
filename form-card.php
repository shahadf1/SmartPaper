<?php
session_start();

// Ensure user came from step 1
if (!isset($_SESSION["applicant_id"])) {
    echo "لا يمكن الوصول إلى هذه الصفحة مباشرة.";
    exit();
}

$applicantId = $_SESSION["applicant_id"];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>استلام الهوية - التوقيع</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
    <h2>استكمال طلب الهوية</h2>

    <form action="/smart-paper/backend/upload_signature.php" method="POST">

        <!-- Hidden applicant ID -->
        <input type="hidden" name="applicant_id" value="<?php echo $applicantId; ?>">

        <fieldset>
            <legend><h2>ثانياً: التوقيع</h2></legend>

            <div class="grid">

                <div class="form-group">
                    <label>الاسم:</label>
                    <input type="text" name="receiver_name">
                </div>

                <div class="form-group">
                    <label>التاريخ:</label>
                    <input type="date" name="receiver_date">
                </div>

                <div class="form-group">
                    <label>التوقيع:</label>

                    <canvas class="signature-pad" width="300" height="100"
                        style="border:2px solid #000; background:#fff;"></canvas>

                    <div style="margin-top:10px;">
                        <button type="button" class="clear-signature">مسح التوقيع</button>
                    </div>

                    <!-- THIS FIELD will contain Base64 PNG -->
                    <input type="hidden" name="signature_image" class="signature-data">
                </div>

            </div>

            <div class="buttons-container">
                <button type="submit" class="next">إرسال التوقيع</button>
            </div>

        </fieldset>
    </form>
</div>

<script src="main.js"></script>
</body>
</html>
