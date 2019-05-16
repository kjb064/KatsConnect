<?php 
session_start();
ob_start();
include_once 'includes/class.user.php';
include_once 'includes/header.php';
$user = new User();

$uid = $_SESSION['id'];

if (!$user->get_session()){
 header("location:login.php");
}

if (isset($_POST['submit'])){
  
  $apply_tutor = $user->apply_tutor($_POST);
  if ($apply_tutor) {
    $apply_tutor=3;
    
  } else {
          
   $apply_tutor=2;
 }
}

?>

<style type="text/css">
textarea:focus, input:focus {
  border-color: #3f51b5 !important;
}
</style>

<div class="container">
  <br><h2>Apply Tutor</h2><br>

  <?php if($apply_tutor==3){ ?>
      <div class="alert alert-success col-md-12">
        <strong>your application as soon as it is verified. thank you.</strong> 
      </div>
  <?php  } ?>
  <form class="form-horizontal" action="" method="post">
    <input type="hidden" name="user_id" value="<?php echo $uid; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2">Tutor:</label>
      <div class="col-sm-10">
        <select class="form-control" name="tutor_id" required="">
          <option value="">Select Tutor</option>
          <?php foreach ($user->allData('tutor',$uid)->fetch_all(MYSQLI_ASSOC) as $value) { ?>
          <option value="<?php echo $value['id']; ?>"><?php echo $value['course_name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Bulleting Board:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter Course Number" name="bulleting_board" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Market Place:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Enter First Name" name="market_place" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Tutoring:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter Last Name" name="tutoring" required="">
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
