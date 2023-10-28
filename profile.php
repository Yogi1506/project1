<?php
session_start();
if(!isset($_SESSION['name'])){
    header('Location:login.php');
}

$id = $_GET['id'];
$connection = new mysqli("localhost", "root", "", "blog");
$sql = "SELECT p.title, p.content, p.banner, p.created_at AS last FROM post p WHERE p.user_id='$id' ORDER BY p.created_at DESC LIMIT 1";
$result = $connection->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
 
    $last = $row['last'];
    $lt = $row['title'];
    $lc = $row['content'];
   $banner=$row["banner"];
}
$sqlp="SELECT * from user1 WHERE id=$id";
$resultp = $connection->query($sqlp);
while ($rowp = mysqli_fetch_assoc($resultp)) {
$name= $rowp["username"];
$email=$rowp["email"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gradient-custom {
            background: #f6d365;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
        }
    </style>
</head>
<body>
<section class="vh-100 ">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white">
                            <img src="https://source.unsplash.com/random/?city"
                                alt="Avatar" class="img-fluid my-5 rounded-circle" style="width: 120px; height: 120px;"
                            />
                            <h5 class="mt-2"><?php echo $name; ?></h5>
                            <p>Web Designer</p>
                            <i class="far fa-edit mb-4"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h5 class="card-title">Information</h5>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-md-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted"><?php echo $email; ?></p>
                                    </div>
                            
                                   
                                    <div class="col-md-6 mb-3">
                                        <h6>Post</h6><?php
                                         
                                    $sql1="SELECT COUNT(p.user_id) AS Total FROM post p WHERE p.user_id='$id'";
                                    $result1=mysqli_query($connection,$sql1);
                                    while($row1=mysqli_fetch_assoc($result1)){
                                        $total= $row1["Total"];
                                                              }
                                        
                                    
                                    
                                    ?>
                                    <p class="text-muted"><?php echo $total?> </p> 
                                    </div>
                                </div>
                                <h5 class="card-title">Projects</h5>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-md-6 mb-3">
                                        <h6>Last Post Time</h6>
                                        <p class="text-muted"><?php echo $last; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="view overlay">
                
        <h4 class="card-subtitle mb-2 text-muted">LAST POST</h4>
              
               <img src="<?php echo $banner; ?>" class="card-img-top">
                    <!-- <a href="#!"> -->
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lt; ?></h5>
                    <p class="card-text"><?php echo $lc; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        Recent Posts
    </div>
    <?php
    $sql2 = "SELECT p.title, p.content FROM post p WHERE p.user_id='$id' ORDER BY p.created_at DESC LIMIT 5;";
    $result2 = $connection->query($sql2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $title = $row2["title"];
        $content = $row2['content'];
        echo '<div class="card-body">';
        echo '<blockquote class="blockquote mb-0">';
        echo '<p>' . $content . '</p>';
        echo '<footer class="blockquote-footer">' . $title . '</footer>';
        echo '</blockquote>';
        echo '</div>';
    }
    ?>
   
</div>

</body>
</html>
