<?php

include_once 'includes/dbh-inc.php';
include_once 'includes/constants-inc.php';
include_once 'Listing.php';
include 'HousingAd.php';
include 'BookAd.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $listing;
    $allowListing = true;
    $test = "";
/*
    $error = false;
    foreach ($required as $field)
    {
        if(empty[$_POST[$field]])
        {
            $error = true;
        }
    }

    // Check Price...
    // If book, check CourseNum...
    // If housing, check zipCode, numBath, numBed...
*/


    if( isset($_POST['Flag']) && !empty($_POST['Flag']) )
    {

        switch ($_POST['Flag'])                        // Determine type of listing, set listing-specific properties
        {
            case "BOOK":
                $listing = new BookAd();
                //$listing->setListingFlag(BOOK);
                if( isset($_POST['BookTitle']) && !empty($_POST['BookTitle']) )
                {
                    $listing->setBookTitle($_POST['BookTitle']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "bookTitle";
                }

                if( isset($_POST['BookISBN']) && !empty($_POST['BookISBN']) )
                {
                    $listing->setBookISBN($_POST['BookISBN']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "bookISBN";
                }

                if( isset($_POST['BookAuthor']) && !empty($_POST['BookAuthor']) )
                {
                    $listing->setBookAuthor($_POST['BookAuthor']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "bookAuthor";
                }

                if( isset($_POST['CourseName']) && !empty($_POST['CourseName']) )
                {
                    $listing->setBookCourseName($_POST['CourseName']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "courseName";
                }

                if( isset($_POST['CourseNum']) && is_numeric($_POST['CourseNum']) )
                {
                    $listing->setBookCourseNum($_POST['CourseNum']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "courseNum";
                }
                break;

            case "HOUSING":
                $listing = new HousingAd();
                //$listing->setListingFlag(HOUSING);
                if( !empty($_POST['HousingType']) )
                {
                    switch ($_POST['HousingType'])
                    {
                        case "APARTMENT":
                            $listing->setHousingType(APARTMENT);
                            break;
                        case "SINGLE_FAMILY_HOUSE":
                            $listing->setHousingType(SINGLE_FAMILY_HOUSE);
                            break;
                        case "DUPLEX":
                            $listing->setHousingType(DUPLEX);
                            break;
                        case "DORMITORY":
                            $listing->setHousingType(DORMITORY);
                            break;
                    }
                }
                else
                {
                    $allowListing = false;
                    $test .= "housingType";
                }

                if( !empty($_POST['HousingAddress']) )
                {
                    $listing->setHousingAddress($_POST['HousingAddress']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "address";
                }

                if( isset($_POST['HousingLeaseLength']) && is_numeric($_POST['HousingLeaseLength']) )
                {
                    $listing->setHousingLeaseLength($_POST['HousingLeaseLength']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "leaseLength";
                }

                if( !empty($_POST['HousingAddress']) )
                {
                    $listing->setHousingAddress($_POST['HousingAddress']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "address";
                }

                if( !empty($_POST['HousingCity']) )
                {
                    $listing->setHousingCity($_POST['HousingCity']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "housingCity";
                }

                if( !empty($_POST['HousingState']) )
                {
                    $listing->setHousingState($_POST['HousingState']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "housingState";
                }

                if( !empty($_POST['HousingZipCode']) && is_numeric($_POST['HousingZipCode']) )
                {
                    $listing->setHousingZipCode($_POST['HousingZipCode']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "housingZipCode";
                }

                if( isset($_POST['HousingNumBed']) && is_numeric($_POST['HousingNumBed']) )
                {
                    $listing->setHousingNumBed($_POST['HousingNumBed']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "housingNumBed";
                }

                if( isset($_POST['HousingNumBath']) && is_numeric($_POST['HousingNumBath']) )
                {
                    $listing->setHousingNumBath($_POST['HousingNumBath']);
                }
                else
                {
                    $allowListing = false;
                    $test .= "housingNumBath";
                }

                break;

            case "MISC":
                $listing = new Listing();
                break;
        }

        $listing->setListingFlag($_POST['Flag']);

    }
    else
    {
        $allowListing = false;
        $test .= "flag";
    }
    // end if


    if( isset($_POST['Title']) && !empty($_POST['Title']) )
    {
        $listing->setListingTitle($_POST['Title']);
    }
    else
    {
        $test .= "title";
        $allowListing = false;
    }


    if( isset($_POST['userID']) && is_numeric($_POST['userID']) )
    {                                                                // Changed from Author to userID
        $listing->setListingCreator($_POST['userID']);
    }
    else
    {
        $test .= "userID";
        $allowListing = false;
    }

    if( isset($_POST['Price']) && is_numeric($_POST['Price']) ) // "is_numeric" here since want to allow price of 0
    {
        $listing->setListingPrice($_POST['Price']);
    }
    else
    {
        $test .= "price";
        $allowListing = false;
    }

    if( isset($_POST['Description']) && !empty($_POST['Description']) )
    {
        $listing->setListingDescription($_POST['Description']);
    }
    else
    {
        $test .= "description";
        $allowListing = false;
    }

    /*
     * Here we determine if an image was provided. If so, the image's name is modified to include a timestamp in microseconds.
     */
    if(file_exists($_FILES['Image']['tmp_name']) || is_uploaded_file($_FILES['Image']['tmp_name']))
    {
        $path_parts = pathinfo($_FILES['Image']['name']);   // Get the image file's name without the extension

        // The name is appended with an "_" followed by the current time in microseconds (in float form).
        // The extension is then added back on.
        $image_path = $path_parts['filename'] . "_" . microtime(true) . "." . $path_parts['extension'];

        // The file is sent to its new upload location
        move_uploaded_file($_FILES['Image']['tmp_name'], "images/marketplace/" . $image_path);
        $listing->setListingImage($image_path);

    }

    if($allowListing)               // insert into database only if all required fields submitted
    {
        $sql = "INSERT INTO listing (userID, listingImage, Title, Description, Date, Price, Flag) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            echo "An error has occurred.";
        }
        else
        {
            $title = $listing->getListingTitle();
            $image = $listing->getListingImage();
            $author = $listing->getListingCreator();    // author contains the userID
            $price = $listing->getListingPrice();
            $datetime = $listing->getListingDate();
            $description = $listing->getListingDescription();
            $flag = $listing->getListingFlag();

            mysqli_stmt_bind_param($stmt, "issssdi", $author, $image, $title, $description, $datetime, $price, $flag);

            if(mysqli_stmt_execute($stmt))
            {
                $lastID = mysqli_insert_id($conn);
                $test .= "insert=success";
                $test .= mysqli_stmt_error($stmt);
            }
            else
            {
                $test .= mysqli_stmt_error($stmt);
            }

        } // end if

        switch ($_POST['Flag'])
        {

            case "BOOK":
                $sql = "INSERT INTO bookad (listingID, isbn, courseName, courseNum) VALUES (?, ?, ?, ?);";

                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    echo "An error has occurred.";
                    $test .= "prepareError";
                }
                else
                {
                    $bookISBN = $listing->getBookISBN();
                    $courseName = $listing->getBookCourseName();
                    $courseNum = $listing->getBookCourseNum();

                    mysqli_stmt_bind_param($stmt, "issi", $lastID, $bookISBN, $courseName, $courseNum);
                    if(mysqli_stmt_execute($stmt))
                    {
                        $test .= "bookSuccess";
                    }
                    else
                    {
                        $test .= mysqli_stmt_error($stmt);
                    }

                    // Insert record in "book" table if isbn doesn't exist yet
                    $sql = "SELECT FROM book WHERE isbn = " . $bookISBN . ";";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) == 0)
                    {
                        $sql = "INSERT INTO book (isbn, title, authorName) VALUES (?, ?, ?);";
                        if(!mysqli_stmt_prepare($stmt, $sql))
                        {
                            echo "An error has occurred.";
                            $test .= "prepareError";
                        }
                        else
                        {
                          $bookAuthor = $listing->getBookAuthor();
                          $bookTitle = $listing->getBookTitle();

                          mysqli_stmt_bind_param($stmt, "sss", $bookISBN, $bookTitle, $bookAuthor);
                          mysqli_stmt_execute($stmt);

                        } // end if
                    }
                    //else
                        // {Do nothing since record exists}
                    //end if
                } // end if

                break;

            case "HOUSING":

                $sql = "INSERT INTO housingad (listingID, housingType, leaseLength, numBath, numBed, address, city, state, zip) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    echo "An error has occurred";
                    $test .= "prepareError";
                }
                else
                {
                    $housingType = $listing->getHousingType();
                    $leaseLength = $listing->getHousingLeaseLength();
                    $numBath = $listing->getHousingNumBath();
                    $numBed = $listing->getHousingNumBed();
                    $address = $listing->getHousingAddress();
                    $city = $listing->getHousingCity();
                    $state = $listing->getHousingState();
                    $zip = $listing->getHousingZipCode();

                    mysqli_stmt_bind_param($stmt, "iiiiisssi", $lastID, $housingType, $leaseLength, $numBath,
                        $numBed, $address, $city, $state, $zip);

                    if(mysqli_stmt_execute($stmt))
                    {
                        $test .= "housingSuccess";
                    }
                    else
                    {
                        $test .= mysqli_stmt_error($stmt);
                    }

                }
                break;

        } // end switch


        header("Location: MarketplacePage.php?". $test);
    }
    else
    {
        // Error has occurred
        header("Location: MarketplacePage.php?insert=fail". $test);
    }// end if


}// end if

