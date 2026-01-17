<?php
session_start();
include("connection.php");
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'] ?? 0;

// READ contact
$stmt = $conn->prepare("SELECT * FROM contacts WHERE contacts_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$contact = $result->fetch_assoc();

if (!$contact) {
    die("Contact not found!");
}

// UPDATE contact
if (isset($_POST['update_contact'])) {
    $stmt = $conn->prepare("UPDATE contacts SET name=?, phone=?, email=?, address=? WHERE contacts_id=?");
    $stmt->bind_param("ssssi", $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address'], $id);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "✏️ Contact updated successfully!";
    } else {
        $_SESSION['msg'] = "❌ Failed to update contact!";
    }
    header("Location: contacts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Contact</title>
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
    <a href="contacts.php" class="active">📇 Contacts</a>
    <a href="profile.php">👤 Profile</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<div class="main">
<div class="topbar"><h3>Edit Contact</h3></div>

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
    <input type="text" name="name" value="<?= htmlspecialchars($contact['name']); ?>" required>
    <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone']); ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($contact['email']); ?>" required>
    <input type="text" name="address" value="<?= htmlspecialchars($contact['address']); ?>">
    <button class="btn btn-edit" type="submit" name="update_contact">Update Contact</button>
</form>
</div>
</div>
</body>
</html>
