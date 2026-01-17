<?php
session_start();
include("connection.php");
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$id = $_SESSION['user_id'];

// READ user profile
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found!");
}

// UPDATE profile
if (isset($_POST['update_profile'])) {
    $stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, phone=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $id);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "✏️ Profile updated successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to update profile!";
    }
    header("Location: profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profile</title>
<link rel="stylesheet" href="style.css">
<style>
.alert {
    margin: 15px 0;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
}
.alert.success { background:#d1fae5; color:#065f46; }
.alert.error { background:#fee2e2; color:#991b1b; }
</style>
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="users.php">👥 Users</a>
    <a href="contacts.php">📇 Contacts</a>
    <a href="profile.php" class="active">👤 Profile</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<div class="main">
<div class="topbar"><h3>My Profile</h3></div>

<!-- ALERT BOX -->
<?php if(isset($_SESSION['msg'])): ?>
    <div class="alert 
        <?= strpos($_SESSION['msg'],'✏️')!==false?'success':''; ?>
        <?= strpos($_SESSION['msg'],'❌')!==false?'error':''; ?>">
        <?= $_SESSION['msg']; ?>
    </div>
<?php unset($_SESSION['msg']); endif; ?>

<div class="card">
<form method="post">
    <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']); ?>" required>
    <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']); ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']); ?>">
    <button class="btn btn-edit" type="submit" name="update_profile">Update Profile</button>
</form>
</div>
</div>
</body>
</html>
