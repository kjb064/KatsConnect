<?php
include_once 'includes\header.php';
include_once 'UserProfile.php';
?>
    <head>
        <link rel="stylesheet" type="text/css" href="css/UserProfileStyles.css">
    </head>
    <main>
            <div class = profile-container>
                <?php
                    $userID = $_SESSION['id'];
                    $user_instance = new UserProfile();
                    $user_instance -> setUserID($userID);

                    //Check if account exists. If it does, display profile
                    //If account does not exist, print "account does not exist"
                    If($user_instance ->accountDoesExist($userID)) {

                        //fetch profile information and store it in variables for display
                        $firstName = $user_instance->fetchUserFirstName();
                        $lastName = $user_instance->fetchUserLastName();
                        $tutorRating = $user_instance->fetchUserTutorRating();
                        $sellerRating = $user_instance->fetchUserSellerRating();
                        $status = $user_instance->fetchUserStatus();
                        if ($status == 0) {
                            $status = 'student';
                        } elseif ($status == 1) {
                            $status = 'faculty';
                        } elseif ($status == 2) {
                            $status = 'alumni';
                        } else $status = 'unknown';

                        //start of profile
                        echo "<div class = 'paragraph-font'>";
                        echo "<div class = row>";
                        echo "<div class = headerContainer>";
                        echo "<p>  </p>";
                        echo "<p>" . $firstName . " " . $lastName . "'s Profile</p>";
                        echo "</div>";
                        echo "<div class = column>";

                        if (!$user_instance->userProfilePictureIsEmpty($userID)) {
                            $profilePicture = $user_instance->fetchUserProfilePhoto($userID);
                            echo "<img src='images/profile/" . $profilePicture . "' alt= 'Profile Picture'  height= '100' width='100'>";
                        } else echo "<img src='images/profile/defaultProfilePic.jpg' alt= 'Profile Picture'  height= '100' width='100'>";

                        ?>
                        <?php
                        echo "<p>  </p>";
                        echo "<a class = btn href=editUserProfileInfo.php?userID=" . $userID . ">edit profile</a>";

                        echo "</div>";
                        echo "<div class = column>";

                        echo "<p>" . "Tutor Rating: " . $tutorRating . "</p>";
                        echo "<p>" . "Seller Rating: " . $sellerRating . "</p>";
                        echo "<p>" . "Status: " . $status . "</p>";

                        //below, market listings and tutor listings are displayed in columns
                        echo "</div>";
                        echo "</div>";
                        echo "<div class = row style='background-color:#aaa;'>";
                        echo "<div class= 'column'>";

                        $user_instance->fetchUserMarketListings();

                        echo "</div>";
                        echo "<div class='column'>";

                        $user_instance->fetchUserTutorListings();

                       echo "</div>";
                       echo "</div>";
                       echo "</div>";
                    }else echo "<p>Account does not exist</p>";
                ?>

                <?php
               /* if (!isset($_SESSION['id'])) {
                    echo '<p class="login-status">You are logged out!</p>';
                }
                else  {
                    echo '<p class="login-status">You are logged in!</p>';
                } */
                ?>
            </div>
    </main>

<?php
require 'includes\footer.php';
?>