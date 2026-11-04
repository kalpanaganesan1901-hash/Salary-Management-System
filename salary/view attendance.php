<?php
session_start();
include("dp.php");

/* 🔒 Login Check */
if(!isset($_SESSION['user'])){
    header("Location: salary_login.php");
    exit();
}

/* 🔥 Delete Function */
if(isset($_GET['delete'])){

    /* Admin only delete */
    if($_SESSION['role'] == 'admin'){

        $id = $_GET['delete'];

        mysqli_query($conn,
        "DELETE FROM attendance WHERE id='$id'");

        echo "<script>
        alert('Attendance Deleted Successfully');
        window.location='view_attendance.php';
        </script>";
    }
}

/* Attendance Data */
$result = mysqli_query($conn,
"SELECT * FROM attendance");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Attendance</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>

body{
    background:linear-gradient(135deg,#667eea,#764ba2);
}

.box{
    width:80%;
    margin:50px auto;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

</style>
</head>

<body>

<div class="box">

<h3 class="text-center mb-4">
📅 Attendance List
</h3>

<table class="table table-bordered text-center">

<tr class="table-dark">

<th>ID</th>
<th>Emp ID</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['emp_id']; ?></td>

<td><?php echo $row['date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<?php if($_SESSION['role'] == 'admin'){ ?>

<a href="view_attendance.php?delete=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure to delete?')">

Delete

</a>

<?php } else { ?>

<span class="text-muted">No Action</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

<!-- Role Based Buttons -->
<?php if($_SESSION['role'] == 'admin'){ ?>

<a href="add_attendance.php"
class="btn btn-primary">

➕ Add Attendance

</a>

<a href="salary_dashboard.php"
class="btn btn-secondary">

⬅ Back

</a>

<?php } else { ?>

<a href="employee.php"
class="btn btn-secondary">

⬅ Back to Dashboard

</a>

<?php } ?>

</div>

</body>
</html>