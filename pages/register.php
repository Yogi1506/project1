<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include "partials/meta.php"; ?>
    <title>Register</title>
</head>
<body>
<?php include "components/header.php"; ?>
    <div class = "container mt-5 w-50">
        <div class = "card">
            <div class = "card-header text-center"><h2>Sign up</h2></div>
            <div class = "card-body">
            <?php include "partials/error.php"; ?>
                <form action = "pages/submit.php" method = "POST">
                    <div class = "form-group mt-2">
                        <label for = "username">Username</label>
                        <input type = "text" class = "form-control" name = "username" id = "username" placeholder = "Enter your username">
                    </div>
                    <div class = "form-group mt-2">
                        <label for = "Email">Email</label>
                        <input type = "email" class = "form-control" name = "email" id = "email" placeholder = "Enter your email">
                    </div>
                    <div class = "form-group mt-2">
                        <label for = "password">Password</label>
                        <input type = "password" class = "form-control" name = "password" id = "password" placeholder = "Enter your password">
                    </div>
                    <div class = "form-group mt-2">
                        <label for = "confirm password">Confirm Password</label>
                        <input type = "password" class = "form-control" name = "cpassword" id = "confirm password" placeholder = "Confirm your password">
                    </div>
                    <input type="text" value="register" name="type" hidden>
                    <input type = "submit" name="submit" class= "btn btn-primary mt-2 w-100" value = "sign up">
                    <p>Already have a account? <a href= "?route=login">click here</a> to log in.</p>

                </form>
            </div>
        </div>
</div>
    
</body>
</html>
