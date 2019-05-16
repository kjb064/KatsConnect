<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 11/12/2018
 * Time: 1:16 PM
 */

/*
 * Constants for setting user status upon registration
 */
define('STUDENT', 0);
define('FACULTY', 1);
define('ALUMNI', 2);

// Use caution with these...
define('MODERATOR', 3);
define('ADMIN', 4);

/*
 * Constants for setting Listing flag
 */
define('BOOK', 0);
define('HOUSING', 1);
define('TUTORING', 2);  // automatic for TutorKatsListing (allows for SELECT * FROM listing WHERE flag = TUTORING (= 2)
define('MISC', 3);


/*
 * Constants for use in TutorKats; tutee (person looking for tutor) is represented by 0, tutor is represented by 1
 */
define('TUTEE', 0);
define('TUTOR', 1);

/*
 * Constants for use with Housing Listings, defines housingType
 */
define('APARTMENT', 0);
define('SINGLE_FAMILY_HOUSE', 1);
define('DUPLEX', 2);
define('DORMITORY', 3);