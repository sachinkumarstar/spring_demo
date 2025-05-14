<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Invalid ID";
    exit;
}

$api_url = "http://localhost:8080/api/students/$id";
$response = file_get_contents($api_url);
$student = json_decode($response, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "number" => $_POST['number'],
        "address" => $_POST['address']
    ];

    $jsonData = json_encode($data);

    $ch = curl_init("$api_url");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    header("Location: fetch_data.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Update Student</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Number:</label>
            <input type="text" name="number" class="form-control" value="<?= htmlspecialchars($student['number']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Address:</label>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($student['address']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="fetch_data.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
