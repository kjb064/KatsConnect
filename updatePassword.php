<?php
include_once 'includes/header.php';
include_once 'UserProfile.php';

$userID = $_GET['userID'];
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/UserProfileStyles.css">
</head>
<main>
    <div class = profile-container>
        <div class = paragraph-font>
            <p>Change Password</p>
            <form action="" method="post">
                <?php

                //get current password from db
                $user_instance = new UserProfile();
                $result = $user_instance ->fetchUserInfo($userID);

                if(isset($_POST['button'])) {
                    //if submit button is clicked, set variables with user input
                    $oldPassword= $_POST['oldPassword'];
                    $newPassword1= $_POST['newPassword1'];
                    $newPassword2= $_POST['newPassword2'];
                }
                ?>

                <! --- textareas for user input --- >
                <label for="basic">Current password:</label>
                <input type = "password" id = "basic" name = "oldPassword">
                <label for="basic">New password:</label>
                <input type = "password" id="basic" name="newPassword1">
                <label for="basic">Confirm new password:</label>
                <input type = "password" id="basic" name="newPassword2">
                <p> </p>
                <input type="submit" name="button" class = btn value="Update Password"/>
            </form>
            <?php

            //if submit is clicked, compare old passwords and compare new password for typing errors
            //then update db with new password
            if(isset($_POST['button'])) {
                $dbPassword = $result['password'];
                $oldPassword = md5($oldPassword);
                if($oldPassword == $dbPassword){
                    if($newPassword1 == $newPassword2){
                        $newPassword = md5($newPassword1);
                        $result = $user_instance -> updateUserPassword($userID, $newPassword);
                        echo "<p>Update Successful</p>";
                        header("location: UserProfilePage.php");
                    } else echo "<p>Passwords do not match</p>";
                }else echo "<p>Please input correct current password</p>";
            }
            ?>
        </div>
    </div>
</main>
<?php
require 'includes\footer.php';
?>
