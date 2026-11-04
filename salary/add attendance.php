<?php
include("dp.php");

$msg = "";

if(isset($_POST['submit'])){
    
    $emp_id = $_POST['emp_id'];
    $date   = $_POST['date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance (emp_id, date, status)
            VALUES ('$emp_id', '$date', '$status')";

    if(mysqli_query($conn, $sql)){
        $msg = "Attendance Added Successfully";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Attendance</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="col-md-5 m-auto bg-white p-4 shadow rounded">

<h3 class="text-center mb-3">📅 Add Attendance</h3>

<?php if($msg!=""){ ?>
<div class="alert alert-info text-center">
    <?php echo $msg; ?>
</div>
<?php } ?>

<form method="POST">

<input type="number" name="emp_id" class="form-control mb-3" placeholder="Employee ID" required>

<input type="date" name="date" class="form-control mb-3" required>

<select name="status" class="form-control mb-3" required>
    <option value="Present">Present</option>
    <option value="Absent">Absent</option>
</select>

<button type="submit" name="submit" class="btn btn-primary w-100">
    Add Attendance
</button>

</form>

</div>

</div>

</body>
</html>