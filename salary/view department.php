<?php
session_start();
include("dp.php");
include("style.php");

// 🔒 Login check
if(!isset($_SESSION['user'])){
    header("Location: salary_login.php");
    exit();
}

// ✅ Correct column query (id, name, department)
$result = mysqli_query($conn,"SELECT * FROM department");
?>

<!DOCTYPE html>
<html>
<head>
<title>Department List</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    font-family: Arial;
}

.container-box{
    width: 80%;
    margin: 50px auto;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
}

h3{
    text-align:center;
    color:#333;
}

thead{
    background:#1abc9c;
    color:white;
}

table tr:hover{
    background:#f2f2f2;
}

.btn-add{
    background:#667eea;
    color:white;
}

.btn-delete{
    background:#e74c3c;
    color:white;
}
</style>

</head>

<body>

<div class="container-box">

<h3>📋 Department List</h3>

<input type="text" id="search" class="form-control mb-3" placeholder="🔍 Search...">

<table class="table table-bordered text-center">
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Department</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['department']; ?></td>

<td>
<?php if($_SESSION['role'] == 'admin'){ ?>
    <a href="delete_department.php?id=<?php echo $row['id']; ?>"
    onclick="return confirm('Delete pannalama?')"
    class="btn btn-delete btn-sm">Delete</a>
<?php } else { ?>
    <span class="text-muted">No Action</span>
<?php } ?>
</td>

</tr>
<?php } ?>
</tbody>

</table>

<!-- 🔥 Role-based buttons -->
<?php if($_SESSION['role'] == 'admin'){ ?>
    <a href="add_department.php" class="btn btn-add">➕ Add Department</a>
    <a href="salary_dashboard.php" class="btn btn-secondary">⬅ Back</a>
<?php } else { ?>
    <a href="employee.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
<?php } ?>

</div>

<script>
document.getElementById("search").addEventListener("keyup", function(){
let v=this.value.toLowerCase();
document.querySelectorAll("tbody tr").forEach(r=>{
r.style.display=r.innerText.toLowerCase().includes(v)?"":"none";
});
});
</script>

</body>
</html>