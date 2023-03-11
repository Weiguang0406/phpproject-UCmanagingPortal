<?php

echo "<script>alert('hhhhhhhhhhhhh')</script>";
if(isset($_FILES["image"])) {
    $target_dir = "../uploads/";
    $temp= $_FILES["image"]["name"];
    echo "<script>alert('$temp')</script>";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    echo "<script>alert('$target_file')</script>";

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

/*    // 检查文件是否为图像文件
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // 检查文件是否已存在
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // 限制文件大小
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // 允许的文件格式
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
*/
    // 如果没有错误，则将文件从临时目录移动到目标目录
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
