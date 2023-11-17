<?php
session_start();
session_unset();
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = "select * from reset_token where token='$token'";
    // Token Expire , must not be older than 1 hr;
    // Delete token after use;
    $connection = new mysqli("localhost", "root", "", "blog");
    $result = $connection->query($sql);
    if($result->num_rows > 0){
        $email = $result->fetch_all()[0][1];
    }
    else{
        header("Location:?route=login");
    }
}else{
    header("Location:?route=login");
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Reset</div>
                <div class="card-body">
                    <?php include 'error.php'; ?>
                    <form method="post" action="pages/submit.php">
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="password" name="username" class="form-control" id="username" placeholder="Enter your username">
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                        </div>
                        <input type="text" value="password-reset" name="type" hidden>
                        <?php
                        echo " <input type='text' value='$email' name='token-email' hidden>";
                        ?>

                        <button type="submit" class="btn btn-primary w-100 mt-5">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

