<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo PATH_VIEWS?>css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
                echo "<li3>Hello " . $_SESSION['member']->first_name . '!</li3>';
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

</header>