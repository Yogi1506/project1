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
   $banner=$row['banner'];
}
$sql="SELECT * from user1 WHERE id=$id";
$result = $connection->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
$name= $row["username"];
$email=$row["email"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="row g-0">
                        <div class="col-md-4">
                            
                            <img src="https://www.sanofi.com/optim/dotcom/pages/images/our-company/we-are-sanofi-3_20230515093557.jpg?size=medium"
                                alt="Avatar" class="img-fluid my-5 rounded-circle" style="width: 160px; height: 140px;"
                            />
                            <h5 class="mx-5"><?php echo $name; ?></h5>
                            <p class="mx-5">Web Designer</p>
                            
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
                                         
                                    $sql="SELECT COUNT(p.user_id) AS Total FROM post p WHERE p.user_id='$id'";
                                    $result=mysqli_query($connection,$sql);
                                    while($row=mysqli_fetch_assoc($result)){
                                        $total= $row["Total"];
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <h4 class="card-subtitle mb-2 text-muted">LAST POST</h4>
                    <img src="<?php echo $banner; ?>" class="card-img-top">
                    
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
    $sql = "SELECT p.title, p.id,p.content FROM post p WHERE p.user_id='$id' ORDER BY p.created_at DESC LIMIT 5;";
    $result = $connection->query($sql);

                                                         
    while ($row = mysqli_fetch_assoc($result)) {

        $pid=$row["id"];
        $title = $row["title"];
        $content = $row['content'];
        echo '<div class="card-body">';
        echo '  <div>';
        echo "  <a href='delete.php?id=$pid'class='btn btn-warning'>DELETE</a>";
        echo '</div>';
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
