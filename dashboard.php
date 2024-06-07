<?php
session_start();
include 'db_config.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM blogs WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(isset($_POST['add_blog'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO blogs (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if(mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['delete_blog'])) {
    $blog_id = $_POST['blog_id'];

    $sql = "DELETE FROM blogs WHERE id='$blog_id' AND user_id='$user_id'";
    if(mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Blog Site</h1>
    <h2>Your Blogs</h2>
    <ul>
        <?php foreach($blogs as $blog): ?>
            <li>
                <?php echo $blog['title']; ?>
                <p><?php echo $blog['content']; ?></p>
                <form action="" method="POST" style="display: inline;">
                    <input type="hidden" name="blog_id" value="<?php echo $blog['id']; ?>">
                    <button type="submit" name="delete_blog">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <h2>Add Blog</h2>
    <form action="dashboard.php" method="POST">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <button type="submit" name="add_blog">Add Blog</button>
    </form>
     
    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
