<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class = "container">
    <div class = "row">
    <div class = "card bg-dark text-light">
        <div class = "card-header text-center mt-3"><h1><i>Blogs</i></h1></div>

    <table class =" table table-bordered table-responsive table-dark text-light mt-2">
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Banner</th>
        <th>Created at</th>
    </tr>

<?php
    $connection = new mysqli("localhost", "root", "", "blog");
    $sql = "SELECT * from post";
    $result = $connection->query($sql);



    while ($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".substr($row['content'],0, 50)."....."."<a href='/route=blog?id=$row[id]'"."class='btn btn-primary'>"."Read More"."</a>"."</td>";
        echo "<td><img src ='".$row['banner']."' height = '100px' width = '150px'></td>";
        echo "<td>".$row['created_at']."</td>";
        echo "</tr>";

       
    }

    ?>

    </table> 

</div>

</div>
       
    
    </div>
    
</body>
</html>