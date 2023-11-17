<?php
session_start();
$connection = new mysqli("127.0.0.1", "root", "", "blog");

# Framework

try{
    $route = $_GET['route'] ?? "login";

    $requiredFileName= "pages/".$route .".php"; // pages/login.php, pages/blog.php

    if(!file_exists($requiredFileName)){
        die("<h1>Requested Route Not Found Here</h1>");

    }

    require_once $requiredFileName;
}catch (Exception $e){
    // $e

}