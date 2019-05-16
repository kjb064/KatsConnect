<?php 
session_start();
ob_start();
include_once 'includes/class.user.php';
include_once 'includes/header.php';
$user = new User();
$login_result=0;

if ($user->get_session()){
       header("location:index.php");
    }


if (isset($_POST['submit'])) { 

      extract($_POST);   
      $login = $user->check_login($emailusername, $password);
	    
      // $login = $user->check_login($_POST);
	    if ($login == true) {
          // Registration Success
	       $user->redirect('index');
	    } else {
	        // Registration Failed
	        $login_result=1;
	    }
	}
?>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
        <form class="login100-form validate-form flex-sb flex-w" action="" method="post" name="login">
          <?php if($login_result==1){ ?>
            <div class="alert alert-danger col-md-12">
            <strong>Email Or Password is wrong!</strong> 
            </div>
           <?php  } ?>
          <span class="login100-form-title p-b-32">
            Login Here
          </span>

          <span class="txt1 p-b-11">
           Email
          </span>
          <div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
            <input class="input100" type="text" name="emailusername" required>
            <span class="focus-input100"></span>
          </div>


          <span class="txt1 p-b-11">
            Password
          </span>
          <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
            <span class="btn-show-pass">
              <i class="fa fa-eye"></i>
            </span>
             <input class="input100" type="password" name="password" required>
            <span class="focus-input100"></span>
          </div>
          
          <div class="flex-sb-m w-full p-b-48">
            <div class="contact100-form-checkbox">
                <a class="txt3" href="registration.php">Not registered? Click Here!</a>
            </div>

            <div>
              <a href="forgot_password.php" class="txt3">
                Forgot Password?
              </a>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" name="submit" onclick="return(submitlogin());">
              Login
            </button>
          </div>

        </form>
      </div>
      <script>
      function submitlogin() {
        var form = document.login;
        if (form.emailusername.value == "") {
          alert("Enter email or username.");
          return false;
        } else if (form.password.value == "") {
          alert("Enter password.");
          return false;
        }
      }
    </script>
    </div>
  </div>
  
<?php  include_once 'includes/footer.php'; ?>




 
