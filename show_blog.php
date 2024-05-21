<?php
    include ("config.php");
    include ("conn.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $q = "SELECT * FROM blog WHERE id = ?";
        $stmt = mysqli_prepare($con, $q);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $post = mysqli_fetch_assoc($result);
    
        if (!$post) {
            echo "Blog not exist.";
            exit();
        }
    } else {
        echo "No ID not provided.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Show Blog</title>
        <link rel="stylesheet" href="css/main.css">
            <link rel="stylesheet" href="css/blog.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
            <style>
                article{
                    display: grid;
                    place-items: center;
                    width: 90vw;
                }
            </style>
    </head>
    <body>
        <div class="container">
            <nav>
                <h1>
                    <a href="index.html">Home</a>
                    <a href="gallery.html">Gallery</a>
                    <a href="blog.html" style="text-decoration: underline;">Blog</a>
                    <a href="contact.html">Contact</a>
                </h1>
            </nav>

            <article>
                <img src="img/<?php echo $post['img']; ?>">
                <h1 style="text-align: center;"><?php echo $post['title']; ?></h1>
                <p><?php echo $post['content']; ?></p>
            </article>

            <a href="blog.php" class="btn-warning">Go Back</a>
        </div>
        <script src="js/script.js"></script>
    </body>
</html>