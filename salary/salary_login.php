<?php
session_start();
include("dp.php");

$msg = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            AND password='$password' 
            AND role='$role'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // 🔥 Role-based redirect
        if($row['role'] == 'admin'){
            header("Location: salary_dashboard.php");
        } 
        else if($row['role'] == 'employee'){
            header("Location: employee_dashboard.php");
        }

        exit();
    } else {
        $msg = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-primary d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="bg-white p-4 rounded shadow" style="width:350px;">

<h3 class="text-center">🔐 Login</h3>

<?php if($msg!=""){ ?>
<div class="alert alert-danger text-center">
    <?php echo $msg; ?>
</div>
<?php } ?>

<form method="POST">

<input type="text" name="username" class="form-control mb-3" placeholder="Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

<select name="role" class="form-control mb-3" required>
    <option value="">Select Role</option>
    <option value="admin">Admin</option>
    <option value="employee">Employee</option>
</select>

<button name="login" class="btn btn-primary w-100">Login</button>

</form>

</div>

</body>
</html>