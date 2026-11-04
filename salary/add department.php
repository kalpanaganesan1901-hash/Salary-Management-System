<?php
session_start();
include("dp.php");

if(!isset($_SESSION['user']) || $_SESSION['role'] != 'admin'){
    header("Location: salary_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Department</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-5">

<h3>➕ Add Department</h3>

<form method="POST" action="add department.php">

<div class="mb-3">
<label>ID</label>
<input type="number" name="id" class="form-control" required>
</div>

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Department</label>
<input type="text" name="department" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">Save</button>

</form>

</div>

</body>
</html>