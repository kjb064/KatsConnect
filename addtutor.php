<?php 

include_once 'includes/header.php';

$uid = $_SESSION['id'];

if (!$user->get_session()){
 header("location:login.php");
}

if (isset($_POST['submit'])){
  
  $insert_tutor = $user->insert_tutor($_POST);
  if ($insert_tutor) {
            // Registration Success
    header('location:tutor.php');
    
  } else {
            // Registration Failed
   $insert_tutor=2;
 }
}

?>

<style type="text/css">
textarea:focus, input:focus {
  border-color: #3f51b5 !important;
}
</style>

<div class="container">
  <br><h2>Tutor Add</h2><br>
  <form class="form-horizontal" action="" method="post">
    <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2">Course Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Enter Course Name" name="course_name" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Course Number:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter Course Number" name="course_number" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Rating:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Enter Rating" name="rating" required="">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </div>
  </form>
</div>




<?php  include_once 'includes/footer.php'; ?>
