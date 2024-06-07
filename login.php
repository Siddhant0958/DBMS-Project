<?php
session_start();
include 'db_config.php';

if(isset($_POST['login'])) {
    $username = $_POST['username1'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sqlquery = "SELECT * FROM users WHERE username1='$username' AND password='$password' AND email='$email'";
    $result = mysqli_query($conn, $sqlquery);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles1.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <input type="text" name="username1" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="email" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <li><a href="index.php">Home</a></li>
</body>
</html>
