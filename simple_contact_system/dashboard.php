<?php
session_start();
include("connection.php");
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

// Count Users
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

// Count Contacts
$contactCount = $conn->query("SELECT COUNT(*) AS total FROM contacts")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php" class="active">📊 Dashboard</a>
    <a href="users.php">👥 Users</a>
    <a href="contacts.php">📇 Contacts</a>
    <a href="profile.php">👤 Profile</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<div class="main">
<div class="topbar">
    <h3>Dashboard</h3>
    <span>Welcome, <b><?= htmlspecialchars($_SESSION['username']); ?></b></span>
</div>

<div class="card">
    <h3>Total Users</h3>
    <p><?= $userCount; ?></p>
</div>

<div class="card">
    <h3>Total Contacts</h3>
    <p><?= $contactCount; ?></p>
</div>

<footer>© 2026 Admin Panel</footer>
</div>
</body>
</html>
