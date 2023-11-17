<?php
if(!isset($_SESSION['name'])){
    header('location:login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel = "stylesheet" href = https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css>

</head>
<body>
<div class="container">
<?php include "partials/error.php"; ?>

    <form enctype="multipart/form-data" method="POST" action="">
        <div class="form-group mt-2">
            <label for="fileInput">File Upload</label>
            <input type="file" class="form-control-file" name="banner" id="fileInput" accept="image/*" required>
        </div>
        <div class="form-group mt-1">
            <label for="textarea">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="textarea">Textarea</label>
            <textarea class="form-control" id="textarea" name="content" rows="10" style="width: 100%;" required></textarea>
        </div>
        <input type="text" name="type" value="write-post" hidden>
        <button type="submit" name="submit" class="btn btn-primary w-100 mt-3">Submit</button>
    </form>
</div>

</body>
</html>
<?php

$conn=new mysqli('localhost','root','','Blog');
if(isset($_POST['submit'])){
    $target="banner/";
    $picture=$target.basename($_FILES['banner']['name']);
    $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $content=filter_var($_POST['content'],FILTER_SANITIZE_STRING);
    $user=$_SESSION['name'];
$sql="SELECT `id` from `user1` WHERE username='$user'";
$query=$conn->query($sql);
$row=mysqli_fetch_assoc($query);
$id=$row['id'];
if($_FILES['banner']['size']<5*1024*1024){
if(move_uploaded_file($_FILES['banner']['tmp_name'],$target.basename($_FILES['banner']['name']))){
$sql="INSERT INTO `post`( `user_id`, `title`, `content`, `banner`) VALUES ('$id','$title','$content','$picture')";
$result=$conn->query($sql);
if($result){
    header('location:?route=home');

}else{
    $error[]="File not Moved";
    $_SESSION['error'] = json_encode($error);
    header('location:?route=writepost'); 
}






}else{
    $error[]="File not Moved";
    $_SESSION['error'] = json_encode($error);
    header('location:write post.php');
}
}else{
    $error[]="File Size Greater than 5mb";
    $_SESSION['error'] = json_encode($error);
    header('location:write post.php');
}


}

?>
