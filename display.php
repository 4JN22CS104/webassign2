<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$db_name = "vehicleRegistration";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize variables
$ownerName = $vehicleModel = $vehicleNumber = $registrationDate = $vehicleType = "";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerName = htmlspecialchars($_POST["ownerName"]);
    $vehicleModel = htmlspecialchars($_POST["vehicleModel"]);
    $vehicleNumber = htmlspecialchars($_POST["vehicleNumber"]);
    $registrationDate = htmlspecialchars($_POST["registrationDate"]);
    $vehicleType = htmlspecialchars($_POST["vehicleType"]);
    try {
        $stmt = $pdo->prepare("INSERT INTO reg (ownerName, vehicleModel, vehicleNumber, registrationDate, vehicleType)
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$ownerName, $vehicleModel, $vehicleNumber, $registrationDate, $vehicleType]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Error: Duplicate entry. <a href='index.html'>Try again</a>";
            exit();
        } else {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Vehicle Details</h1>
        <p><strong>Owner Name:</strong> <?= htmlspecialchars($ownerName) ?></p>
        <p><strong>Vehicle Model:</strong> <?= htmlspecialchars($vehicleModel) ?></p>
        <p><strong>Vehicle Number:</strong> <?= htmlspecialchars($vehicleNumber) ?></p>
        <p><strong>Registration Date:</strong> <?= htmlspecialchars($registrationDate) ?></p>
        <p><strong>Vehicle Type:</strong> <?= htmlspecialchars($vehicleType) ?></p>
        <a href="index.html" style="display: block; margin-top: 20px; text-align: center; color: #5cb85c;">Back to Form</a>
    </div>
</body>
</html>
