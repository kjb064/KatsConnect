<?php
session_start();
require "includes/dbh-inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KatsConnect Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li>
                    <a href="index.php"><img border="0" alt="KatsConnect Home" src="shsubox.png" width="70" height="70"></a>
                </li>
            </ul>
            <div class="nav-login">

                <?php
                if (!isset($_SESSION['id'])) {
                    echo '<form action="includes/login-inc.php" method="post">
                        <input type="text" name="mailuid" placeholder="E-mail/Username">
                        <input type="password" name="pwd" placeholder="Password">
                        <button type="submit" name="login-submit">Login</button>
                        </form>
                     <a href="register.php" class="header-register">Register</a>';
                }
                else if (isset($_SESSION['id'])) {
                    echo '<form action="includes/logout-inc.php" method="post">
            <button type="submit" name="login-submit">Logout</button>
          </form>';
                }
                ?>


            </div>

        </div>
    </nav>
</header>
