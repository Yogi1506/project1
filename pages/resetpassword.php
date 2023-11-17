<?php
session_start();
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
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php include 'error.php'; ?>
                    <form method="post" action="pages/submit.php">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" name="email" class="form-control" id="username" placeholder="Enter your Email">
                        </div>
                        <input type="text" value="reset" name="type" hidden>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Send Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>