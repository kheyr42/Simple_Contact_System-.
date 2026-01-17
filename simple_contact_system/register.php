<?php
// register.php
include("connection.php"); // database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $sex       = $_POST['sex'];
    $username  = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_BCRYPT); // secure password
    $phone     = $_POST['phone'];
    $email     = $_POST['email'];
    $user_type = $_POST['user_type'];
    $status    = $_POST['status'];

    // Handle profile picture upload
    $photo = "";
    if (!empty($_FILES['photo']['name'])) {
        $photo = time() . "_" . $_FILES['photo']['name'];
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $photo);
    }

    // Insert into database
    $sql = "INSERT INTO users (firstname, lastname, sex, username, password, phone, email, photo, user_type, status)
            VALUES ('$firstname', '$lastname', '$sex', '$username', '$password', '$phone', '$email', '$photo', '$user_type', '$status')";

    if (mysqli_query($conn, $sql)) {
        // Registration successful → redirect to login
        header("Location: login.php?registered=success");
        exit();
    } else {
        echo "<div class='alert alert-error'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        /* Reset default margins/paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        header {
            margin-bottom: 20px;
            text-align: center;
        }

        header h1 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .content {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 450px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form input[type="text"],
        form input[type="password"],
        form input[type="email"],
        form input[type="file"],
        form select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        form input:focus,
        form select:focus {
            border-color: #74ebd5;
            outline: none;
        }

        form input[type="submit"],
        form input[type="reset"] {
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s, transform 0.2s;
        }

        form input[type="submit"] {
            background: #74ebd5;
            color: #fff;
        }

        form input[type="reset"] {
            background: #ccc;
            color: #333;
        }

        form input[type="submit"]:hover {
            background: #5ac8d5;
            transform: scale(1.05);
        }

        form input[type="reset"]:hover {
            background: #999;
            transform: scale(1.05);
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #333;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<header>
    <h1>Register New User</h1>
</header>

<div class="content">
    <form method="POST" enctype="multipart/form-data">
        First Name: <input type="text" name="firstname" required>
        Last Name: <input type="text" name="lastname" required>
        Sex:
        <select name="sex">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        Username: <input type="text" name="username" required>
        Password: <input type="password" name="password" required>
        Phone: <input type="text" name="phone">
        Email: <input type="email" name="email">
        Profile Picture: <input type="file" name="photo">
        User Type:
        <select name="user_type">
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
        Status:
        <select name="status">
            <option value="Active">Active</option>
            <option value="Not Active">Not Active</option>
        </select>
        <input type="reset" value="Reset">
        <input type="submit" value="Register">
    </form>
</div>

<footer>
    <p>&copy; 2026 - Simple Contact Management System</p>
</footer>
</body>
</html>