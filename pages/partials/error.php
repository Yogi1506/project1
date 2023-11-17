<?php
if (isset($_SESSION['error'])) {
    $errors = json_decode($_SESSION['error'], true);
    if (count($errors) > 0) {
        foreach (json_decode($_SESSION['error'], true) as $error) {
            echo "<div class='alert alert-danger'><small>$error</small></div>";
        }
        unset($_SESSION['error']);
    }

}
