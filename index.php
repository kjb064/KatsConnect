<?php
//require 'includes/header.php';
require 'header.php'
//include_once 'includes/class.user.php';

//$user = new User();

//$uid = $_SESSION['id'];

//if (!$user->get_session()){
// header("location:login.php");
//}

//if (isset($_GET['q'])){
  //$user->user_logout();
  //header("location:login.php");
//}
?>

<div class="header-topmargin">
 <h2>Welcome</h2>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-4">
            <div class="wrimagecard wrimagecard-topimage">
                <a href="#MarketplacePage.php">
                    <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
                        <center><i class="fa fa-area-chart" style="color:#BB7824"></i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                        <h4>Marketplace
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="wrimagecard wrimagecard-topimage">
                <a href="#">
                    <div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
                        <center><i class = "fa fa-cubes" style="color:#16A085"></i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                        <h4>TutorKats
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="wrimagecard wrimagecard-topimage">
                <a href="#">
                    <div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">
                        <center><i class="fa fa-pencil-square-o" style="color:#d50f25"> </i></center>
                    </div>
                    <div class="wrimagecard-topimage_title" >
                        <h4>Bulletin Board
                        </h4>
                    </div>

                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-4">
            <div class="wrimagecard wrimagecard-topimage">
                <a href="#">
                    <div class="wrimagecard-topimage_header" style="background-color:  rgba(51, 105, 232, 0.1)">
                        <center><i class="fa fa-table" style="color:#3369e8"> </i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                        <h4>Campus Direct
                    </div>

                </a>
            </div>
        </div>

    </div>
</div>
</html>
<?php  include_once 'includes/footer.php'; ?>
