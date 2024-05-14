<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blog</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/blog.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
            
            <header>
                <h1>My Story</h1>
                <input type="search" placeholder="Search..." id="">
            </header>

            <a href="insert_blog.php" class="btn">Add +</a>

            <div class="blog">
                <?php
                    include ("conn.php");
                    include ("config.php");
                    $q = "SELECT * FROM blog";
                    $data = mysqli_query($con, $q);
                    while($row = mysqli_fetch_array($data)){
                        $img = $row['img'];
                        $title = $row['title'];
                        $content = $row['content'];
                        echo "
                            <article>
                                <img src=\"img\/$img\">
                                <h2>$title</h2>
                                <p>$content</p>
                                <a href= \"# \">See More</a>
                            </article>
                        ";
                    }
                ?>
            </div>

        </div>
        <script src="js/script.js"></script>
    </body>
</html>