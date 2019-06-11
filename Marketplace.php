<?php
/*
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11/21/2018
 * Time: 4:17 PM
 */

include_once 'includes/constants-inc.php';

class Marketplace
{
    private function fetchHousingListings($conn)    
    {

        $query = "SELECT listing.listingImage, listing.Title, listing.userID, user.emailUser, user.firstname, user.lastname, user.sellerRating, user.numSellerRatings, 
            listing.Date, listing.Description, listing.Price, housingAd.HousingType, housingAd.LeaseLength, 
            housingAd.NumBath, housingAd.NumBed, housingAd.Address, housingAd.City, housingAd.State, housingAd.Zip 
                  FROM listing, housingad, user 
                  WHERE listing.flag = ".HOUSING." 
                  AND listing.ListingID=housingad.listingID
                  AND listing.userID = user.userID";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    private function fetchMiscListings($conn)   
    {
        $query = "SELECT listing.listingImage, listing.userID, user.firstname, user.lastname, user.emailUser, user.sellerRating, 
                    user.numSellerRatings,
                    listing.Title, listing.Description, listing.Price, listing.Date 
                  FROM listing, user 
                  WHERE listing.flag = " . MISC . "
                  AND listing.userID = user.userID";

        $result = mysqli_query($conn, $query);
        return $result;
    }

    private function fetchBookListings($conn)   
    {
        $query = "SELECT listing.listingImage, listing.Title, listing.userID, user.firstname, user.lastname, user.emailUser, user.sellerRating, user.numSellerRatings,
                    listing.Date, listing.Description, listing.Price, bookAd.ISBN, 
                    bookAd.CourseName, bookAd.CourseNum, book.authorName, book.title
                  FROM listing, bookAd, book, user
                  WHERE listing.Flag = " . BOOK . "
                  AND listing.ListingID = bookAd.ListingID
                  AND bookAd.ISBN = book.ISBN
                  AND listing.userID = user.userID";

        $result = mysqli_query($conn, $query);
        return $result;
    }

    private function generateRatingForm($userID, $numSellerRatings, $sellerRating)
    {
        echo "<div class='col-xs-1'>";
        echo "<form method='post' action='rateSeller.php'>";
            echo "<input type='number' id='Rating' name='Rating' class='form-control form-control-sm' value='5' min='1' max='5'>";
            echo "<button type='submit' class=\"btn btn-success btn-sm\">Rate</button>";
            // "hidden" fields below pass userID, numSellerRatings, and sellerRating to $_POST as well as the submitted input
            echo '<input type="hidden" id="userID" name="userID" value="'. htmlspecialchars($userID) .'">';
            echo '<input type="hidden" id="numSellerRatings" name="numSellerRatings" value="'. htmlspecialchars($numSellerRatings).'">';
            echo '<input type="hidden" id="sellerRating" name="sellerRating" value="'. htmlspecialchars($sellerRating).'">';
        echo "</form>";
        echo "</div>";
        echo "</td>";
    }

    public function generateMiscTable($conn)
    {
        $result = $this->fetchMiscListings($conn);
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";

            if($row['listingImage'] == ''){                     // Determines if an image will be displayed or not
                echo "<td>" . "No Image Provided" . "</td>";
            }
            else
            {
                echo "<td>";
                echo "<img src='images/marketplace/" . $row['listingImage'] . "' alt='Listing Image' height='100' width='100'>";
                echo "</td>";
            }

            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";

            if($row['sellerRating'] == 0)
            {
                echo "<td>" . "No rating" . "</td>";    // Sellers without ratings have this message
            }
            else
            {
                echo "<td>" . round($row['sellerRating'], 1) . "</td>";
            }

            echo "<td>" . $row['emailUser'] . "</td>";
            echo "<td>" . "$" . $row['Price'] . "</td>";

            $time = strtotime($row['Date']);
            $formattedTime = date("m/d/y g:i A", $time);    // EX: 11/17/18 1:01 AM
            echo "<td>" . $formattedTime . "</td>";

            echo "<td>" . $row['Description'] . "</td>";

            //Each row contains a cell for rating the seller using numerical input from user
            echo "<td>";
            $this->generateRatingForm($row['userID'], $row['numSellerRatings'], $row['sellerRating']);
            echo "</td>";

            echo "</tr>";

        } // end while

    } // end generateMiscTable

    public function generateHousingTable($conn)
    {
        $result = $this->fetchHousingListings($conn);
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";

            if($row['listingImage'] == ''){                     // Determines if an image will be displayed or not
                echo "<td>" . "No Image Provided" . "</td>";
            }
            else
            {
                echo "<td>";
                echo "<img src='images/marketplace/" . $row['listingImage'] . "' alt='Listing Image' height='100' width='100'>";
                echo "</td>";
            }


            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
            if($row['sellerRating'] == 0)
            {
                echo "<td>" . "No rating" . "</td>";    // Sellers without ratings have this message
            }
            else
            {
                echo "<td>" . round($row['sellerRating'], 1) . "</td>";
            }
            echo "<td>" . $row['emailUser'] . "</td>";
            echo "<td>" . "$" . $row['Price'] . "</td>";

            $time = strtotime($row['Date']);
            $formattedTime = date("m/d/y g:i A", $time);    // EX: 11/17/18 1:01 AM
            echo "<td>" . $formattedTime . "</td>";

            $housingType = $row['HousingType'];
            switch ($housingType)                   // Determines housingType, identifies w/ string name
            {
                case APARTMENT:
                    $housingType = "Apartment";
                    break;
                case SINGLE_FAMILY_HOUSE:
                    $housingType = "Single-family house";
                    break;
                case DUPLEX:
                    $housingType = "Duplex";
                    break;
                case DORMITORY:
                    $housingType = "Dormitory";
                    break;
            }

            echo "<td>" . $housingType . "</td>";     // Print the variable, not the array element

            echo "<td>" . $row['LeaseLength'] . "</td>";
            echo "<td>" . $row['NumBath'] . "</td>";
            echo "<td>" . $row['NumBed'] . "</td>";
            echo "<td>" . $row['Address'] . ", " . $row['City'] . ", " . $row['State'] . "</td>";
            echo "<td>" . $row['Zip'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";

            //Each row contains a cell for rating the seller using numerical input from user
            echo "<td>";
            $this->generateRatingForm($row['userID'], $row['numSellerRatings'], $row['sellerRating']);
            echo "</td>";

            echo "</tr>";
        }

    } // end generateHousingTable

    public function generateBookTable($conn)
    {
        $result = $this->fetchBookListings($conn);
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";

            if($row['listingImage'] == ''){                     // Determines if an image will be displayed or not
                echo "<td>" . "No Image Provided" . "</td>";
            }
            else
            {
                echo "<td>";
                echo "<img src='images/marketplace/" . $row['listingImage'] . "' alt='Listing Image' height='100' width='100'>";
                echo "</td>";
            }

            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
            if($row['sellerRating'] == 0)
            {
                echo "<td>" . "No rating" . "</td>";    // Sellers without ratings have this message
            }
            else
            {
                echo "<td>" . round($row['sellerRating'], 1) . "</td>";
            }
            echo "<td>" . $row['emailUser'] . "</td>";
            echo "<td>" . "$" . $row['Price'] . "</td>";

            $time = strtotime($row['Date']);
            $formattedTime = date("m/d/y g:i A", $time);    // EX: 11/17/18 1:01 AM
            echo "<td>" . $formattedTime . "</td>";

            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['authorName'] . "</td>";
            echo "<td>" . $row['ISBN'] . "</td>";
            echo "<td>" . $row['CourseName'] . "</td>";
            echo "<td>" . $row['CourseNum'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";

            //Each row contains a cell for rating the seller using numerical input from user
            echo "<td>";
            $this->generateRatingForm($row['userID'], $row['numSellerRatings'], $row['sellerRating']);
            echo "</td>";

            echo "</tr>";

        } // end while

    } // end generateBookTable

} // end Marketplace
