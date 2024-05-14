<?php

include ("conn.php");

function insert($con, $title, $content, $img){
    $dir = "img/";
    $imgFile = $dir . basename($_FILES["img"]["name"]);
    $uploading = 1;
    $imageFileType = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if($check !== false) $uploading = 1;
    else $uploading = 0;

    if (file_exists($imgFile)) $uploading = 0;

    if ($_FILES["img"]["size"] > 500000)$uploading = 0;

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") $uploading = 0;

    if ($uploading == 0) echo "Sorry, your file was not uploaded.";
    else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgFile)) {
            $img = $_FILES["img"]["name"];
            $q = "INSERT INTO blog (title, content, img) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $q);
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $img);
            mysqli_stmt_execute($stmt);
            header("Location: blog.php");
            exit();
        } else echo "Sorry, there was an error uploading your file.";
    }
}