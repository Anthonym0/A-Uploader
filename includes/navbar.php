<?php 
    session_start();
?>

<nav class="navbar">
    <div class="is-size-4 navbar-brand">
        <a class="navbar-item" href="index.php">AUploader</a>
    </div>

    <?php if (isset($_SESSION['username'])) { ?>
        <div class="navbar-end mr-1">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link"><?php echo $_SESSION['username']; ?></a>

                <div class="navbar-dropdown">
                    <a class="navbar-item">Edit profile</a>
                    <hr class="navbar-divider">
                    <a href="logout.php" class="navbar-item">Logout</a>
                </div>
            </div>
        </div>
    <?php } ?>

</nav>