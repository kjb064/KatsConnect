<?php
session_start();
require 'dbh-inc.php';
//Starts our session and accepts later session changes.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KatsConnect Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <style>
        .navbar-nav > li > a {
            color: white;
        }
        .navbar-nav > li > a:hover {
            background-color: #004990;
        }
    </style>
    <!-- Navigation -->
    <nav class="navbar navbar-light" style="background-color: #004990;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php" style="padding:5px">
                    <img alt="KatsConnect Home" src="../images/SHSU_LOGO.png" style="width:75px">
                </a>
            </div>
            <ul class="nav navbar-nav">

                <li><a href="../index.php">Home</a></li>
                <li><a href="https://shsustudents.club/">Bulletin Board</a></li>
                <li><a href="tutor.php">TutorKats</a></li>
                <li><a href="../MarketplacePage.php">Marketplace</a></li>
                <li><a href="../campusDirect.php">CampusDirect</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (!isset($_SESSION['id'])) {
                        // If logged out
                        echo '<li><a>
                                  <form action="login-inc.php" method="post" style="color: blue">
                                  <input type="text" name="mailuid" placeholder="E-mail/Username">
                                  <input type="password" name="pwd" placeholder="Password">
                                  <button type="submit" name="login-submit">
                                    <span class="glyphicon glyphicon-log-in"></span> Login</button>
                                  </form>
                                  </a>
                              </li>';
                    }
                    else if (isset($_SESSION['id'])) {
                        // If logged in
                        echo '<li><a href="../UserProfilePage.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                              <li><a href="logout-inc.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>';
                    }
                ?>

            </ul>
        </div>
    </nav>
</header>