<?php
require 'includes/header.php';
?>
    <main>
        <div class="main-wrapper">
            <section class="main-container">

                <h2>KatsConnect Registration</h2>
                <?php
                // Here we create an error message if the user made an error trying to sign up.
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyfields") {
                        echo '<p class="registererror">Fill in all fields!</p>';
                    }
                    else if ($_GET["error"] == "invaliduidmail") {
                        echo '<p class="registererror">Invalid username and e-mail!</p>';
                    }
                    else if ($_GET["error"] == "invaliduid") {
                        echo '<p class="registererror">Invalid username!</p>';
                    }
                    else if ($_GET["error"] == "invalidmail") {
                        echo '<p class="registererror">Invalid e-mail!</p>';
                    }
                    else if ($_GET["error"] == "passwordcheck") {
                        echo '<p class="registererror">Your passwords do not match!</p>';
                    }
                    else if ($_GET["error"] == "usertaken") {
                        echo '<p class="registererror">Username is already taken!</p>';
                    }
                }
                // Here we create a success message if the new user was created.
                else if (isset($_GET["register"])) {
                    if ($_GET["register"] == "success") {
                        echo '<p class="registersuccess">Registration successful!</p>';
                    }
                }
                ?>

                <form class="register-form" action="includes/register-inc.php" method="post">

                    <?php
                    // Here we check if the user already tried submitting data.

                    // We check username.
                    if (!empty($_GET["uid"])) {
                        echo '<input type="text" name="uid" placeholder="Username" value="'.$_GET["uid"].'">';
                    }
                    else {
                        echo '<input type="text" name="uid" placeholder="Username">';
                    }

                    // We check e-mail.
                    if (!empty($_GET["mail"])) {
                        echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'">';
                    }
                    else {
                        echo '<input type="text" name="mail" placeholder="Please input a valid E-mail">';
                    }
                    ?>
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwd-repeat" placeholder="Re-enter password">
                    <input type="text" name="first" placeholder="First Name">
                    <button type="submit" name="register-submit">Register</button>
                </form>
            </section>
        </div>
    </main>
<?php
require 'includes/footer.php';
?>