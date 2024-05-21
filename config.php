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
            $state = mysqli_prepare($con, $q);
            mysqli_stmt_bind_param($state, "sss", $title, $content, $img);
            mysqli_stmt_execute($state);
            header("Location: blog.php");
            exit();
        } else echo "Sorry, there was an error uploading your file.";
    }
}

function update($con, $id, $title, $content, $img) {
    $dir = "img/";
    $imgFile = $dir . basename($_FILES["img"]["name"]);
    $uploading = 1;
    $imageFileType = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));

    if ($img["size"] > 0) {
        $check = getimagesize($img["tmp_name"]);
        if ($check !== false) $uploading = 1;
        else $uploading = 0;

        if (file_exists($imgFile)) $uploading = 0;

        if ($img["size"] > 500000) $uploading = 0;

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") $uploading = 0;

        if ($uploading == 0) echo "Sorry, your file was not uploaded.";
        else {
            if (move_uploaded_file($img["tmp_name"], $imgFile)) {
                $img = $img["name"];
                $q = "UPDATE blog SET title = ?, content = ?, img = ? WHERE id = ?";
                $state = mysqli_prepare($con, $q);
                mysqli_stmt_bind_param($state, "sssi", $title, $content, $img, $id);
                mysqli_stmt_execute($state);
                header("Location: blog.php");
                exit();
            } else echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $q = "UPDATE blog SET title = ?, content = ? WHERE id = ?";
        $state = mysqli_prepare($con, $q);
        mysqli_stmt_bind_param($state, "ssi", $title, $content, $id);
        mysqli_stmt_execute($state);
        header("Location: blog.php");
        exit();
    }
}

function destroy($con, $id) {
    $q = "SELECT img FROM blog WHERE id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $img);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $q = "DELETE FROM blog WHERE id = ?";
    $state = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($state, "i", $id);
    mysqli_stmt_execute($state);
    if (mysqli_stmt_affected_rows($state) > 0)
    {
        $imgFile = "img/" . $img;
        if (file_exists($imgFile)) unlink($imgFile);
        echo "Blog deleted successfully.";
    }
    else echo "Blog deleting error: " . mysqli_error($con);

    header("Location: blog.php");
    exit();
}