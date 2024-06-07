<?php
session_start();
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blog_id = $_POST['blog_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM blogs WHERE id='$blog_id' AND user_id='$user_id'";
    mysqli_query($conn, $sql);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Delete Blog</h2>
        <p>Are you sure you want to delete this blog?</p>
        <form action="" method="post">
            <input type="hidden" name="blog_id" value="<?php echo $_POST['blog_id']; ?>">
            <button type="submit">Yes, Delete</button>
            <a href="dashboard.php">Cancel+-</a>
        </form>
    </div>
</body>

</html>
-