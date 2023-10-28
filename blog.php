

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></head>
    <style>

    </style>
<body>
    <div class = "fluid-container">
    <div class = "row">
    <div class = "card bg-dark text-light">
        <div class = "card-header text-center mt-3"><h1><i>Blogs</i></h1></div>
    <table class =" table table-bordered table-responsive table-dark text-light mt-2">
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Banner</th>
        <th>Author</th>
    </tr>

<?php
$id=$_GET['id'];
    $connection = new mysqli("localhost", "root", "", "blog");
    $sql = "SELECT p.*,u.username FROM post p JOIN user1 u ON p.user_id=u.id WHERe p.id=$id";
    $result = $connection->query($sql);



    while ($row = mysqli_fetch_assoc($result)){
       
        

        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['content']."</td>";
        echo "<td><img src ='".$row['banner']."' height = '300px' width = '450px'></td>";
        echo "<td>".$row['username']."</td>";
        echo "</tr>";
        
       
    }

    ?>

    </table> 

</div>

</div>
       
    
    </div>
    
</body>
</html>