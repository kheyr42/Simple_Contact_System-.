<?php
session_start();
include("connection.php");

$message = "";

// Check if user clicked reset
if (!isset($_SESSION['reset_user_id'])) {
    die("❌ Please go to Forget Password page first.");
}

$user_id = $_SESSION['reset_user_id'];

if (isset($_POST['reset_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $message = "<div class='alert error'>❌ Passwords do not match</div>";
    } else {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param("si", $hash, $user_id);
        $stmt->execute();
        $stmt->close();

        // Clear session
        unset($_SESSION['reset_user_id']);

        $message = "<div class='alert success'>✅ Password reset successfully. <a href='login.php'>Login now</a></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>
<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif}
body{background:#f4f6f9;height:100vh;display:flex;align-items:center;justify-content:center}

/* CARD */
.card{
    background:#fff;
    padding:35px 40px;
    border-radius:12px;
    box-shadow:0 8px 25px rgba(0,0,0,.1);
    width:400px;
}
h2{text-align:center;margin-bottom:20px;color:#111}

/* INPUTS */
input{
    width:100%;
    padding:12px 10px;
    margin:10px 0;
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

/* LINKS */
.alert a{
    text-decoration:none;
    color:#2563eb;
    font-weight:bold;
}
.alert a:hover{color:#1d4ed8}

/* FOOTER LINK */
.back{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#2563eb;
    text-decoration:none;
}
.back:hover{color:#1d4ed8}
</style>
</head>
<body>

<div class="card">
    <h2>🔐 Reset Password</h2>

    <?php echo $message; ?>

    <form method="POST">
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button name="reset_password">Reset Password</button>
    </form>

    <a class="back" href="login.php">⬅ Back to Login</a>
</div>

</body>
</html>
