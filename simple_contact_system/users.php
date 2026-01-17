<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

// CREATE
if (isset($_POST['add_user'])) {
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, phone, sex, user_type, status, created_at) VALUES (?,?,?,?,?,?,?,?,NOW())");
    $stmt->bind_param("ssssssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['phone'], $_POST['sex'], $_POST['user_type'], $_POST['status']);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "✅ User added successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to add user!";
    }
    header("Location: users.php");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $_GET['delete']);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "🗑️ User deleted successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to delete user!";
    }
    header("Location: users.php");
    exit();
}

// READ
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Users Management</title>
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
.alert.delete { background:#fef3c7; color:#92400e; }
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
<div class="topbar">
    <h3>Manage Users</h3>
    <span>Welcome, <b><?= htmlspecialchars($_SESSION['username']); ?></b></span>
</div>

<!-- ALERT BOX -->
<?php if(isset($_SESSION['msg'])): ?>
    <div class="alert 
        <?= strpos($_SESSION['msg'],'✅')!==false?'success':''; ?>
        <?= strpos($_SESSION['msg'],'❌')!==false?'error':''; ?>
        <?= strpos($_SESSION['msg'],'🗑️')!==false?'delete':''; ?>">
        <?= $_SESSION['msg']; ?>
    </div>
<?php unset($_SESSION['msg']); endif; ?>

<!-- Add User Form -->
<div class="card">
<h3>Add New User</h3>
<form method="post">
    <input type="text" name="firstname" placeholder="Firstname" required>
    <input type="text" name="lastname" placeholder="Lastname" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone">
    <select name="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <select name="user_type">
        <option value="Admin">Admin</option>
        <option value="User">User</option>
    </select>
    <select name="status">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select>
    <button class="btn btn-add" type="submit" name="add_user">Add User</button>
</form>
</div>

<!-- All Users Table -->
<div class="card">
<h3>All Users</h3>
<table>
<tr>
<th>ID</th><th>Firstname</th><th>Lastname</th><th>Username</th><th>Email</th><th>Phone</th><th>Sex</th><th>User Type</th><th>Status</th><th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= htmlspecialchars($row['firstname']); ?></td>
<td><?= htmlspecialchars($row['lastname']); ?></td>
<td><?= htmlspecialchars($row['username']); ?></td>
<td><?= htmlspecialchars($row['email']); ?></td>
<td><?= htmlspecialchars($row['phone']); ?></td>
<td><?= htmlspecialchars($row['sex']); ?></td>
<td><?= htmlspecialchars($row['user_type']); ?></td>
<td><?= htmlspecialchars($row['status']); ?></td>
<td>
<a class="btn btn-edit" href="edit_user.php?id=<?= $row['id'] ?>">Edit</a>
<a class="btn btn-del" href="users.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>

<footer>© 2026 Admin Panel</footer>
</div>
</body>
</html>
