<?php 
require './includes/header.php'; 
use App\Classes\Student;
$student = new Student;
?>

<?php
    if (isset($_GET['deleteAll']) AND $_GET['deleteAll'] == 1) {
        $student->deleteAll();
    }

    if (isset($_GET['deleteId'])) {
        $student->delete($_GET['deleteId']);
    }
?>

<div class="table-responsive">
    <a href="?deleteAll=1" class="btn btn-danger float-right mb-2" onclick="return confirm('Are you sure to delete all info?')">Remove all</a>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Image</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    <?php
        $getStudents = $student->getStudents();
        if (is_array($getStudents) && count($getStudents) > 0) {
            $i = 1;
            foreach ($getStudents as $key => $value) {
    ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value['name']; ?></td>
            <td>
                <img src="<?php echo $value['image']; ?>" alt="..." width="60" height="60" class="rounded">
            </td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['address']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-info my-1">Edit</a>
                <a href="?deleteId=<?php echo $value['id']; ?>" class="btn btn-danger my-1" onclick="return confirm('Are you sure to delete this?')">Delete</a>
            </td>
        </tr>
    <?php } } else { ?>
        <tr class="text-center text-danger">
            <td colspan="6">No data found !</td>
        </tr>
    <?php } ?>
    </table>
</div>

<?php require './includes/footer.php'; ?>