<?php
$username = $_GET['username'];

// post count , last post date, top 5 post
$connection = new mysqli("localhost", "root", "", "blog");

$user = $connection->query("select * from user1 where username = '$username'")
    ->fetch_assoc();
if (!$user) {
    die("user not found");
} else {
    // Avatar, $username
    $avatar = $user['avatar'] ?? "https://api.oyyi.xyz/v1/avatar";
    $username = $user['username'];
}
$userId = $user['id'];
$lastPostDate = $connection
    ->query("select created_at as last_post_date from post where user_id = '$userId' order by created_at desc limit 1")
    ->fetch_assoc()['last_post_date'];
if(isset($_GET['all'])){
    $lastFivePost = $connection->query(
        "select * from post where user_id = '$userId' order by created_at desc");
}else{
    $lastFivePost = $connection->query(
        "select * from post where user_id = '$userId' order by created_at desc limit 10");
}
$allPost = [];

while ($row = $lastFivePost->fetch_assoc()) {
    $allPost[] = $row;
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
<section>
   <div class="row">
       <div class="col-md-6 offset-2">
           <div class="card text-center">
               <div class="card-body">
                   <img src="<?php echo $avatar ?>" alt="avatar" width="100" height="100">
                   <div class="d-flex flex-column">
                       <h3><?php echo $username; ?></h3>
                       <h3><?php echo $lastPostDate?></h3>
                   </div>
               </div>
           </div>
           <h2>Last 5 Post</h2>
           <?php
           foreach ($allPost as $post){
           ?>
           <div class="card my-3">
               <div class="card-header">
                   <h4><?php echo $post['title']?></h4>
               </div>
               <div class="card-body">
                   <img src="<?php echo $post['banner']?>" alt="blog banner" height="100">
                   <p><?php echo substr($post['content'],0,150)?></p>
                   <a href="blog.php?id=<?php echo $post['id']?>">Read More</a>
               </div>
               <div class="card-footer">
                   <h6><?php echo $post['created_at']?></h6>
               </div>
           </div>
           <?php  } ?>
           <a class="btn btn-outline-primary" href="profile.php?username=<?php echo $username?>&all=true"> Show All Post</a>

       </div>
   </div>
</section>
</body>
</html>