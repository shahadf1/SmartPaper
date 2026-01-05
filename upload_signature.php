<?php
session_start();
require_once "db.php";   // Database connection

// -------------------------------
// 1. Validate request
// -------------------------------
if (!isset($_POST["signature_image"]) || !isset($_POST["applicant_id"])) {
    die("خطأ: لم يتم استلام البيانات بشكل صحيح.");
}

$applicantId = intval($_POST["applicant_id"]);
$signatureBase64 = $_POST["signature_image"];

// Check if signature is empty
if (empty($signatureBase64)) {
    die("لم يتم التقاط التوقيع. يرجى المحاولة مرة أخرى.");
}

// -------------------------------
// 2. Clean Base64 string
// -------------------------------
$signatureBase64 = str_replace("data:image/png;base64,", "", $signatureBase64);
$signatureBase64 = str_replace(" ", "+", $signatureBase64);
$decodedImage = base64_decode($signatureBase64);

if (!$decodedImage) {
    die("فشل في فك تشفير الصورة.");
}

// -------------------------------
// 3. Save PNG file
// -------------------------------
$signatureDir = "../uploads/signatures/";

if (!is_dir($signatureDir)) {
    mkdir($signatureDir, 0777, true);
}

// File name format: signature_12.png
$signatureFilename = "signature_" . $applicantId . "_" . time() . ".png";
$signaturePath = $signatureDir . $signatureFilename;

file_put_contents($signaturePath, $decodedImage);

// -------------------------------
// 4. Insert into database
// -------------------------------
$sql = "INSERT INTO signatures (applicant_id, signature_path) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $applicantId, $signatureFilename);

if ($stmt->execute()) {
    // Success!
    header("Location: ../frontend/verification.php?id=$applicantId");
    exit();
} else {
    echo "Database Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
