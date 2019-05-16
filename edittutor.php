<?php 

include_once 'includes/header.php';

$uid = $_SESSION['id'];

if (!$user->get_session()){
 header("location:login.php");
}

if (isset($_GET['tutorid'])){

  $tutorid=$_GET['tutorid'];
  $tutor_data = $user->edit_data('tutor',$tutorid)->fetch_all(MYSQLI_ASSOC);

}

if (isset($_POST['submit'])){
  
  $update_tutor = $user->update_tutor($_POST);
  if ($update_tutor) {
    header('location:tutor.php');
    
  } else {
   $update_tutor=2;
 }
}

?>

<style type="text/css">
textarea:focus, input:focus {
  border-color: #3f51b5 !important;
}
</style>

<div class="container">
  <br><h2>Tutor Update</h2><br>
  <form class="form-horizontal" action="" method="post">
    <input type="hidden" name="id" value="<?php echo $tutor_data[0]['id']; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2">Course Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Enter Course Name" value="<?php echo $tutor_data[0]['course_name']; ?>" name="course_name" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Course Number:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control"  placeholder="Enter Course Number" value="<?php echo $tutor_data[0]['course_number']; ?>" name="course_number" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Rating:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"  placeholder="Enter Rating" value="<?php echo $tutor_data[0]['rating']; ?>" name="rating" required="">
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
