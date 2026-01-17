<?php
// login.php
include("connection.php");
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']) ? true : false;

    // Fetch user from database (use prepared statements for security)
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['last_activity'] = time();

            // Remember me with cookie
            if ($remember) {
                setcookie("username", $user['username'], time() + (86400 * 30), "/");
            }

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
            padding: 20px;
            color: #fff;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
            padding: 30px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #4CAF50;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background: #45a049;
        }
        .links {
            text-align: center;
            margin-top: 15px;
        }
        .links a {
            color: #007BFF;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .alert {
            padding: 10px;
            margin-top: 15px;
            border-radius: 6px;
            text-align: center;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        footer {
            text-align: center;
            padding: 15px;
            color: #fff;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Simple Contact Management System</h1>
    </header>

    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <label><input type="checkbox" name="remember"> Remember Me</label>
            <button type="submit" class="btn">Login</button>
        </form>

        <div class="links">
            <a href="register.php">Sign Up</a> | 
            <a href="forget_password.php">Forgot Password?</a>
        </div>

        <?php 
        if (!empty($error)) {
            echo "<div class='alert alert-error'>$error</div>";
        }
        if (isset($_GET['registered']) && $_GET['registered'] == 'success') {
            echo "<div class='alert alert-success'>Registration successful! Please login below.</div>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2026 - Simple Contact Management System</p>
    </footer>
</body>
</html>