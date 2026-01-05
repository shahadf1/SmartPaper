<?php
session_start();
require_once "db.php";

if (!isset($_POST["signature_image"]) || !isset($_POST["applicant_id"])) {
    die("خطأ: لم يتم استلام البيانات بشكل صحيح.");
}
var_dump($_POST["applicant_id"]);

$applicantId = intval($_POST["applicant_id"]);
$signatureBase64 = $_POST["signature_image"];
$signatureType = "new"; // <-- VERY IMPORTANT

if (empty($signatureBase64)) {
    die("لم يتم التقاط التوقيع. يرجى المحاولة مرة أخرى.");
}

$signatureBase64 = str_replace("data:image/png;base64,", "", $signatureBase64);
$signatureBase64 = str_replace(" ", "+", $signatureBase64);
$decodedImage = base64_decode($signatureBase64);

$signatureDir = "../uploads/signatures/";
if (!is_dir($signatureDir)) {
    mkdir($signatureDir, 0777, true);
}

$signatureFilename = "signature_" . $applicantId . "_" . time() . ".png";
$signaturePath = $signatureDir . $signatureFilename;

file_put_contents($signaturePath, $decodedImage);

$sql = "INSERT INTO signatures (applicant_id, signature_path, signature_type)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $applicantId, $signatureFilename, $signatureType);

if ($stmt->execute()) {
    header("Location: verify_signature.php?applicant_id=" . $applicantId);
    exit();
} else {
    echo "Database Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
