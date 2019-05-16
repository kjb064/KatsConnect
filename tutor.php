<?php 
include_once 'includes/header.php';

$uid = $_SESSION['id'];


if (!$user->get_session()){
 header("location:login.php");
}


?>


<div class="container">

  <div class="row">

    <div class="book_header">
                    <!-- <div class="caption">
                        <span class="bold uppercase">Books</span><span class="bold uppercase"> </span>
                      </div> --><br>
                      <div class="actions">
                        <a class="btn btn-primary capital" href="addtutor.php"><i class="fa fa-plus"></i> Add new Tutor</a> &nbsp;&nbsp;
                      </div><br>
                    </div>
                    <div class="table-responsive"> 
                      <table class="table" id="housetable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Number</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($user->allData('tutor',$uid)->fetch_all(MYSQLI_ASSOC) as $value) { ?>
                          <?php
                          $id=$value['id'];
                          ?>
                          <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['course_number']; ?></td>
                            <td><?php echo $value['course_name']; ?></td>
                            <td><?php echo $value['rating']; ?></td>
                            <td><a href="edittutor.php?tutorid=<?php echo $value['id']; ?>"> Edit </a> <br>
                              <a href="delete.php?deleteid=<?php echo $value['id']; ?>&table_name=tutor&redirect_url=tutor.php"> Delete</a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                  
                </div>

              </div>       

              <?php  include_once 'includes/footer.php'; ?>


              <script type="text/javascript">
                $(document).ready(function() {
                  $('#housetable').DataTable();
                } );
                
              </script>
