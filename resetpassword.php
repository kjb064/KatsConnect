﻿<?php 
session_start();
include_once 'includes/class.user.php';
include_once 'includes/header.php';
$user = new User();

$email_id = $_GET['token'];
$email1=base64_decode($email_id);

if (isset($_POST['submit'])) { 

      extract($_POST);   
      $login = $user->verify_password($email, $password);
	   
	    if ($login) {
	       header("location:index.php");
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>resetpassword</title>
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
        <form class="login100-form validate-form flex-sb flex-w" action="" method="post" name="resetpassword">
          <input type="hidden" name="email" value="<?php echo $email1; ?>">
          <span class="login100-form-title p-b-32">
            Reset Password
          </span>

          


          <span class="txt1 p-b-11">
            New Password
          </span>
          <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
            <span class="btn-show-pass">
              <i class="fa fa-eye"></i>
            </span>
             <input class="input100" type="password" name="password" required>
            <span class="focus-input100"></span>
          </div>

           <span class="txt1 p-b-11">
           Confirm Password
          </span>
          <div class="wrap-input100 validate-input m-b-12" data-validate = "ConfirmPassword is required">
            <span class="btn-show-pass">
              <i class="fa fa-eye"></i>
            </span>
             <input class="input100" type="password" name="cpassword" required>
            <span class="focus-input100"></span>
          </div>
          
         

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="submit" onclick="return(submitlogin());">
              RESET
            </button>
          </div>

        </form>
      </div>
      <script>
      function submitlogin() {
        var form = document.resetpassword;
        if (form.password.value == "") {
          alert("Enter password.");
          return false;
        } else if (form.cpassword.value == "") {
          alert("Enter Confirm password.");
          return false;
        }
         else if (form.cpassword.value != form.password.value) {
          alert("Please Enter Same Value.");
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
</html>


<?php include_once ‘includes/footer.php’; ?>
