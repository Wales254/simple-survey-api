<?php
// download.php

include('../config.php');

// Set headers to force download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="survey_responses.csv"');

$output = fopen('php://output', 'w');

// CSV column headers
fputcsv($output, ['ID', 'Name', 'Email', 'Description', 'Stack', 'File Path', 'Submitted At']);

// Fetch data from the database
$stmt = $pdo->query("SELECT * FROM responses");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [
        $row['id'] ?? '',
        $row['name'] ?? '',
        $row['email'] ?? '',
        $row['description'] ?? '',
        $row['stack'] ?? '',
        $row['file_path'] ?? '',
        $row['submitted_at'] ?? ''
    ]);
}

fclose($output);
exit;
