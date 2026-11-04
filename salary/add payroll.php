<?php
include("dp.php");

$msg = "";

if(isset($_POST['submit'])){
    $emp = $_POST['emp_id'];
    $basic = $_POST['basic'];
    $bonus = $_POST['bonus'];
    $deduction = $_POST['deduction'];

    $net = $basic + $bonus - $deduction;

    if(mysqli_query($conn, "INSERT INTO payroll 
    (emp_id, basic_salary, bonus, deduction, net_salary) 
    VALUES ('$emp','$basic','$bonus','$deduction','$net')")){
        $msg = "✅ Payroll Added Successfully";
    } else {
        $msg = "❌ Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Payroll</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
body{background:linear-gradient(135deg,#667eea,#764ba2);}
.box{width:400px;margin:100px auto;background:white;padding:25px;border-radius:15px;}
</style>
</head>

<body>

<div class="box">
<h3 class="text-center">💰 Add Payroll</h3>

<?php if($msg!=""){ ?>
<div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST">
<input type="number" name="emp_id" class="form-control mb-2" placeholder="Employee ID" required>
<input type="number" name="basic" class="form-control mb-2" placeholder="Basic Salary" required>
<input type="number" name="bonus" class="form-control mb-2" placeholder="Bonus" required>
<input type="number" name="deduction" class="form-control mb-2" placeholder="Deduction" required>

<button name="submit" class="btn btn-primary w-100">Add</button>
</form>

<br>
<a href="view_payroll.php" class="btn btn-success w-100">📋 View Payroll</a>
<a href="salary_dashboard.php" class="btn btn-secondary w-100 mt-2">⬅ Back</a>

</div>

</body>
</html>