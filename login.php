<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = json_encode([
        'email' => $email,
        'password' => $password
    ]);

    $ch = curl_init('http://localhost:8080/api/student-register/login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if (trim($response) === "Login successful") {
        $_SESSION['email'] = $email;
        header("Location: create_data.php");
        exit();
    } else {
        $error = $response;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-6 offset-md-3 card p-4 shadow">
        <h4 class="mb-4">Login</h4>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required/>
            </div>

            <div class="mb-3">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" required/>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div><p class="text-center mt-3">Not registered? <a href="register.php">Create an account</a></p>

</div>
</body>
</html>
