<?php
require_once "db.php";

// -------------------------
// 1. Get Applicant ID
// -------------------------
$applicantId = intval($_GET["applicant_id"]);

// -------------------------
// 2. Get Reference Signature
// -------------------------
$sql = "SELECT signature_path FROM signatures 
        WHERE applicant_id = ? AND signature_type='reference'
        ORDER BY id ASC LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicantId);
$stmt->execute();
$stmt->bind_result($referenceSignature);
$stmt->fetch();
$stmt->close();

if (!$referenceSignature) {
    die("لم يتم العثور على توقيع مرجعي.");
}

// -------------------------
// 3. Get Latest New Signature
// -------------------------
$sql2 = "SELECT signature_path FROM signatures 
         WHERE applicant_id = ? AND signature_type='new'
         ORDER BY id DESC LIMIT 1";

$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $applicantId);
$stmt2->execute();
$stmt2->bind_result($newSignature);
$stmt2->fetch();
$stmt2->close();

if (!$newSignature) {
    die("لم يتم العثور على توقيع جديد للتحقق.");
}

// -------------------------
// 4. Call Python Model
// -------------------------
$python = "C:/Users/lojai/AppData/Local/Programs/Python/Python312/python.exe";
$script = "../ml/verify.py";

$refPath = realpath("../uploads/signatures/" . $referenceSignature);
$newPath = realpath("../uploads/signatures/" . $newSignature);

$command = escapeshellcmd("$python $script \"$refPath\" \"$newPath\"");
$output = shell_exec($command);

$prob = floatval($output);

// -------------------------
// 5. Show Result
// -------------------------
if ($prob >= 0.5) {
    echo "<h2 style='color:green; text-align:center;'>✔ التوقيع حقيقي</h2>";
} else {
    echo "<h2 style='color:red; text-align:center;'>✘ التوقيع مزور</h2>";
}

echo "<p style='text-align:center;'>Probability: $prob</p>";
