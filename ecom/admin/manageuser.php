<?php

include("../includes/dbconnect.php");
$qry = "SELECT * FROM users";
$result = mysqli_query($connect, $qry);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .table {
            background-color:rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
        }
        .table th {
            background-color: #0a0a0a;
            color: #ffffff;
            font-weight: bold;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table img {
            border-radius: 50%;
        }
        .table a {
            color: #dc3545;
            text-decoration: none;
        }
        .table a:hover {
            color: #c82333;
        }
        h1 {
            color: #333333;
            font-size: 24px;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <h1 class="mt-5 mb-4">Welcome to Manage Users</h1>
                <table class="table border">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th>Password</th>
                            <th>Contact</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            while($data = mysqli_fetch_assoc($result)) {
                                $imagepath = "../images/".$data["photo"];
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo htmlspecialchars($data["fullname"]); ?></td>
                            <td><?php echo htmlspecialchars($data["email"]); ?></td>
                            <td><?php echo htmlspecialchars($data["password"]); ?></td>
                            <td><?php echo htmlspecialchars($data["contact"]); ?></td>
                            <td><img src="<?php echo $imagepath; ?>" width="60" alt="User Photo"/></td>
                            <td>
                                <a href="deleteuser.php?uid=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure you want to delete the user?');">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
