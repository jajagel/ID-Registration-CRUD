<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    

    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $cpname = isset($_POST['cpname']) ? $_POST['cpname'] : '';
    $cpnum = isset($_POST['cpnum']) ? $_POST['cpnum'] : '';
    $sid = isset($_POST['sid']) ? $_POST['sid'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
    $stmt->execute([$id, $sid, $name, $mname, $lname, $course, $address, $birthdate, $cpname, $cpnum]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
    <h2></h2>
    <form action="create.php" method="post">
       
        <input type="hidden" name="id" placeholder="1" value="auto" id="id">

        <label for="name">School ID</label>
        <label for="name">First Name</label>
        <input type="text" name="sid" placeholder="School ID" id="sid" required maxlength = "11">
        <input type="text" name="name" placeholder="First Name" id="name" required>
        

        <label for="mname">Middle Initial</label>
        <label for="lname">Last Name</label>
        <input type="text" name="mname" placeholder="Middle Initial" id="mname" required maxlength = "1">
        <input type="text" name="lname" placeholder="Last Name" id="lname" required>

        <label for="lname">Course</label>
        <label for="lname">Address</label>
        <input type="text" name="course" placeholder="Course" id="course" required>
        <input type="text" name="address" placeholder="Address" id="address" required>

        <label for="lname">Birthdate</label>
        <label for="lname">Contact Person Name</label>
        <input type="date" name="birthdate" placeholder="Birthdate" id="birthdate" required>
        <input type="text" name="cpname" placeholder="Contact Person Name" id="cpname" required>


        <label for="lname">Contact Person Number</label>
        <label></label>
        <input type="text" name="cpnum" placeholder="Contact Person Number" id="cpnum" required maxlength = "11">

        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>