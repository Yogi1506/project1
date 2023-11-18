<?php

//unset($_SESSION['error']);
$connection = new mysqli("localhost", "root", "", "blog");
if (isset($_POST['type']) && $_POST["type"] === "login") {
    login();
} elseif (isset($_POST['type']) && $_POST["type"] === "register") {
    register();
} elseif (isset($_POST['type']) && $_POST["type"] === "reset") {
    resetPassword();
} elseif (isset($_POST['type']) && $_POST["type"] === "password-reset") {
    updatePassword();
} 
elseif (isset($_POST['type']) && $_POST["type"] === "edit-post") {
    editPost();
    
}


function register(): void
{
    global $connection;
    $error = [];
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];

    if ($password !== $confirmPassword) {
        $error[] = "Password and confirm password do not match";
    }
    if (strlen($password) < 8) {
        $error[] = "Password must be of length 8";
       
    }
    if (!checkUniqueUsername($username)) {
        $error[] = "username already taken";
    }
    $hashed = md5($password);
    if (count($error) == 0) {
        try{
            $sql = "insert into user1(username,email,password) values('$username','$email','$hashed')";
            $result = $connection->query($sql);
            if ($result){
                header("Location:?route=login");
            }else{
                $error[] ="unable to create your account ";
                $_SESSION['error'] = json_encode($error);
                header("Location: ". $_SERVER['HTTP_REFERER']);
            }
        }catch(Exception $e){
            $error[] ="unable to create your account ". $e->getMessage();
            $_SESSION['error'] = json_encode($error);
            header("Location: ". $_SERVER['HTTP_REFERER']);
        }
    }else{
        $_SESSION['error'] = json_encode($error);
        header("Location: ". $_SERVER['HTTP_REFERER']);
    }
}

function checkUniqueUsername($username)
{
    global $connection;
    $sql = "SELECT username FROM user1 where username= '$username'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }

}

// Login

function login()
{
    global $connection;
    $error=[];
    if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql="SELECT username ,password from user1 Where username='$username'AND password='$password'";
    $result=$connection->query($sql);
    if ($result->num_rows>0) {
       header('location:?route=home');
       $_SESSION['name']=$username;

    }else{

        $error[]="Username and Password Not Matched";
        $_SESSION['error'] = json_encode($error);
        header('location:?route=login');
    }
}
}

function resetPassword()
{
    global $connection;
    $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
    $query = "select * from user1 where email='$email'";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        $token = sha1(microtime());
        $query = "insert into reset_token(email,token) values('$email','$token')";
        $result = $connection->query($query);
        $link = "?route=reset?token=$token";
        $_SESSION['error'] = json_encode(["Reset Link has Been Sent " . $link]);
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['error'] = json_encode(["No User Found with this email"]);
        header("location: " . $_SERVER['HTTP_REFERER']);
    }

    return;
}

function updatePassword(): void
{
    global $connection;
    $email = filter_var($_REQUEST['token-email'], FILTER_VALIDATE_EMAIL);
    $password = md5($_REQUEST['password']);
    $query = "UPDATE user1 SET password='$password' WHERE email='$email'";
    var_dump($query);
    $result = $connection->query($query);
    header("location:?route=login");
}

function editPost(){
    global $connection;
    $content = $_POST['content'];
    $title = $_POST['title'];
    var_dump($_POST['title']);
    $postId = $_POST['post-id'];
    $query = "update post set title='$title',content='$content' where id = '$postId'";
    $result = $connection->query($query);

    if($result){
        header("location:?route=home" );
    }
    else{
        die("Unable to update ur post");
    }
}

