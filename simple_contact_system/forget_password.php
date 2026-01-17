<?php
session_start();
include("connection.php");

$message = "";

if (isset($_POST['send_link'])) {
    $email = $_POST['email'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $user_id = $user['id'];

        // Store id in session for local reset
        $_SESSION['reset_user_id'] = $user_id;

        $message = "<div class='alert success'>✅ Email found! 
        <a href='reset_password.php'>Click here to reset your password</a></div>";
    } else {
        $message = "<div class='alert error'>❌ Email not found</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif}
body{background:#f4f6f9;height:100vh;display:flex;align-items:center;justify-content:center}

/* CARD */
.card{
    background:#fff;
    padding:30px 40px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,.1);
    width:380px;
}
h2{text-align:center;margin-bottom:20px;color:#111}

/* INPUTS */
input{
    width:100%;
    padding:12px 10px;
    margin:8px 0;
    border-radius:8px;
    border:1px solid #ccc;
    transition:0.3s;
}
input:focus{
    border-color:#2563eb;
    outline:none;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border:none;
    border-radius:8px;
    background:#2563eb;
    color:#fff;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}
button:hover{background:#1d4ed8}

/* ALERTS */
.alert{
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    font-size:14px;
    text-align:center;
}
.success{background:#dcfce7;color:#166534}
.error{background:#fee2e2;color:#991b1b}

/* LINK INSIDE ALERT */
.alert a{
    text-decoration:none;
    color:#2563eb;
    font-weight:bold;
}
.alert a:hover{color:#1d4ed8}
</style>
</head>
<body>

<div class="card">
    <h2>🔑 Forgot Password</h2>

    <?php echo $message; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button name="send_link">Send Reset Link</button>
    </form>

    <p style="text-align:center;margin-top:15px;">
        <a href="login.php" style="color:#2563eb;text-decoration:none;">⬅ Back to Login</a>
    </p>
</div>

</body>
</html>
