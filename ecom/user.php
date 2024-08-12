<?php
session_start();
if (!$_SESSION["uid"]) {
  header("location:login.php");
}

include("includes/dbconnect.php");
$id = $_SESSION["uid"];
$qry = "select * from users where id='$id'";
$result = mysqli_query($connect, $qry);
$data = mysqli_fetch_assoc($result);


if (isset($_POST["updatepassbtn"])) {
  $op = $_POST["op"];
  if ($op == $data["password"]) {
    $np = $_POST["np"];
    $rp = $_POST["rp"];
    if ($np == $rp) {
      if ($np != $data["password"]) {
        $qry = "UPDATE `users` SET `password`='$np' WHERE id = '$id'";
        $result = mysqli_query($connect, $qry);
        if ($result) {
          echo "<script> alert('Password Changed Successfully');</script>";
        }
      } else {
        echo "<script> alert('New password should not match with Old password');</script>";
      }
    } else {
      echo "<script> alert('Passwords do not match, Re-enter the password');</script>";
    }
  } else {
    echo "<script> alert('Old password is incorrect');</script>";
  }
}



if (isset($_POST["editbtn"])) {
  $fn = $_POST["fullname"];
  $email = $_POST["email"];
  $con = $_POST["contact"];
  $qry = "UPDATE `users` SET `fullname`='$fn',`email`='$email',`contact`='$con' WHERE id='$id'";
  $result = mysqli_query($connect, $qry);
  if ($result) {
    echo "<script>alert('Profile updated Successfully')</script>";
  } else {
    echo "<script> alert('Something went Wrong')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopiFy - Dashboard</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: 'Montserrat', sans-serif;
      background-image: url('background123.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-color: rgba(244, 244, 244, 0.7);
      background-blend-mode: lighten;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color:  #046169;
      padding: 1rem 2rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .nav-linke {
    display: flex;
    align-items: center;
    text-decoration:none;
}
.nav-linke span {
    text-decoration: none;
    padding: 0 30px ;
}

    .navbar-brand,
    .nav-link,
    .navbar-text {
      color: #ffffff !important;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .navbar-brand {
      font-size: 1.4rem;
    }

    .nav-link:hover {
      color: #00aaff !important;
    }

    .sidebar {
      background-color: #ffffff;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar a {
      color: #333333;
      text-decoration: none;
      font-size: 1rem;
      display: block;
      padding: 0.75rem 1rem;
      transition: background-color 0.3s, color 0.3s;
      border-radius: 5px;
    }

    .sidebar a:hover {
      color: #007bff;
      background-color: #f1f1f1;
    }

    .tab-content {
      background-color: #ffffff;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #userprofile img {
      max-height: 250px;
      border-radius: 50%;
      transition: transform 0.3s ease-in-out;
    }

    #userprofile img:hover {
      transform: scale(1.1);
    }

    .list-group-item.active {
      background-color: #f8f9fa;
      border-color: #007bff;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      transition: background-color 0.3s ease-in-out;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .navbar-toggler-icon {
      filter: invert(1);
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
    <a class="nav-linke text-white" href="index.php"> <span style="font-family: 'Pacifico', cursive; font-size:30px">ShopiFy</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
        </ul>
        <span class="navbar-text">
          <strong>(<?php echo $data["fullname"]; ?>)</strong>
          <button class="btn btn-primary ms-2" data-bs-toggle="tooltip" title="Logout from your account">
            <a href="logout.php" style="text-decoration: none; color: white;">Log out</a>
          </button>
        </span>
      </div>
    </div>
  </nav>

  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-3">
        <ul class="list-group sidebar">
          <li class="list-group-item"><a href="#userprofile" data-bs-toggle="tab">Profile</a></li>
          <li class="list-group-item"><a href="#editprf" data-bs-toggle="tab">Edit Profile</a></li>
          <li class="list-group-item"><a href="#changepwd" data-bs-toggle="tab">Change Password</a></li>
          <li class="list-group-item"><a href="#orderhistory" data-bs-toggle="tab">Order History</a></li>
          <li class="list-group-item"><a href="logout.php" data-bs-toggle="tooltip" title="Logout from your account">Logout</a></li>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="userprofile">
            <?php include("userprofile.php"); ?>
          </div>
          <div class="tab-pane fade" id="editprf">
            <?php include("editprofile.php"); ?>
          </div>
          <div class="tab-pane fade" id="changepwd">
            <?php include("changepwd.php"); ?>
          </div>
          <div class="tab-pane fade" id="orderhistory">
            <?php include("orderhistory.php"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>
</html>
