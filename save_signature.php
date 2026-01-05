<?php
require_once "../config/db.php";

// Collect inputs
$applicantId = $_POST['applicant_id'];
$receiverName = $_POST['receiverName'];
$submitDate = $_POST['submitDate'];
$signatureBase64 = $_POST['applicant_signature'];

if (!$signatureBase64) {
    die("Signature is empty.");
}

// Decode base64 -> PNG
$signatureData = str_replace("data:image/png;base64,", "", $signatureBase64);
$signatureData = base64_decode($signatureData);

// Create folder if not exists
$folder = "../uploads/signatures/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// File name
$signaturePath = $folder . "user_" . $applicantId . "_genuine.png";

// Save PNG
file_put_contents($signaturePath, $signatureData);

// Insert request into database
$stmt = $pdo->prepare("
    INSERT INTO requests (user_id, receiver_name, submit_date)
    VALUES (:uid, :rname, :sdate)
");
$stmt->execute([
    ':uid' => $applicantId,
    ':rname' => $receiverName,
    ':sdate' => $submitDate
]);

// Success
echo "<h2>تم حفظ التوقيع بنجاح!</h2>";
echo "<p>الآن لديك توقيع مرجعي لهذا المستخدم.</p>";
echo "<p>يمكنك التحقق من صحة أي توقيع جديد باستخدام نموذج التحقق.</p>";
?>
