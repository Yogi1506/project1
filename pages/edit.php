<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: /route=login");
}
$username = $_SESSION['name'];
$postId = $_GET['id'];
$connection = new mysqli("localhost", "root", "", "blog");
$user = $connection->query("select * from user1 where username = '$username'")
    ->fetch_assoc()['id'];
$blogQuery = $connection->query(
    "select * from post where user_id = '$user' and id = '$postId' limit 1");
if(!$blogQuery){
    die("Invalid Blog Id");
}
$blog = $blogQuery->fetch_assoc();
$title = $blog['title'];
$content = $blog['content'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include "partials/meta.php"; ?>

</head>
<body>
<?php include "components/header.php"; ?>
<div class="container">
    <?php include "partials/error.php"; ?>
    <form enctype="multipart/form-data" action="pages/submit.php" method="post">
        <div class="form-group">
            <label for="textarea">Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $title?>">
        </div>
        <div class="form-group">
            <label for="textarea">Blog </label>
            <textarea class="form-control" id="textarea" name="content" rows="20" style="width: 100%;"
            ><?php echo $content?></textarea>
        </div>
        <input type="text" name="post-id" value="<?php echo $postId?>" hidden>
        <input type="text" name="type" value="edit-post" hidden>
        <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
    </form>
</div>
</body>
</html>