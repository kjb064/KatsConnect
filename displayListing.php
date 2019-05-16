<?php
include_once 'includes\header.php';
include_once 'UserProfile.php';

//define variables
$listingID = $_GET['listingID'];
$title = "";
$price= "";
$description = "";
$user_instance = "";
$flag = "";
$result = "";

?>
<head>
    <link rel="stylesheet" type="text/css" href="css/UserProfileStyles.css">
</head>
<main>
    <div class = profile-container>
        <div class = paragraph-font>
            <p>Update Listing Information</p>

            <form action="" method="post">
                <?php
                //If the submit button is selected, grab the input from the textboxes and put it into variables
                //This section only does this for the generic info common to all listings
                $user_instance = new UserProfile();
                $result = $user_instance ->fetchGenericMarketplaceListing($listingID);
                if(isset($_POST['button'])) {
                    $title = $_POST['Title'];
                    $price = filter_var($_POST['Price'], FILTER_SANITIZE_NUMBER_FLOAT);
                    $description = $_POST['Description'];
                }

                //HTML for text boxes for the generic/misc listing
                ?>
            <label for="basic">Title:</label>
            <textarea id="basic" name="Title" cols = "50"><?php
                    echo $result['Title'];
                ?></textarea>
            <label for="basic">Price:</label>
            <textarea id="basic" name="Price" cols = "50"><?php
                    echo "$" . $result['Price'];
                ?></textarea>
            <label for="basic">Description:</label>
                <textarea id="basic" name="Description" rows = "5" cols = "50"><?php
                echo $result['Description'];
             ?></textarea>
                <?php
                //test flag for listing type and grab input
                //each of these sections start with the php to grab the user input after the submit button is selected
                //then below that, the code for the html textarea inputs are there.
                    $flag = $user_instance ->listingIsA($listingID);

                    //Housing flag
                    if($flag == 1) {
                        if (isset($_POST['button'])) {
                            //grabs input after submit button is pushed
                            $housingType = $_POST['housingType'];
                            $leaseLength = filter_var($_POST['leaseLength'], FILTER_SANITIZE_NUMBER_INT);
                            $numBed = filter_var($_POST['numBed'], FILTER_SANITIZE_NUMBER_INT);
                            $numBath = filter_var($_POST['numBath'], FILTER_SANITIZE_NUMBER_FLOAT);
                            $address = $_POST['address'];
                            $city = $_POST['city'];
                            $state = $_POST['state'];
                            $zip = filter_var($_POST['zip'], FILTER_SANITIZE_NUMBER_INT);

                        }

                        //Fetches info for listing from the db and auto populates the information in the textareas
                        $result = $user_instance->fetchHousingListing($listingID);
                        echo "<label for='basic'>Housing Type:</label>";
                        if ($result['housingType'] == 0) {
                            echo
                            "<select name = 'housingType'>
                                <option selected = 'selected' value= 0>apartment</option>
                                <option value= 1>single family house</option>
                                <option value= 2>duplex</option>
                                <option value= 3>dormitory</option>
                            </select>";
                        } elseif ($result['housingType'] == 1) {
                            echo
                            "<select name = 'housingType'>
                                <option value= 0>apartment</option>
                                <option selected = 'selected' value= 1>single family house</option>
                                <option value= 2>duplex</option>
                                <option value= 3>dormitory</option>
                            </select>";
                        } elseif ($result['housingType'] == 2) {
                            echo
                            "<select name = 'housingType'>
                                <option value= 0>apartment</option>
                                <option value= 1>single family house</option>
                                <option selected = 'selected' value= 2>duplex</option>
                                <option value= 3>dormitory</option>
                            </select>";
                        } elseif($result['housingType'] == 3) {
                            echo
                            "<select name = 'housingType'>
                                <option value= 0>apartment</option>
                                <option value= 1>single family house</option>
                                <option value= 2>duplex</option>
                                <option selected = 'selected' value= 3>dormitory</option>
                            </select>";
                        }else {
                            echo
                            "<select name = 'housingType'>
                                <option value= 0>apartment</option>
                                <option value= 1>single family house</option>
                                <option value= 2>duplex</option>
                                <option value= 3>dormitory</option>
                            </select>";
                        }
                        echo "<label for= basic>Lease Length:</label> <textarea id=basic  name= leaseLength cols = 50>" . $result['leaseLength'] . "</textarea>";
                        echo "<label for= basic>Beds:</label> <textarea id=basic  name= numBed cols = 50>" . $result['numBed'] . "</textarea>";
                        echo "<label for= basic>Baths:</label> <textarea id=basic  name= numBath cols = 50>" . $result['numBath'] . "</textarea>";
                        echo "<label for= basic>Street:</label> <textarea id=basic  name= address cols = 50>" . $result['address'] . "</textarea>";
                        echo "<label for= basic>City:</label> <textarea id=basic  name= city cols = 50>" . $result['city'] . "</textarea>";
                        echo "<label for= basic>State:</label> <textarea id=basic  name= state cols = 50>" . $result['state'] . "</textarea>";
                        echo "<label for= basic>Zip Code:</label> <textarea id=basic  name= zip cols = 50>" . $result['zip'] . "</textarea>";

                     //Tutor flag
                    }elseif($flag == 2){
                        if(isset($_POST['button'])) {
                            //grab input if submit button is clicked
                            $courseName = $_POST['courseName'];
                            $courseNum = filter_var($_POST['courseNum'], FILTER_SANITIZE_NUMBER_INT);
                        }

                        //print tutor info
                        $result = $user_instance ->fetchTutorListing($listingID);
                        echo "<label for= basic>Department abbreviation:</label> <textarea id=basic  name= courseName cols = 50>" . $result['courseName'] . "</textarea>";
                        echo "<label for= basic>Course Number:</label> <textarea id=basic  name= courseNum cols = 50>" . $result['courseNum'] . "</textarea>";


                    // Book flag
                    }elseif($flag == 0){
                        if(isset($_POST['button'])) {
                            //grab input if submit button is clicked
                            $courseName = $_POST['courseName'];
                            $courseNum = filter_var($_POST['courseNum'], FILTER_SANITIZE_NUMBER_INT);
                            $isbn = filter_var($_POST['isbn'],FILTER_SANITIZE_NUMBER_INT);
                            $bookTitle = $_POST['bookTitle'];
                            $authorName = $_POST['authorName'];

                        }

                        //print book info
                        $result = $user_instance ->fetchBookListing($listingID);
                        $isbn = $result['isbn'];
                        echo "<label for= basic>ISBN:</label> <textarea id=basic  name= isbn cols = 50>" . $result['isbn'] . "</textarea>";
                        echo "<label for= basic>Department abbreviation:</label> <textarea id=basic  name=courseName cols = 50>" . $result['courseName'] . "</textarea>";
                        echo "<label for= basic>Course Number:</label> <textarea id=basic  name= courseNum cols = 50>" . $result['courseNum'] . "</textarea>";
                        $result = $user_instance ->fetchBookInfo($isbn);
                        echo "<label for= basic>Title:</label> <textarea id=basic  name= bookTitle cols = 50>" . $result['title'] . "</textarea>";
                        echo "<label for= basic>Author:</label> <textarea id=basic  name= authorName cols = 50>" . $result['authorName'] . "</textarea><br>";
                    }



                ?>
                <! --- submit and delete buttons --- >
                    <input type="submit" class = btn name="button" value="Submit"/>
                    <input type= "submit" class = btn name="button2" value= "Delete Listing" />
                </form>

            <?php
           if(isset($_POST['button'])) {

               //Update Housing Listing
                if($flag == 1){
                    $result = $user_instance ->updateGenericMarketplaceListing($listingID, $title, $price, $description);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    $result = $user_instance ->updateHousingListing($listingID, $housingType, $leaseLength, $numBed, $numBath, $address, $city, $state, $zip);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    header("location: UserProfilePage.php");

                    //Update Tutor Listing
                }elseif($flag == 2){
                    $result = $user_instance ->updateGenericMarketplaceListing($listingID, $title, $price, $description);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    $result = $user_instance ->updateTutorListing($listingID, $courseName, $courseNum);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    header("location: UserProfilePage.php");

                //Update Book Listing
                }elseif($flag == 0){
                    $result = $user_instance ->updateGenericMarketplaceListing($listingID, $title, $price, $description);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    $result = $user_instance ->updateBookListing($listingID, $isbn, $courseName, $courseNum, $bookTitle, $authorName);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    header("location: UserProfilePage.php");

                }else{

                    //generic listing (misc listing)
                    $result = $user_instance ->updateGenericMarketplaceListing($listingID, $title, $price, $description);
                    if ($result){
                        echo "<p>Update successful</p>";
                    }else{echo "<p>Error: Could not update</p>";}
                    header("location: UserProfilePage.php");
                }
            }

            //delete listing if delete button is pushed and return to userProfilePage
            if(isset($_POST['button2'])) {
                    $user_instance->deleteListing($listingID);
                    header("location: UserProfilePage.php");
            }

            ?>



        </div>
    </div>
</main>
<?php
require 'includes\footer.php';
?>


