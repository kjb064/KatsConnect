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
            <p>Delete Account</p>
            <?php
            $user_instance = new UserProfile();
            ?>
            <!--- Confirm and cancel buttons --->
            <form action = '' method= 'post'>
                <input type = 'submit' class = btn name = 'confirmDeleteAccount' value = 'Confirm Delete Account'/>
                <?php echo "<a class = btn href=editUserProfileInfo.php?userID=" . $userID . ">Cancel</a>"; ?>
            </form>

            <!--- deletes account and returns to empty profile page --->
            <?php
            if(isset($_POST['confirmDeleteAccount'])) {
                $result = $user_instance ->deleteAccount($userID);
                header("location: UserProfilePage.php");
                //redirect to home page and log out
            }
            ?>



        </div>
    </div>
</main>
<?php
require 'includes\footer.php';
?>