<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
        $mname = isset($_POST['mname']) ? $_POST['mname'] : '';
        $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $cpname = isset($_POST['cpname']) ? $_POST['cpname'] : '';
        $cpnum = isset($_POST['cpnum']) ? $_POST['cpnum'] : '';
        $sid = isset($_POST['sid']) ? $_POST['sid'] : '';
        $course = isset($_POST['course']) ? $_POST['course'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, sid = ?, name = ?, mname = ?, lname = ?, course = ?, address = ?, birthdate = ?, cpname = ?, cpnum = ? WHERE id = ?');
        $stmt->execute([$id, $sid, $name, $mname, $lname, $course, $address, $birthdate, $cpname, $cpnum, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
    <h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <input type="hidden" name="id" placeholder="1" value="<?=$contact['id']?>" id="id">
        <label for="id">School ID</label>
        <label for="name">First Name</label>
        <input type="text" name="sid" placeholder="1" value="<?=$contact['sid']?>" id="sid" maxlength = "11" >
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name">
        <label for="mname">Middle Initial</label>
        <label for="phone">Last Name</label>
        <input type="text" name="mname" placeholder="johndoe@example.com" value="<?=$contact['mname']?>" id="mname">
        <input type="text" name="lname" placeholder="2025550143" value="<?=$contact['lname']?>" id="lname">

        <label for="mname">Course</label>
        <label for="phone">Address</label>
        <input type="text" name="course" placeholder="johndoe@example.com" value="<?=$contact['course']?>" id="course">
        <input type="text" name="address" placeholder="2025550143" value="<?=$contact['address']?>" id="address">

        <label for="mname">Birthdate</label>
        <label for="phone">Contact Person Name</label>
        <input type="text" name="birthdate" placeholder="johndoe@example.com" value="<?=$contact['birthdate']?>" id="birthdate">
        <input type="text" name="cpname" placeholder="2025550143" value="<?=$contact['cpname']?>" id="cpname">

        <label for="mname">Contact Person Number</label>
        <label></label>
        <input type="text" name="cpnum" placeholder="johndoe@example.com" value="<?=$contact['cpnum']?>" id="cpnum" maxlength = "11">
   
        <input type="submit" value="Update">



    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>