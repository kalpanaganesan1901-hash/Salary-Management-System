<?php
session_start();

// 🔒 Login check
if(!isset($_SESSION['user']) || $_SESSION['role'] != 'employee'){
    header("Location: salary_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Employee Dashboard</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">
        <h3>👨‍💼 Employee Dashboard</h3>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="alert alert-success">
        Welcome, <b><?php echo $_SESSION['user']; ?></b>
    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <a href="view attendance.php" class="btn btn-primary w-100">
                📅 View Attendance
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="view payroll.php" class="btn btn-success w-100">
                💰 View Payroll
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="view department.php" class="btn btn-info w-100">
                🏢 View Department
            </a>
        </div>

    </div>

</div>

</body>
</html>