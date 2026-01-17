<?php
session_start();
include("connection.php");
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'] ?? 0;

// READ user
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found!");
}

// UPDATE user
if (isset($_POST['update_user'])) {
    $stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, username=?, email=?, phone=?, sex=?, user_type=?, status=? WHERE id=?");
    $stmt->bind_param(
        "ssssssssi",
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['username'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['sex'],
        $_POST['user_type'],
        $_POST['status'],
        $id
    );
    if ($stmt->execute()) {
        $_SESSION['msg'] = "✏️ User updated successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to update user!";
    }
    header("Location: users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
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
    <a href="users.php" class="active">👥 Users</a>
    <a href="contacts.php">📇 Contacts</a>
    <a href="profile.php">👤 Profile</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<div class="main">
<div class="topbar"><h3>Edit User</h3></div>

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
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']); ?>">
    <select name="sex">
        <option value="Male" <?= $user['sex']=="Male"?"selected":""; ?>>Male</option>
        <option value="Female" <?= $user['sex']=="Female"?"selected":""; ?>>Female</option>
    </select>
    <select name="user_type">
        <option value="Admin" <?= $user['user_type']=="Admin"?"selected":""; ?>>Admin</option>
        <option value="User" <?= $user['user_type']=="User"?"selected":""; ?>>User</option>
    </select>
    <select name="status">
        <option value="Active" <?= $user['status']=="Active"?"selected":""; ?>>Active</option>
        <option value="Inactive" <?= $user['status']=="Inactive"?"selected":""; ?>>Inactive</option>
    </select>
    <button class="btn btn-edit" type="submit" name="update_user">Update User</button>
</form>
</div>
</div>
</body>
</html>
