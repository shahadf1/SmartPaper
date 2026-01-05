<?php

header("Content-Type: application/json");

// 1. Read POST data
$applicant_id = $_POST["applicant_id"] ?? null;
$new_signature_path = $_POST["new_signature_path"] ?? null;

if (!$applicant_id || !$new_signature_path) {
    echo json_encode(["error" => "Missing parameters"]);
    exit;
}

// 2. Path to the stored signature (first signature saved by the applicant)
$stored_signature = "../uploads/signatures/applicant/signature_" . $applicant_id . ".png";

// 3. Path to the new signature submitted from the form
$new_signature = "../uploads/signatures/temp/" . $new_signature_path;

// 4. Build the command to run Python verification
$cmd = 'python ../ml/inference.py "' . $stored_signature . '" "' . $new_signature . '"';

// 5. Execute the model
$prob = shell_exec($cmd);

if ($prob === null) {
    echo json_encode(["error" => "Python execution failed"]);
    exit;
}

$prob = floatval($prob);

// 6. Decide genuine or forged
$status = ($prob > 0.70) ? "genuine" : "forged";

// 7. Return response
echo json_encode([
    "probability" => $prob,
    "status" => $status
]);

?>
