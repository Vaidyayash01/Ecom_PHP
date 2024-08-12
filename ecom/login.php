<?php
session_start();

if (isset($_SESSION["uid"])) {
    header("location:index.php");
    exit(); 
} else if (isset($_SESSION["admineid"])) {
    header("location:admin/admindashboard.php");
    exit();
}

$error_msg = ""; 

if (isset($_POST["login_btn"])) {
    include("includes/dbconnect.php");

    $email = mysqli_real_escape_string($connect, $_POST["email"]);
    $pass = mysqli_real_escape_string($connect, $_POST["password"]);

    
    if ($email == "admin@gmail.com" && $pass == "admin@123") {
        $_SESSION["admineid"] = $email;
        header("location:admin/admindashboard.php");
        exit();
    }
    

    $qry = "SELECT * FROM `users` WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($connect, $qry);

    $row_affected = mysqli_num_rows($result);

    if ($row_affected > 0) {
        $data = mysqli_fetch_assoc($result);
        $id = $data["id"];
        $_SESSION["uid"] = $id;

        header("location:index.php"); 
        exit(); 
    } else {
        $error_msg = "Invalid username and password"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    body {
      background-image: url('images/background.jpg'); 
      background-size: cover; 
      background-position: center; 
      background-repeat: no-repeat; 
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      height: 100vh;
      margin: 0;
      padding: 40px 20px;
    }

    .login-form {
      background: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0px 10px 15px 0px rgba(0, 0, 0, 0.5);
      width: 100%;
      max-width: 500px;
      margin: 20px; 
    }
    .login-form h1 {
      font-weight: 600;
      color: #1f1f1f;
      margin-bottom: 20px;
      text-align: center;
    }
    .form-control {
      border-radius: 30px;
      padding: 10px 20px;
      border: 1px solid #ccc;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #fda085;
      box-shadow: 0 0 5px rgba(253, 160, 133, 0.5);
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 30px;
      padding: 10px 20px;
      font-weight: 500;
      transition: background-color 0.3s ease;
      width: 100%;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .text-center a {
      color: #007bff;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .text-center a:hover {
      color: #0056b3;
    }
    .error-msg {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="login-form">
          <h1>Log in</h1>
          <form method="post">
            <div class="form-group">
              <label for="email">Email</label>
              <input class="form-control" type="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" type="password" placeholder="Enter password" name="password" required>
            </div>
            <button class="btn btn-primary" type="submit" name="login_btn">Log in</button>
            <div class="mt-2 text-center">
              <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
          </form>
          <?php if (!empty($error_msg)): ?>
            <div class="error-msg"><?php echo $error_msg; ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
