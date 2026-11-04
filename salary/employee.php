<?php
include 'dp.php';
$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, #667eea, #764ba2);
            color: white;
            text-align: center;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 90%;
            background: white;
            color: black;
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #ff7e5f;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        tr:hover {
            background: #ffe0b2;
        }

        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 5px;
            color: white;
        }

        .delete-btn {
            background: red;
        }

        .delete-btn:hover {
            background: darkred;
        }

    </style>
</head>

<body>

<h2>👨‍💼 Employee List</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Position</th>
    <th>Salary</th>
    <th>Join Date</th>
    <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['position']; ?></td>
    <td>₹ <?php echo $row['salary']; ?></td>
    <td><?php echo $row['join_date']; ?></td>
    <td>
        <a class="delete-btn" href="delete_employee.php?id=<?php echo $row['id']; ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>