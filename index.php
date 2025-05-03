<?php
// Simple API Routing
$request = $_SERVER['REQUEST_URI'];

if ($request === '/survey-api/api/questions.php') {
    include('api/questions.php');
} elseif ($request === '/survey-api/api/responses.php') {
    include('api/responses.php');
} else {
    echo json_encode(['message' => 'Not Found']);
}
?>
