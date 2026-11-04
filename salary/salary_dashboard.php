<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: salary_login.php");
    exit();
}

include 'dp.php';

/* ---------------- VALUES ---------------- */
$total_emp = 0;
$total_salary = 0;
$total_bonus = 0;
$high_salary = 0;
$low_salary = 0;

/* Employees */
$result = $conn->query("SELECT COUNT(*) as total FROM employees");
if($result && $row = $result->fetch_assoc()){
    $total_emp = $row['total'];
}

/* Total Salary */
$result = $conn->query("SELECT SUM(salary) as total FROM employees");
if($result && $row = $result->fetch_assoc()){
    $total_salary = $row['total'] ?? 0;
}

/* Highest Salary */
$result = $conn->query("SELECT MAX(salary) as max FROM employees");
if($result && $row = $result->fetch_assoc()){
    $high_salary = $row['max'] ?? 0;
}

/* Lowest Salary */
$result = $conn->query("SELECT MIN(salary) as min FROM employees");
if($result && $row = $result->fetch_assoc()){
    $low_salary = $row['min'] ?? 0;
}

/* Bonus (SAFE CHECK) */
$table_check = $conn->query("SHOW TABLES LIKE 'payroll'");

if($table_check && $table_check->num_rows > 0){

    $col_check = $conn->query("SHOW COLUMNS FROM payroll LIKE 'bonus'");

    if($col_check && $col_check->num_rows > 0){

        $result = $conn->query("SELECT SUM(bonus) as total FROM payroll");

        if($result && $row = $result->fetch_assoc()){
            $total_bonus = $row['total'] ?? 0;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Salary Dashboard</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #f4f6f9;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    position: fixed;
    background: #2c3e50;
    color: white;
    padding-top: 20px;
}

.sidebar h4 {
    text-align: center;
}

.sidebar a, .dropdown-btn {
    display: block;
    color: white;
    padding: 10px;
    text-decoration: none;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}

.sidebar a:hover, .dropdown-btn:hover {
    background: #1abc9c;
}

.dropdown-container {
    display: none;
    padding-left: 15px;
}

/* MAIN */
.main {
    margin-left: 220px;
    padding: 20px;
}

/* CARDS */
.cards {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.card-box {
    width: 180px;
    padding: 15px;
    color: white;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.green { background: #2ecc71; }
.blue { background: #3498db; }
.orange { background: #f39c12; }
.red { background: #e74c3c; }
.purple { background: #9b59b6; }
.teal { background: #1abc9c; }

.topbar {
    background: white;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>🏢 Company</h4>
    <p class="text-center">Welcome Admin</p>

    <a href="salary_dashboard.php">🏠 Dashboard</a>
    <a href="employee.php">👥 Employees</a>

    <button class="dropdown-btn">🏢 Department ▼</button>
    <div class="dropdown-container">
        <a href="add department.php">➕ Add Department</a>
        <a href="view department.php">📋 View Department</a>
    </div>

    <button class="dropdown-btn">📅 Attendance ▼</button>
    <div class="dropdown-container">
        <a href="add attendance.php">➕ Add Attendance</a>
        <a href="view attendance.php">📋 View Attendance</a>
    </div>

    <button class="dropdown-btn">💰 Payroll ▼</button>
    <div class="dropdown-container">
        <a href="add payroll.php">➕ Add Payroll</a>
        <a href="view payroll.php">📋 View Payroll</a>
    </div>

    <a href="logout.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<div class="topbar">
    <h3>💼 Salary Dashboard</h3>
</div>

<!-- CARDS -->
<div class="cards">

    <div class="card-box green">
        Total Employees <br><br>
        <?php echo $total_emp; ?>
    </div>

    <div class="card-box blue">
        Total Salary <br><br>
        ₹ <?php echo $total_salary; ?>
    </div>

    <div class="card-box orange">
        Total Bonus <br><br>
        ₹ <?php echo $total_bonus; ?>
    </div>

    <div class="card-box red">
        Highest Salary <br><br>
        ₹ <?php echo $high_salary; ?>
    </div>

    <div class="card-box purple">
        Lowest Salary <br><br>
        ₹ <?php echo $low_salary; ?>
    </div>

    <div class="card-box teal">
        Net Salary <br><br>
        ₹ <?php echo ($total_salary + $total_bonus); ?>
    </div>

</div>

</div>

<!-- SCRIPT -->
<script>
document.querySelectorAll(".dropdown-btn").forEach(btn => {
    btn.addEventListener("click", function(){
        let content = this.nextElementSibling;
        content.style.display = (content.style.display === "block") ? "none" : "block";
    });
});
</script>

</body>
</html>