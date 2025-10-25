<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A-Uploader | Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    </head>
    
    <body>
        <?php include 'includes/navbar.php';?>

        <div class="is-flex is-align-items-center is-flex-direction-column mt-5">
            <h1 class="title">Welcome to dashboard</h1>
        </div>
    </body>
</html>