<?php

    if(isset($_POST["register_btn"]))
    {
        $fn = $_POST["fullname"];
        $eid = $_POST["email"];
        $pass = $_POST["password"];
        $con = $_POST["contact"];

        $filename = $_FILES["photo"]["tmp_name"];
        $orgname = $_FILES["photo"]["name"];

        $file_info = explode(".",$orgname);
        $fileext = strtolower($file_info[1]);
        $allowtypes = array("jpg","png","jpeg");
        move_uploaded_file($filename,"images/".$orgname);


        $connect = mysqli_connect("localhost:3306","root","","sample");

        $qry="INSERT INTO `users`(`fullname`, `email`, `password`, `contact`,`photo`) 
             VALUES ('$fn','$eid','$pass','$con','$orgname')";
        
             $result = mysqli_query($connect,$qry);

             if($result){
               echo"success";
             }
             else{
                echo "fail";
             }

        }
        


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    
   body {
       background-image: url('images/background123.jpg'); 
  background-size: cover; 
  background-position: center; 
  background-repeat: no-repeat;
/*background: #CA86B0;
background: linear-gradient(180deg, #CA86B0, #9FCCC8);
background: #F2B4E9;
background: linear-gradient(180deg, #F2B4E9, #A8E5E0);*/
       font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      height: 140vh;
      margin: 0;
      padding: 40px 20px;
    }
    .registration-form {
      background: rgba(255, 255, 255, 0.9); 
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0px 10px 15px 0px rgba(0, 0, 0, 0.5); 
      margin-top: 20px; 
    }
    .registration-form h2 {
      font-weight: 600;
      color: #1f1f1f; 
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 15px;
      padding: 20px 20px;
      border: 1px solid #ddd; 
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
    }
   
    .text-center a {
      color: #fda085;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .text-center a:hover {
      color: #f6d365;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="registration-form">
          <h2 class="text-center"><b>Register</b></h2>
          <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="fullname">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
              <label for="contact">Contact Number</label>
              <input type="tel" class="form-control" id="contact" name="contact" placeholder="Enter your contact number" required>
            </div>
            <div class="form-group">
              <label for="file">File</label>
              <input type="file" class="form-control" id="file" name="photo" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="register_btn" >Register</button>
            <div class="text-center mt-3">
              <p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
