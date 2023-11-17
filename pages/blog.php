<?php

$blogId = $_GET['id'];
$connection = new mysqli("localhost", "root", "", "blog");

$blog = $connection->query("select * from post where id = '$blogId' limit 1")->fetch_assoc();

if (!$blog) {
    die("Could not find blog with id '$blogId'");
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once "partials/meta.php"; ?>
    <title>Document</title>
</head>
<body>
<?php require_once "components/header.php" ?>
<section class="container">
    <div class="row">
        <div class="col-md-8 offset-2 text-justify">
            <h1 class="mb-5 text-capitalize"><?php echo $blog['title'] ?></h1>
            <img src="https://source.unsplash.com/random/?nature" alt="blog banner" height="300">
            <p class="lead">
                <?php echo $blog['content'] ?>
            </p>
            <div class="mt-3">
                <span>Created at: <?php echo $blog['created_at'] ?></span>
            </div>
        </div>
    </div>
</section>
</body>
</html>