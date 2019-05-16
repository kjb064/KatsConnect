<?php
include 'includes\dbh.class.php';

class UserProfile extends Dbh
{

   private $sellerRating;
   private $tutorRating;
   private $status;
   private $profilePicture;
   private $userID;
   private $firstName;
   private $lastName;

   public function setUserID($id) {
       $this -> userID = $id;
   }

   public function fetchUserFirstName() {
       $userID = $this -> userID;
       $sql = "SELECT firstname FROM user WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $resultString = $result['firstname'];
       $this -> firstName = $resultString;
       return $this -> firstName;
   }

   public function fetchUserLastName() {
       $userID = $this -> userID;
       $sql = "SELECT lastname FROM user WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $resultString = $result['lastname'];
       $this -> lastName = $resultString;
       return $this -> lastName;
   }

   public function fetchUserProfilePhoto($id) {
       $sql = "SELECT * FROM user WHERE userID = " . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $this -> profilePicture = $result['profilePicture'];
       return $this -> profilePicture;

   }

   public function fetchUserSellerRating() {
       $userID = $this -> userID;
       $sql = "SELECT sellerRating FROM user WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $resultString = $result['sellerRating'];
       $this -> sellerRating = $resultString;
       return $this -> sellerRating;
   }

   public function fetchUserTutorRating() {
       $userID = $this -> userID;
       $sql = "SELECT tutorRating FROM user WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $resultString = $result['tutorRating'];
       $this -> tutorRating = $resultString;
       return $this -> tutorRating;
   }

   public function fetchUserStatus() {
       $userID = $this -> userID;
       $sql = "SELECT status FROM user WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $resultString = $result['status'];
       $this -> status = $resultString;
       return $this -> status;
   }

   //This function prints out each market listing, excluding tutor listings
   public function fetchUserMarketListings() {
       $userID = $this -> userID;
       //query listing table for generic attributes and assign to variables to be displayed
       $sql = "SELECT * FROM listing WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);

       echo "<p><b><u>Marketplace Listings</u></b></p>";
       while($result = mysqli_fetch_assoc($query)){
           if($result['flag'] != 2){
               $title = $result['Title'];
               $price = $result['Price'];
               $description = $result['Description'];
               $listingID = $result['ListingID'];

               //display variables on listing card
               echo "<div class = card style = background-color:#FFFFFF>";
               echo "<div class = container>";
               echo "<p align = center><b>" . $title . "</b></p>";
               echo "<div class = detailsContainer>";
               echo "<p>Price: $" . $price. "</p>";
               if($result['flag'] == 0){
                   //book
                   $sql = "SELECT * FROM bookAd WHERE listingID =" . $listingID;
                   $bookQuery = $this -> connect() -> query($sql);
                   $bookResult = mysqli_fetch_assoc($bookQuery);
                   $isbn = $bookResult['isbn'];
                   $sql = "SELECT * FROM book WHERE isbn =" . $isbn;
                   $actualBookQuery = $this -> connect() -> query($sql);
                   $actualBookResult = mysqli_fetch_assoc($actualBookQuery);
                   $courseName = $bookResult['courseName'];
                   $courseNum = $bookResult['courseNum'];
                   $bookTitle = $actualBookResult['title'];
                   $bookAuthor = $actualBookResult['authorName'];
                   echo "<p>ISBN: " . $isbn . "</p>";
                   echo "<p>Course: " . $courseName . " " . $courseNum . "</p>";
                   echo "<p>Title: " . $bookTitle . "</p>";
                   echo "<p>Author: "  . $bookAuthor . "</p>";
               }elseif($result['flag'] == 1) {
                   //house
                   $sql = "SELECT * FROM housingAd WHERE listingID =" . $listingID;
                   $housingQuery = $this -> connect() -> query($sql);
                   $housingResult = mysqli_fetch_assoc($housingQuery);
                   $housingType = $housingResult['housingType'];
                   $leaseLength = $housingResult['leaseLength'];
                   $numBath = $housingResult['numBath'];
                   $numBed = $housingResult['numBed'];
                   $address = $housingResult['address'];
                   $city = $housingResult['city'];
                   $state = $housingResult['state'];
                   $zip = $housingResult['zip'];
                   if($housingType == 0){
                       $housingType = 'apartment';
                   }elseif($housingType == 1){
                       $housingType = 'single family home';
                   }elseif($housingType == 2){
                       $housingType = 'duplex';
                   }elseif($housingType == 3){
                       $housingType = 'dormitory';
                   }else $housingType = 'unknown';

                   echo "<p>Housing Type: " . $housingType . "</p>";
                   echo "<p>Lease Length: " . $leaseLength . "</p>";
                   echo "<p>Beds: " . $numBed . "</p>";
                   echo "<p>Baths: "  . $numBath . "</p>";
                   echo "<p>Address: " . $address . ", " . $city . ", " . $state . ", " . $zip . "</p>";
               }
               echo "<p></p>";
               echo "<p><i>" . $description . "</i></p>";
               echo "</div>";
               echo "<a class = btn href=displayListing.php?listingID=" . $listingID . ">edit</a>";
               echo "</div>";
               echo "</div>";



           }
       }
   }

   //prints out tutor listings exclusively
   public function fetchUserTutorListings() {
       $userID = $this -> userID;
       //query the listing table for the generic attributes and assign them to variables to be displayed
       $sql = "SELECT * FROM listing WHERE userID = " . $userID;
       $query = $this -> connect() -> query($sql);

       echo "<p><b><u>Tutor Listings </u></b></p>";
       while($result = mysqli_fetch_assoc($query)) {
           if ($result['flag'] == 2) {
               $title = $result['Title'];
               $price = $result['Price'];
               $description = $result['Description'];
               $listingID = $result['ListingID'];
               //query the tutor database for special tutor attributes and assign them to variables to be displayed
               $sql = "SELECT * FROM tutorAd WHERE listingID = " . $listingID;
               $tutorQuery = $this -> connect() -> query($sql);
               $tutorResult = mysqli_fetch_assoc($tutorQuery);
               $courseName = $tutorResult['courseName'];
               $courseNum = $tutorResult['courseNum'];

               //display variables on listing card
               echo "<div class = card style = background-color:#FFFFFF>";
               echo "<div class = container>";
               echo "<p align = 'center'><b>" . $title . "</b></p>";
               echo "<div class = detailsContainer>";
               echo "<p>Price: $" . $price. "</p>";
               echo "<p>Course: " . $courseName . " " . $courseNum . "</p>";
               echo "<p></p>";
               echo "<p><i>" . $description . "</i></p>";
               echo "</div>";
               //echo "<p><input type= button class=btn1 value= edit /></p>";
               echo "<a class = btn href=displayListing.php?listingID=" . $listingID . ">edit</a>";
               //echo "<p><input type= button class = btn value= delete /></p>";
               echo "</div>";
               echo "</div>";

           }
       }
   }

   //takes a listingId and returns what category it belongs to
   public function listingIsA($id){
       $sql = "SELECT * FROM listing WHERE ListingID = " . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $flag = $result['flag'];
       return $flag;

   }

   public function fetchGenericMarketplaceListing($id){
       $sql = "SELECT * FROM listing WHERE ListingID =" . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       return $result;
   }

   public function fetchHousingListing($id){
       $sql = "SELECT * FROM housingAd WHERE listingID =" . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       return $result;
   }

   public function fetchTutorListing($id){
       $sql = "SELECT * FROM tutorAd WHERE listingID =" . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       return $result;
   }

   public function fetchBookListing($id){
       $sql = "SELECT * FROM bookAd WHERE listingID =" . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       return $result;
   }

   public function fetchBookInfo($isbn){
       $sql = "SELECT * FROM book WHERE isbn =" . $isbn;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       return $result;
   }

   public function fetchUserInfo($id){
       $sql = "SELECT * FROM user WHERE userID =" . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       return $result;
   }

   public function updateGenericMarketplaceListing($listingID, $title, $price, $description){
       $sql = "UPDATE listing SET Title = '" . $title ."' , Price = " . $price . " , Description = '" . $description.
           "' WHERE ListingID = '" . $listingID . "';";
       $link = $this -> connect();
       $query = mysqli_query($link, $sql);
       return $query;

   }

   public function updateHousingListing($listingID, $housingType, $leaseLength, $numBed, $numBath, $address, $city, $state, $zip){
       $sql = "UPDATE housingAd SET housingType = '" . $housingType . "' , leaseLength = '" . $leaseLength .
           "' , numBed = '" . $numBed . "' , numBath = '" . $numBath . "' , address = '" . $address .
           "' , city = '" . $city . "' , state = '" . $state . "' , zip = '" . $zip . "' WHERE listingID = '" . $listingID . "';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function updateTutorListing($listingID, $courseName, $courseNum){
       $sql = "UPDATE tutorAd SET courseName = '" . $courseName . "' , courseNum = '" . $courseNum . "' WHERE listingID = '" . $listingID . "';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function updateBookListing($listingID, $isbn, $courseName, $courseNum, $bookTitle, $authorName){
       $this -> updateBookInfo($isbn, $bookTitle, $authorName);
       $sql = "UPDATE bookAd SET isbn = '" . $isbn . "' , courseName = '" . $courseName . "' , courseNum = '" . $courseNum .
           "' WHERE listingID = '" . $listingID . "';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }
   public function updateBookInfo($isbn, $bookTitle, $authorName){
       $sql = "UPDATE book SET title = '" . $bookTitle . "' , author = '" . $authorName .  "' WHERE isbn = '" . $isbn . "';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function updateUserInfo($userID, $firstName, $lastName, $status, $phone_number){
       $sql = "UPDATE user SET firstname = '" . $firstName . "' , lastname = '" . $lastName . "' , status = '" . $status .
           "' , phonenumber = '" . $phone_number . "' WHERE userID = '" . $userID . "';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function updateUserPassword($userID, $password){
       $sql = "UPDATE user SET password = '" . $password . "' WHERE userID = '" . $userID . "';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function updateUserProfilePicture($id, $profilePicture) {
       $sql = "UPDATE user SET profilePicture = '" . $profilePicture . "' WHERE userID = '" . $id ."';";
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function userProfilePictureIsEmpty($id){
       $sql = "SELECT * FROM user WHERE userID = " . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       if($result['profilePicture'] == ""){
           return true;
       }else return false;

   }

   public function deleteAccount($id) {
       echo "DELETE ACCOUNT FUNCTION CALLED";
        //selects the users listings
       $sql = "SELECT * FROM listing WHERE userID = " . $id;
       $query = $this -> connect() -> query($sql);

       //deletes litings by type in each table
       while($result = mysqli_fetch_assoc($query)){
           $listingID = $result['ListingID'];

           //deletes book listing
           if($result['flag'] == 0){
               $sql = "DELETE FROM bookAd WHERE listingID =" . $listingID;
               $bookQuery = $this -> connect() -> query($sql);

           //deletes housing listing
           }elseif($result['flag' == 1]){
               $sql = "DELETE FROM housingAd WHERE listingID =" . $listingID;
               $housingQuery = $this -> connect() -> query($sql);

           //deletes tutor listing
           }elseif($result['flag'] == 2){
               $sql = "DELETE FROM tutorAd WHERE listingID = " . $listingID;
               $tutorQuery = $this -> connect() -> query($sql);
           }

           //deletes the listing in the listings table
           $sql = "DELETE FROM listing WHERE listingID =" . $listingID;
           $listingQuery = $this -> connect() -> query($sql);
       }

       //deletes all user information in the users table
       $sql = "DELETE FROM user WHERE userID =" . $id;
       $query = $this -> connect() -> query($sql);
       return $query;
   }

   public function deleteListing($id){

       $sql = "SELECT * FROM listing WHERE listingID =" . $id;
       $query = $this -> connect() -> query($sql);
       $result = mysqli_fetch_assoc($query);
       $listingID = $result['ListingID'];

           //deletes book listing
           if ($result['flag'] == 0) {
               $sql = "DELETE FROM bookAd WHERE listingID =" . $listingID;
               $bookQuery = $this->connect()->query($sql);

               //deletes housing listing
           } elseif ($result['flag' == 1]) {
               $sql = "DELETE FROM housingAd WHERE listingID =" . $listingID;
               $housingQuery = $this->connect()->query($sql);

               //deletes tutor listing
           } elseif ($result['flag'] == 2) {
               $sql = "DELETE FROM tutorAd WHERE listingID = " . $listingID;
               $tutorQuery = $this->connect()->query($sql);
           }

           //deletes the listing in the listings table
           $sql = "DELETE FROM listing WHERE listingID =" . $listingID;
           $listingQuery = $this->connect()->query($sql);

   }

   public function accountDoesExist($id){
       $sql = "SELECT * FROM user WHERE userID = " . $id;
       $query = $this -> connect() -> query($sql);
       if(mysqli_num_rows($query)){
           return true;
       }else return false;

   }

}