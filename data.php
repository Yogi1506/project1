<?php

$URL = "https://api.oyyi.xyz/v1/fake/get?email=email&username=username&password=word,2&count=100";
$connection = new mysqli("localhost", "root", "", "blog");
$response = file_get_contents($URL); // string
$fakeUser = json_decode($response, true);

foreach ($fakeUser as $u) {
    $email = $u["email"];
    $username = $u["username"];
    $password = md5($u["password"]);
    $query = "insert into user1 (email,username,password) values ('$email','$username','$password')";
    $result = $connection->query($query);
    if ($result) {
        echo "Data inserted \n";
    }
}

$blogUrl = "https://api.oyyi.xyz/v1/fake/get?user_id=number,1,100&title=word,10&content=word,1000&count=500";
$fakeBlog  = json_decode(file_get_contents($blogUrl), true);
foreach ($fakeBlog as $blog){
    $title = $blog['title'];
    $content = $blog['content'];
    $user_id = $blog['user_id'];
    $banner = "banner/f214538d87e46c0473919ed2e2f298ea.jpg";
    $query = "insert into post(user_id,title,content,banner) values($user_id,'$title','$content','$banner')";
    if($connection->query($query)){
        echo "Blog Inserted";
    }
}