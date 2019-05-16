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
            <p>Update Profile Information</p>

            <?php
            //get user profile information from the db and auto populate the textareas
            $user_instance = new UserProfile();
            $result = $user_instance ->fetchUserInfo($userID);

            //Upload profile picture
            if(isset($_POST['upload'])) {
                if(isset($_FILES['photo']['name'])) {

                    move_uploaded_file($_FILES['photo']['tmp_name'], "images/profile/" . $_FILES['photo']['name']);
                    $user_instance ->updateUserProfilePicture($userID, $_FILES['photo']['name']);
                    header("location: UserProfilePage.php");

                }else echo "<p>Please select a photo to upload</p>";
            }
            ?>

            <! --- Profile picture upload form --- >
            <form action="" method="post" enctype="multipart/form-data">
                <input type= 'file' name= 'photo' id = 'photo'>
                <input type= "submit" name= "upload" value= "Upload Profile Photo">
            </form>

            <form action="" method="post">
                <?php
                if(isset($_POST['button'])) {
                    //If submit button is pushed, set variables with user input
                    $firstName= $_POST['firstname'];
                    $lastName = $_POST['lastname'];
                    $status = $_POST['status'];
                    $phone_number = filter_var($_POST['phonenumber'], FILTER_SANITIZE_NUMBER_INT);
                }
                ?>

                <! --- Textareas for profile information --- >
                <label for="basic">First name:</label>
                <textarea id="basic" name="firstname" cols = "50"><?php
                    echo $result['firstname'];
                    ?></textarea>
                <label for="basic">Last name:</label>
                <textarea id="basic" name="lastname" cols = "50"><?php
                    echo $result['lastname'];
                    ?></textarea>
                <label for="basic">Status:</label><?php
                if($result['status'] == 0){
                    echo
                    "<select name = 'status'>
                    <option selected = 'selected' value= 0>student</option>
                    <option value= 1>faculty</option>
                    <option value= 2>alumni</option>
                    </select>";
                }elseif($result['status'] == 1){
                    echo
                    "<select name = 'status'>
                    <option value= 0>student</option>
                    <option selected = 'selected' value= 1>faculty</option>
                    <option value= 2>alumni</option>
                    </select>";
                }elseif($result['status'] == 2){
                    echo
                    "<select name = 'status'>
                    <option value= 0>student</option>
                    <option value= 1>faculty</option>
                    <option selected = 'selected' value= 2>alumni</option>
                    </select>";
                }else{
                    echo
                    "<select name = 'status'>
                    <option value= 0>student</option>
                    <option value= 1>faculty</option>
                    <option value= 2>alumni</option>
                    </select>";
                }
                ?>
                <label for="basic">Phone Number:</label>
                <textarea id="basic" name="phonenumber" cols = "50"><?php
                    echo $result['phonenumber'];
                    ?></textarea>
                <input type="submit" class = btn name="button" value="Submit"/>
                <p>  </p>
                <?php echo "<a class = btn href=updatePassword.php?userID=" . $userID . ">Change Password</a>";
                echo "<p></p>";
                echo "<a class = btn href=deleteAccount.php?userID=" . $userID . ">Delete Account</a>";?>
            </form>
            <?php

            //if submit is clicked, update the profile information in the db
            if(isset($_POST['button'])) {
                $result = $user_instance ->updateUserInfo($userID, $firstName, $lastName, $status, $phone_number);
                if($result){
                    echo "</p> Update successful </p>";
                }else echo "</p> Unable to update </p>";
                header("location: UserProfilePage.php");
            }
            ?>
        </div>
    </div>
</main>
<?php
require 'includes\footer.php';
?>
