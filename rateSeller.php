<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11/20/2018
 * Time: 9:42 PM
 */
include_once 'includes/dbh-inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(!empty($_POST['userID']) && !empty($_POST['Rating']))
    {
        $userID = $_POST['userID'];
        $inputRating = $_POST['Rating'];
        $numRatings = $_POST['numSellerRatings'];
        $sellerRating = $_POST['sellerRating'];

        $newRating = $sellerRating * (float)$numRatings;
        $newRating = $newRating + $inputRating;
        $numRatings++;
        $newRating = $newRating / (float)$numRatings;

        $sql = "UPDATE user 
                SET sellerRating = ?, numSellerRatings = ?
                WHERE userID = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo "An error has occurred.";
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "dii", $newRating, $numRatings, $userID);
            mysqli_stmt_execute($stmt);
        }

        header("Location: MarketplacePage.php?rate=success");
    }
    else
    {
        header("Location: MarketplacePage.php?rate=fail");
    }
}