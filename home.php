<?php
session_start();
if(!$_SESSION['name'])
{
    header('Location:login.php');
}
$connection = new mysqli("localhost", "root", "", "blog");

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
          .logout-button {
            position: absolute;
            top: 10px;
            right: 10px}
    </style>
</head>
<body>
<?php
$name=$_SESSION['name'];

$sf="SELECT user_id FROM POST p join  user1 u On u.id=p.user_id WHERE u.username='$name'";
$abcd=mysqli_query($connection,$sf);
$num=mysqli_fetch_assoc($abcd);
$id= $num["user_id"];




?>

    <header class="bg-dark text-white text-center py-5 position-relative">
    
<a href="logout.php" name='logout' class="btn btn-primary logout-button">Log Out</a>
        <h1>Welcome to  Homepage <?php echo $_SESSION['name'];?></h1>
    
    </header>

    <br>
    <a href="profile.php?id=<?php echo $id ?>" name='logout' class="btn btn-danger ">Profile</a>
<a href="write post.php"><button class="btn btn-warning" type="button">Click HERE to Create Your Blog</button></a>
<br>
<br>
    
