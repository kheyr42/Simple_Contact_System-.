<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Contact Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar h2 {
            color: #e74c3c;
            margin: 0;
        }
        .navbar a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        .navbar a:hover {
            color: #e74c3c;
        }
        .laki {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 60px 80px;
            background: linear-gradient(to right, #fff, #fef1f1);
        }
        .laki-text {
            max-width: 50%;
        }
        .laki-text h1 {
            font-size: 3em;
            color: #333;
            margin-bottom: 10px;
        }
        .laki-text h3 {
            font-size: 1.5em;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        .laki-text p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6;
        }
        .laki-buttons {
            margin-top: 30px;
        }
        .laki-buttons a {
            padding: 12px 24px;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
        }
        .btn-primary {
            background: #e74c3c;
            color: #fff;
        }
        .btn-secondary {
            border: 2px solid #e74c3c;
            color: #e74c3c;
            background: transparent;
        }
        .laki{
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
            padding: 0;
            background:linear-gradient(to right, #fff, #fef1f1);
        }
        .laki-image img {
            width: 200%;
            max-width: 200%; /* sawirka weyn */
            object-fit:cover;
            border-radius: 10px;
           
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #333;
            color: #fff;
            margin-top: auto; /* footer hoos ku dheggan */
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>Contact System</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <a href="dashboard.php">Dashboard</a>
    </div>
</div>

<div class="laki">
    <div class="laki-text">
        <h1>Contact Us</h1>
        <h3>We are here to help you</h3>
        <p>Manage your contacts easily with registration, login, and a secure dashboard system.</p>
        <div class="laki-buttons">
            <a href="register.php" class="btn-primary">Click Here</a>
            <a href="login.php" class="btn-secondary">Start Here</a>
        </div>
    </div>
    <div class="laki-image">
        <img src="images/laki.jpg" alt="laki Image">
    </div>
</div>

<footer>
    &copy; 2026 - Jamhuriya University of Science & Technology
</footer>

</body>
</html>