﻿<?php 
session_start();
include_once 'includes/class.user.php';
include_once 'includes/header.php';
$user = new User();

if (isset($_POST['submit'])) { 

      extract($_POST);   
      $email = $user->forgotpassword($emailusername);
	
	    // $login = $user->check_login($_POST);
	    if ($email) {
	       $send_mail=1;
	    } else {
	       $send_mail=2;
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


</head>


<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <form class="login100-form validate-form flex-sb flex-w" action="" method="post" name="forgotpassword">
           <?php if($send_mail==1){ ?>
            <div class="alert alert-success col-md-12">
            <strong>Please Check Your Email And Reset Password!</strong> 
            </div>
           <?php  } ?>

           <?php if($send_mail==2){ ?>
            <div class="alert alert-danger col-md-12">
            <strong>Your Email Is Does Not Exists !</strong> 
            </div>
           <?php  } ?>
          <span class="login100-form-title p-b-32">
            Forgot Password
          </span>

          <span class="txt1 p-b-11">
           Email
          </span>
          <div class="wrap-input100 validate-input m-b-36" data-validate = "email is required">
            <input class="input100" type="text" name="emailusername" required>
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="submit" onclick="return(submitlogin());">
              Send Email
            </button>
          </div>

        </form>
      </div>
      <script>
      function submitlogin() {
        var form = document.forgotpassword;
        if (form.emailusername.value == "") {
          alert("Enter email .");
          return false;
        } 
      }
    </script>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
<?php  include_once 'includes/footer.php'; ?>
</html>




 
