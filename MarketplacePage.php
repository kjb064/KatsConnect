<?php
    include 'Marketplace.php';
    include 'marketplaceInsert.php';
    require 'includes/header.php';           // using newest version of header
    //require 'footer.php';          // NEED TO GET THIS TO STAY IN PLACE!!!!
	include_once 'includes/dbh-inc.php'; // using dbh-inc.php (data base handler) for connection
    include_once 'includes/constants-inc.php';       // access to constants for listing flag (housing, book, misc), housingType

$_SESSION['userID'] = 2;    //REMOVE/MODIFY!!!!!!

$marketplace = new Marketplace();

// To-Do:

// NEED userID FROM SESSION!!!!!!

    // header() in rateSeller and marketplaceInsert should have URL with www. when on site?
    // Transactions for ratings? (Race conditions)
    // Image upload restrictions
    // Image names -> how long is maximum allowable name that will fit in DB?
    // Make sure filezilla stuff compatible with new names
    // When is num seller/tutor Ratings set to 0? (upon registration?)
    // VERIFY QUERIES(populate tables)
    // COMPARE 'dbh-inc.php' WITH FILE ON FILEZILLA
    // Make footer stay at bottom of page
    // Make sure multiple users can access, create listings, view listings
    // Need better error handling (notify user if insertion was success or failure) apart from URL (maybe)
    // Format price to have 2 decimals after 0 (EX: $0.00)
    // Shorten insert.php code using loop if time


?>

<!DOCTYPE html>
<html>
<head>
    <title>KatsConnect - Marketplace</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/marketplaceStyles.css">
</head>

<body>

<h1>Marketplace</h1>

<!-- The following is for the modal that appears when the "Add Post" button is pressed -->
<div class="modal-container">

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-default btn-lg" id="myBtn"><span class="glyphicon glyphicon-plus"></span> Add Post</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4>Create Your Post</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <form role="form" method="post" action="marketplaceInsert.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Title">Post Title</label>
                            <input type="text" class="form-control" id="Title" name="Title" required>
                        </div>


                        <div class="form-group">
                            <label for="Flag">Select item type</label>
                            <select class="form-control" id="Flag" name="Flag" onchange="test(this);" autocomplete="off">
                                <option value="MISC">Misc.</option>
                                <option value="BOOK">Textbook</option>
                                <option value="HOUSING">Housing</option>
                            </select>
                        </div>

                        <!-- This displays only when "Textbook" is the selected flag -->
                        <div class="form-group" id="bookInfo" style="display: none">
                            <label for="BookTitle">Book title</label>
                            <input type="text" class="form-control" id="BookTitle" name="BookTitle">
                            <br>
                            <label for="BookISBN">ISBN</label>
                            <input type="text" class="form-control" id="BookISBN" name="BookISBN">
                            <br>
                            <label for="BookAuthor">Book author</label>
                            <input type="text" class="form-control" id="BookAuthor" name="BookAuthor">
                            <br>
                            <label for="CourseName">Course name</label>
                            <input type="text" class="form-control" id="CourseName" name="CourseName">
                            <br>
                            <label for="CourseNum">Course number</label>
                            <input type="number" class="form-control" id="CourseNum" name="CourseNum" min="0">
                        </div>

                        <!-- This displays only when "Housing" is the selected flag -->
                        <div class="form-group" id="housingInfo" style="display: none">
                            <label for="HousingType">Select type of housing</label>
                            <select class="form-control" id="HousingType" name="HousingType" autocomplete="off">
                                <option value="APARTMENT">Apartment</option>
                                <option value="SINGLE_FAMILY_HOUSE">Single Family House</option>
                                <option value="DUPLEX">Duplex</option>
                                <option value="DORMITORY">Dormitory</option>
                            </select>
                            <br>
                            <label for="HousingAddress">Address</label>
                            <input type="text" class="form-control" id="HousingAddress" name="HousingAddress">
                            <br>
                            <label for="HousingCity">City</label>
                            <input type="text" class="form-control" id="HousingCity" name="HousingCity">
                            <br>
                            <label for="HousingState">State</label>
                            <input type="text" class="form-control" id="HousingState" name="HousingState" value="TX">
                            <br>
                            <label for="HousingZipCode">Zip Code</label>
                            <input type="text" class="form-control" id="HousingZipCode" name="HousingZipCode">
                            <br>
                            <label for="HousingLeaseLength">Lease length (months)</label>
                            <input type="number" class="form-control" id="HousingLeaseLength" name="HousingLeaseLength" min="0" value="0">
                            <br>
                            <label for="HousingNumBed">Number of bedrooms</label>
                            <input type="number" class="form-control" id="HousingNumBed" name="HousingNumBed" min="0" value="0">
                            <br>
                            <label for="HousingNumBath">Number of bathrooms</label>
                            <input type="number" class="form-control" id="HousingNumBath" name="HousingNumBath" min="0" value="0">

                        </div>
                        <!--
                        <div class="form-group">                    GET FROM SESSION!!!!
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" id="Author" name="Author" required>
                        </div>
                        -->
                        <div class="form-row">
                            <label for="Price">Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control currency" id="Price" name="Price"
                                       data-number-to-fixed="2" data-number-stepfactor="100" value="0" min="0" step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <br>
                            <label for="Description">Description</label>
                            <textarea class="form-control" id="Description" name="Description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Image">(OPTIONAL) Image</label>
                            <input type="file" class="form-control-file" id="Image" name="Image">
                        </div>

                        <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['userID'];?>">

                        <button type="submit" class="btn btn-success btn-block" name="submit" value="submit">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Opens modal upon button press -->
<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>


<!-- Displays other input fields when "Housing" listing flag selected -->
<script>
    $('#Flag').on('change',function(){
        if( $(this).val()=== "HOUSING"){
            $("#housingInfo").show()
        }
        else{
            $("#housingInfo").hide()
        }
    });
</script>

<!-- These functions are used for setting fields to be required when a flag is selected -->
<!-- The "stopRequire...()" functions disable the field being required when a different flag is selected -->
<script>
    function requireHousingInfo() {
        document.getElementById("HousingAddress").required = true;
        document.getElementById("HousingLeaseLength").required = true;
        document.getElementById("HousingCity").required = true;
        document.getElementById("HousingState").required = true;
        document.getElementById("HousingZipCode").required = true;
        document.getElementById("HousingNumBed").required = true;
        document.getElementById("HousingNumBath").required = true;
    }

    function stopRequireHousingInfo() {
        document.getElementById("HousingAddress").required = false;
        document.getElementById("HousingLeaseLength").required = false;
        document.getElementById("HousingCity").required = false;
        document.getElementById("HousingState").required = false;
        document.getElementById("HousingZipCode").required = false;
        document.getElementById("HousingNumBed").required = false;
        document.getElementById("HousingNumBath").required = false;
    }

    function requireBookInfo() {
        document.getElementById("BookTitle").required = true;
        document.getElementById("BookISBN").required = true;
        document.getElementById("BookAuthor").required = true;
        document.getElementById("CourseName").required = true;
        document.getElementById("CourseNum").required = true;
    }

    function stopRequireBookInfo() {
        document.getElementById("BookTitle").required = false;
        document.getElementById("BookISBN").required = false;
        document.getElementById("BookAuthor").required = false;
        document.getElementById("CourseName").required = false;
        document.getElementById("CourseNum").required = false;
    }
</script>

<!-- Depending on selected flag, sets appropriate fields to "required" or not -->
<script>
    window.test = function(e) {
        if (e.value === 'HOUSING') {
            requireHousingInfo();
            stopRequireBookInfo();
        } else if (e.value === 'BOOK') {
            requireBookInfo();
            stopRequireHousingInfo();
        } else if (e.value === 'MISC') {
            stopRequireBookInfo();
            stopRequireHousingInfo();
        }
    }
</script>

<!-- Displays other input fields when "Textbook" listing flag selected -->
<script>
    $('#Flag').on('change',function(){
        if( $(this).val()=== "BOOK"){
            $("#bookInfo").show()
        }
        else{
            $("#bookInfo").hide()
        }
    });
</script>

<!-- This container holds the tabs and the tables that are generated -->
<div class="table-container">

    <ul class="nav nav-tabs">   <!-- For the tabs that say Books, Housing, Misc. -->
        <li class="active">
            <a data-toggle="tab" href="#books">Books</a>
        </li>
        <li>
            <a data-toggle="tab" href="#housing">Housing</a>
        </li>
        <li>
            <a data-toggle="tab" href="#misc">Misc.</a>
        </li>
    </ul>

    <!-- The content of each of the above tabs is defined below. -->

    <div class="tab-content">
        <div id="books" class="tab-pane fade in active">
            <div class="table-responsive">
                <table id="bookListings" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                    <tr>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Author</td>
                        <td>Seller Rating</td>
                        <td>Email</td>
                        <td>Price</td>
                        <td>Date</td>
                        <td>Book Title</td>
                        <td>Book Author</td>
                        <td>ISBN</td>
                        <td>Course Name</td>
                        <td>Course #</td>
                        <td>Description</td>
                        <td>Rate</td>
                    </tr>
                    </thead>
                    <?php
                    $marketplace->generateBookTable($conn); // Call function to generate Book table body
                    ?>
                </table>
            </div>
        </div>

        <div id="housing" class="tab-pane fade in">
            <div class="table-responsive">
                <table id="housingListings" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                    <tr>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Author</td>
                        <td>Seller Rating</td>
                        <td>Email</td>
                        <td>Price</td>
                        <td>Date</td>
                        <td>Housing Type</td>
                        <td>Lease Length (months)</td>
                        <td># of Bathrooms</td>
                        <td># of Bedrooms</td>
                        <td>Address</td>
                        <td>ZIP</td>
                        <td>Description</td>
                        <td>Rate (1-5)</td>
                    </tr>
                    </thead>
                    <?php
                    $marketplace->generateHousingTable($conn);  // Call function to generate Housing table body
                    ?>
                </table>
            </div>
        </div>

        <div id="misc" class="tab-pane fade in">
            <div class="table-responsive">
                <table id="miscListings" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                    <tr>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Author</td>
                        <td>Seller Rating</td>
                        <td>Email</td>
                        <td>Price</td>
                        <td>Date</td>
                        <td>Description</td>
                        <td>Rate</td>
                    </tr>
                    </thead>
                    <?php
                    $marketplace->generateMiscTable($conn); // Call function to generate Misc table body
                    ?>
                </table>
            </div>
        </div>

    </div>
</div>


</body>

</html>

<!-- Each of these loads the appropriate table in each tab -->
<script>
    $(document).ready(function(){
        $('#bookListings').DataTable();
    });



    $(document).ready(function(){
        $('#housingListings').DataTable();
    });



    $(document).ready(function(){
        $('#miscListings').DataTable();
    });
</script>

<?php require 'includes/footer.php'; ?>