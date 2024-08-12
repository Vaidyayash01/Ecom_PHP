<style>
body {
    background-color: #f0f0f0; 
background-image:url('admin.webp');
background-repeat:no-repeat;
background-size:cover;
}


.nav-tabs {
    background-color: #0d95a1;
    
}


.nav-tabs .nav-link {
    color: black;
    background-color: #046169; 
}

.nav-tabs .nav-link.active {
    color: white;  
    background-color: #028080; 
    border-color: #028080; 
}

</style>
<?php
session_start();
if(!isset($_SESSION["admineid"]))
{
  header("location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminDashboard</title>
    <?php include("../includes/headercdn.php"); ?>
</head>
<body>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#addproduct">Add Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#manageuser">Manage User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#activity">Activity</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="../logout.php">Logout</a>
  </li>
</ul>


<div class="tab-content">
  <div class="tab-pane container active" id="addproduct">
    <?php include("addproduct.php"); ?>
  </div>
  <div class="tab-pane container fade" id="manageuser">
    <?php include("manageuser.php"); ?>
  </div>
  <div class="tab-pane container fade" id="activity">
    <?php include("activity.php"); ?>
  </div>
</div>

<?php include("../includes/footercdn.php"); ?>
</body>
</html>
