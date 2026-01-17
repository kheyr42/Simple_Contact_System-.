<?php
session_start();
include("connection.php"); // isticmaal connection.php

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

// CREATE
if (isset($_POST['add_contact'])) {
    $stmt = $conn->prepare("INSERT INTO contacts (user_id, name, phone, email, address) VALUES (?,?,?,?,?)");
    $stmt->bind_param("issss", $_SESSION['user_id'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address']);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "✅ Contact added successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to add contact!";
    }
    header("Location: contacts.php");
    exit();
}

// DELETE
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM contacts WHERE contacts_id=?");
    $stmt->bind_param("i", $_GET['delete']);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "🗑️ Contact deleted successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to delete contact!";
    }
    header("Location: contacts.php");
    exit();
}

// READ
$result = $conn->query("SELECT * FROM contacts ORDER BY contacts_id DESC");
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contacts Management</title>
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
    <a href="users.php">👥 Users</a>
    <a href="contacts.php" class="active">📇 Contacts</a>
    <a href="profile.php">👤 Profile</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<div class="main">
<div class="topbar">
    <h3>Manage Contacts</h3>
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

<div class="card">
<h3>Add New Contact</h3>
<form method="post">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="phone" placeholder="Phone" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="address" placeholder="Address">
    <button class="btn btn-add" type="submit" name="add_contact">Add Contact</button>
</form>
</div>

<div class="card">
<h3>All Contacts</h3>
<table>
<tr>
<th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Address</th><th>Actions</th>
</tr>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>
<td><?= $row['contacts_id'] ?></td>
<td><?= htmlspecialchars($row['name']); ?></td>
<td><?= htmlspecialchars($row['phone']); ?></td>
<td><?= htmlspecialchars($row['email']); ?></td>
<td><?= htmlspecialchars($row['address']); ?></td>
<td>
<a class="btn btn-edit" href="edit_contact.php?id=<?= $row['contacts_id'] ?>">Edit</a>
<a class="btn btn-del" href="contacts.php?delete=<?= $row['contacts_id'] ?>" onclick="return confirm('Delete this contact?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>

<footer>© 2026 Admin Panel</footer>
</div>
</body>
</html>
