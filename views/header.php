<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo PATH_VIEWS ?>css/style.css">
        <link rel="stylesheet" href="<?php echo PATH_VIEWS ?>/css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo PATH_VIEWS ?>/css/fontawesome/css/all.css">
        <title>ClassNotFound</title>
    </head>
<body>
<header>
    <h1>
        <a href="index.php">
            <img src="<?php echo PATH_VIEWS ?>images/logo2.png" alt="logo">
        </a>

    </h1>

    <div class="topnav">
    <nav>


        <ul>
            <?php
            if(isset($_SESSION['member']) and $_SESSION['member']) {
                echo "<li3>Hello " . $_SESSION['member']->first_name . '!!</li3>';
            }
            ?>

            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?action=insert-question">Ask question</a></li>

            <?php
                if(isset($_SESSION['member']) and $_SESSION['member']) {
                    if ($_SESSION['member']->is_admin == '1') {
                        echo '<li><a href="index.php?action=member">List of members</a></li>';
                    }

                    echo '<li><a href="index.php?action=logout">Logout</a></li>';

                }
                else {
                    echo '<li class="login"><a href="index.php?action=register">Register</a></li>';
                    echo '<li class="login"><a href="index.php?action=login">Login</a></li>';

                }
            ?>
        </ul>
    </nav>
        </div>

</header>