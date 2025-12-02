<?php
session_start();
include("db.php");

// ตรวจสอบการล็อกอิน
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_name = $_POST['name'];
    $input_password = $_POST['password'];

    // ใช้ PDO สำหรับการเตรียมและรันคำสั่ง SQL
    $sql = "SELECT * FROM admin WHERE name = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input_name]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบ name และ password แบบ case-sensitive
    if ($user && strcmp($input_name, $user['name']) == 0 && $input_password == $user['password']) {
    $_SESSION['loggedin'] = true;
    $_SESSION['name'] = $input_name;
    header("Location: admin/page_hero.php");
    exit;
} else {
    $error = "name หรือ password ผิด";
}

}    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- เชื่อมโยง Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-6">
                <div class="card p-4">
                    <h4 class="card-title text-center">Login</h4>
                    <!-- <?php if ($error_message): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?> -->
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    <div class="text-center mt-2">
                        <a href="register.php">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- เชื่อมโยง JavaScript ของ Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>