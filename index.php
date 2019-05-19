<?php 
require './includes/header.php'; 
use App\Classes\Student;
$student = new Student;

/* 
   ** Abu Hasan Shadhin
   * 10-03-2019
*/

?>

   <div class="row">
      <div class="col-md-4 offset-md-4">

         <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['btn-add'])) {
               $msg = $student->add($_POST, $_FILES);
            }
         ?>

         <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
               <label for="name">Name</label>
               <input type="text" name="name" id="name" class="form-control" autofocus>
               <span class="text-danger"><?php echo $msg['name'] ?? '' ?></span>
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="text" name="email" id="email" class="form-control">
               <span class="text-danger"><?php echo $msg['email'] ?? '' ?></span>
            </div>
            <div class="form-group">
               <label for="image">Image</label>
               <input type="file" name="image" id="image" class="form-control-file">
               <span class="text-danger"><?php echo $msg['image'] ?? '' ?></span>
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <textarea name="address" id="address" class="form-control" rows="3"></textarea>
               <span class="text-danger"><?php echo $msg['address'] ?? '' ?></span>
            </div>
            <div class="form-group text-right">
               <input type="submit" name="btn-add" value="Submit" class="btn btn-success btn-lg">
            </div>
         </form>

      </div>
   </div>

<?php require './includes/footer.php'; ?>