<?php
include("config.php");
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    update($con, $id, $title, $content, $_FILES["img"]);
} else {
    $id = $_GET["id"];
    $q = "SELECT * FROM blog WHERE id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Blog</title>
        <link rel="stylesheet" href="css/main.css">
            <link rel="stylesheet" href="css/blog.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="form-container">
        <form action="update_blog.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" class="form-control" rows="10"><?php echo $post['content']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="img">Image</label>
                <input type="file" name="img" class="form-control">
                <img src="img/<?php echo $post['img']; ?>" alt="Current Image" width="200">
            </div>
            <br>
            <button type="submit" class="btn">Update</button>
        </form>
        <a href="blog.php" class="btn-warning">Go Back</a>
    </div>


        <script src="../js/script.js"></script>
    </body>
</html>