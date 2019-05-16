<?php
session_start();
require "dbh-inc.php";
//Starts our session and accepts later session changes.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<header>
    <!-- Navigation -->
    <nav class="navbar navbar-light" style="background-color: #004990;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" style="padding:5px">
                    <img alt="KatsConnect Home" src="images/SHSU_LOGO.png" style="width:80px">
                </a>
            </div>
            <ul class="nav navbar-nav">

                <li><a href="index.php">Home</a></li>
                <li><a href="http:shsustudents.club/"><p style="color:white;">Bulletin Board</p></a></li>
                <li><a href="tutor.php"><p style="color:white;">TutorKats</p></a></li>
                <li><a href="marketPlace.php"><p style="color:white;">MarketPlace</p></a></li>
                <li><a href="campusDirect.php"><p style="color:white;">CampusDirect</p></a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (!isset($_SESSION['id'])) {
                        echo '<form action="includes/login-inc.php" method="post">
                        <input type="text" name="mailuid" placeholder="E-mail/Username">
                            <input type="password" name="pwd" placeholder="Password">
                               <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                              <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>';
                    }
                    else if (isset($_SESSION['id'])) {
                        echo '<li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                              <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>';
                    }
                ?>

            </ul>
        </div>
    </nav>
</header>
