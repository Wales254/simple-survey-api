<?php
// Connect to the database
$host = "localhost";
$dbname = "sky_survey_db"; // <- replace with your DB name
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle filters
$whereClauses = [];
$params = [];

if (isset($_GET['programming_stack']) && !empty($_GET['programming_stack'])) {
    $whereClauses[] = "programming_stack LIKE :programming_stack";
    $params[':programming_stack'] = '%' . $_GET['programming_stack'] . '%';
}

if (isset($_GET['gender']) && !empty($_GET['gender'])) {
    $whereClauses[] = "gender = :gender";
    $params[':gender'] = $_GET['gender'];
}

// Build the WHERE clause if any filters are applied
$whereSql = '';
if (count($whereClauses) > 0) {
    $whereSql = 'WHERE ' . implode(' AND ', $whereClauses);
}

// Fetch filtered responses
$sql = "SELECT * FROM responses $whereSql ORDER BY submitted_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$responses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Submitted Responses</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background:rgb(245, 245, 245);
      padding: 30px;
    }
    h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #333;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .container {
      max-width: 1000px;
      margin: 0 auto;
    }
    .filter-form {
      text-align: center;
      margin-bottom: 20px;
    }
    .filter-form select {
      padding: 8px;
      margin: 5px;
      font-size: 16px;
    }
    .filter-form input[type="text"] {
      padding: 8px;
      margin: 5px;
      font-size: 16px;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Submitted Survey Responses</h2>

  <!-- Filter Form -->
  <div class="filter-form">
    <form method="GET" action="">
      <input type="text" name="programming_stack" placeholder="Filter by Programming Stack" value="<?= htmlspecialchars($_GET['programming_stack'] ?? '') ?>">
      <select name="gender">
        <option value="">Select Gender</option>
        <option value="Male" <?= isset($_GET['gender']) && $_GET['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= isset($_GET['gender']) && $_GET['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        <option value="Other" <?= isset($_GET['gender']) && $_GET['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
      </select>
      <button type="submit">Filter</button>
    </form>
  </div>

  <!-- Responses Table -->
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Description</th>
        <th>Programming Stack</th>
        <th>File</th>
        <th>Submitted At</th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($responses) > 0): ?>
        <?php foreach ($responses as $response): ?>
          <tr>
            <td><?= htmlspecialchars($response['id']) ?></td>
            <td><?= htmlspecialchars($response['full_name']) ?></td>
            <td><?= htmlspecialchars($response['gender']) ?></td>
            <td><?= htmlspecialchars($response['email_address']) ?></td>
            <td><?= htmlspecialchars($response['description']) ?></td>
            <td><?= htmlspecialchars($response['programming_stack']) ?></td>
            <td>
              <?php if ($response['file_path']): ?>
                <a href="<?= htmlspecialchars($response['file_path']) ?>" download>Download</a>
              <?php else: ?>
                N/A
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($response['submitted_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="8">No responses submitted yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
