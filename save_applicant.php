<?php
require_once "db.php";  // Connect to the database

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect form fields safely
    $fullName     = $_POST["fullName"] ?? "";
    $birthDate    = $_POST["birthDate"] ?? "";
    $nationalId   = $_POST["nationalId"] ?? "";
    $birthPlace   = $_POST["birthPlace"] ?? "";
    $gender       = $_POST["gender"] ?? "";
    $maritalStatus= $_POST["maritalStatus"] ?? "";
    $bloodType    = $_POST["bloodType"] ?? "";
    $education    = $_POST["education"] ?? "";
    $addressNumber= $_POST["addressNumber"] ?? "";
    $city         = $_POST["city"] ?? "";
    $district     = $_POST["district"] ?? "";
    $street       = $_POST["street"] ?? "";
    $phone        = $_POST["phone"] ?? "";
    $email        = $_POST["email"] ?? "";
    $fatherId     = $_POST["fatherId"] ?? "";
    $motherName   = $_POST["motherName"] ?? "";
    $motherNationality = $_POST["motherNationality"] ?? "";
    $motherId     = $_POST["motherId"] ?? "";

    // Insert into DB
    $sql = "INSERT INTO applicants 
    (fullName, birthDate, nationalId, birthPlace, gender, maritalStatus,
     bloodType, education, addressNumber, city, district, street,
     phone, email, fatherId, motherName, motherNationality, motherId)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "ssssssssssssssssss",
            $fullName, $birthDate, $nationalId, $birthPlace, $gender, $maritalStatus,
            $bloodType, $education, $addressNumber, $city, $district, $street,
            $phone, $email, $fatherId, $motherName, $motherNationality, $motherId
        );

        if ($stmt->execute()) {

            // Get the auto-generated applicant ID
            $applicantId = $stmt->insert_id;

            // Store in session so the second page can access it
            session_start();
            $_SESSION["applicant_id"] = $applicantId;

            // Redirect to signature page
            header("Location: ../frontend/form/Form-card.php");
            exit();

        } else {
            echo "Error saving data: " . $stmt->error;
        }

    } else {
        echo "Database prepare() failed.";
    }

} else {
    echo "Invalid request.";
}
?>
