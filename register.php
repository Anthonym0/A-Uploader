<?php
    require_once("database.php");
    require_once('utils.php');
    check_session_start();

    const db = new db;
    $error = '';

    if (isset($_SESSION['username'])) {
        header('Location: dashboard.php');
        exit;
    } else if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmpassword'])) {
        $error = db->create_user($_POST['username'], $_POST['password'], $_POST['confirmpassword']);
        if ($error == '')
           header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    </head>
    
    <body>
        <?php include 'includes/navbar.php';?>
        <?php if ($error != '') { ?>
            <div class="is-flex is-justify-content-center mb-5">
                <article class="message is-danger is-small">
                    <div class="message-body">
                        <?php echo $error; ?>
                    </div>
                </article>
            </div>
        <?php } ?>
        
        <div class="is-flex is-justify-content-center">
            <form class="box" action="register.php" method="POST">
                <div class="is-flex is-align-items-center mb-4 is-flex-direction-column">
                    <h2 class="is-size-3">Register</h2>
                    
                </div>
                <div class="field">
                    <label class="label">Username</label>
                    <div class="control">
                        <input required name="username" class="input control" type="text">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input required name="password" class="input control" type="password">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Confirm password</label>
                    <div class="control">
                        <input required name="confirmpassword" class="input control" type="password">
                    </div>
                </div>

                <div class="field is-flex is-justify-content-center is-flex-direction-column mt-5">
                    <button type="submit" class="button is-success px-6">Register</button>
                    <a class="pt-2" href="login.php">Have an account?</a>
                </div>
            </form>
        </div>
    </body>
</html>