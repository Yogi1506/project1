<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location: login.php");
}
$searchQuery = $_GET['name'] ?? null;
$connection = new mysqli("localhost", "root", "", "blog");
$searchedUser = [];
$searchedPost = [];
if ($searchQuery) {
    $resultUser = $connection->query("select u.id,u.username,p.created_at,count(p.id) as post_count from user1 u 
    left join post p on u.id=p.user_id
    where username like '%$searchQuery%' group by p.user_id");
    while ($row = $resultUser->fetch_assoc()) {
        $searchedUser[] = $row;
    }
    $postResult = $connection->query("select * from post where title like '%$searchQuery%'");
    while ($row = $postResult->fetch_assoc()) {
        $searchedPost[] = $row;
    }
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
<?php include "components/header.php"; ?>


    <div class="container">
        <h4>Total User Found : <?php echo count($searchedUser); ?></h4>
        <?php foreach ($searchedUser as $user) { ?>
            <div class="card my-3">
                <div class="card-body">
                    <h2><?php echo $user['username'] ?></h2>
                    <h4>Total Post Created: <?php echo $user['post_count'] ?></h4>
                </div>
                <div class="card-footer">
                    <h5>Joined At: <?php echo $user['created_at'] ?></h5>
                </div>
            </div>
        <?php } ?>
        
    </div>
</section>

</body>
</html>
