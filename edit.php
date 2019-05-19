<?php 
require './includes/header.php'; 
use App\Classes\Student;
$student = new Student;
?>

   <div class="row">
      <div class="col-md-4 offset-md-4">

         <?php
            if (isset($_GET['id'])) {
                $std = $student->getStudentById($_GET['id']);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['btn-update'])) {
                $student->update($_POST, $_FILES);
            }
         ?>

         <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $std['id'] ?? ''; ?>">
            <div class="form-group">
               <label for="name">Name</label>
               <input type="text" name="name" value="<?php echo $std['name'] ?? ''; ?>" id="name" class="form-control">
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input type="text" name="email" value="<?php echo $std['email'] ?? ''; ?>" id="email" class="form-control">
            </div>
            <div class="form-group">
               <label for="image">Image</label><br>
               <img src="<?php echo $std['image'] ?? ''; ?>" alt="..." width="100" height="100" class="rounded mb-1">
               <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <textarea name="address" id="address" class="form-control" rows="3"><?php echo $std['address'] ?? ''; ?></textarea>
            </div>
            <div class="form-group text-right">
               <input type="submit" name="btn-update" value="Update" class="btn btn-success btn-lg">
            </div>
         </form>

      </div>
   </div>

<?php require './includes/footer.php'; ?>