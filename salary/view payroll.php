<?php
session_start();
include("dp.php");

// 🔒 Login check
if(!isset($_SESSION['user'])){
    header("Location: salary_login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM payroll");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Payroll</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
body{background:linear-gradient(135deg,#667eea,#764ba2);}
.box{width:90%;margin:50px auto;background:white;padding:25px;border-radius:15px;}
</style>
</head>

<body>

<div class="box">
<h3 class="text-center">💰 Payroll List</h3>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Emp ID</th>
<th>Basic</th>
<th>Bonus</th>
<th>Deduction</th>
<th>Net Salary</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['emp_id']; ?></td>
<td><?php echo $row['basic_salary']; ?></td>
<td><?php echo $row['bonus']; ?></td>
<td><?php echo $row['deduction']; ?></td>
<td><?php echo $row['net_salary']; ?></td>

<td>
<?php if($_SESSION['role'] == 'admin'){ ?>
    <a href="delete_payroll.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
<?php } else { ?>
    <span class="text-muted">No Action</span>
<?php } ?>
</td>

</tr>
<?php } ?>

</table>

<!-- 🔥 Role-based buttons -->
<?php if($_SESSION['role'] == 'admin'){ ?>
    <a href="add_payroll.php" class="btn btn-primary">➕ Add</a>
    <a href="salary_dashboard.php" class="btn btn-secondary">⬅ Back</a>
<?php } else { ?>
    <a href="employee.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
<?php } ?>

</div>

</body>
</html>