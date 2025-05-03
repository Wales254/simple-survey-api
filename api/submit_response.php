<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$host = 'localhost';
$db = 'sky_survey_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullName = $_POST['fullName'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $email = $_POST['email'] ?? ''; // sent from frontend
        $description = $_POST['description'] ?? '';
        $stack = $_POST['stack'] ?? '';
        $submittedAt = date('Y-m-d H:i:s');

        $filePath = '';
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = basename($_FILES['file']['name']);
            $filePath = $uploadDir . time() . '_' . $filename;
            move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
        }

        // Adjusted to match DB schema
        $stmt = $pdo->prepare("INSERT INTO responses (full_name, gender, email_address, description, programming_stack, file_path, submitted_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fullName, $gender, $email, $description, $stack, $filePath, $submittedAt]);

        echo json_encode(['message' => 'Response submitted successfully']);
    } else {
        echo json_encode(['error' => 'Invalid request method']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
