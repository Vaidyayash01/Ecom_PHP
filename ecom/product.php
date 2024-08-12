<?php
include("includes/dbconnect.php");

$pid = $_GET['pid'];

$qry = "select * from product where productid = '$pid'";
$result = mysqli_query($connect,$qry);
$data = mysqli_fetch_assoc($result);

$imagepath = "assets/".$data['productcategory']."/".$data['productimg'];

if(isset($_POST["addtocart_btn"])){
    session_start();
    $id = $_SESSION["uid"];
    $pid = $_POST["productid"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $qry = "INSERT INTO `addtocart`(`addtocart_id`, `uid`, `productid`, `totalprice`,`quantity`, `uploaded_at`, `modified_at`)
     VALUES (NULL,'$id','$pid','$price','$quantity',now(),now())";
     $result = mysqli_query($connect,$qry);
     if($result)
    {
        ?><script> alert("Product added to Cart"); </script> <?php
    }
    else{
        ?><script> alert("Something went wrong"); </script> <?php

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            max-width: 300px;
            margin: auto;
        }
        .product-img {
            height: 300px;
            object-fit: cover;
        }
        .product-details {
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php include("homenav.php") ?>
    <div class="container mt-5">
        <div class="row">
            <!-- Product Card -->
            <div class="col-md-6">
                <div class="card product-card">
                    <img src="<?php echo $imagepath ?>" class="card-img-top product-img" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data['productname'];?></h5>
                        <h6 class="card-subtitle text-muted">Category: <?php echo $data['productcategory'];?></h6>
                        <p class="card-text h4"><?php echo $data['productprice'];?> </p>
                        <p>Available Quantity: <?php echo $data['available'];?></p>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6 product-details">
                <div class="form-group">
                    <form action="checkout.php" method="post">
                        <input type="hidden" name="price" value="<?php echo $data["productprice"] ?>" class="form-control d-inline-block">
                        <input type="hidden" name="productid" value="<?php echo $data["productid"] ?>" class="form-control d-inline-block">
                        <div class="quantity">                            
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" class="form-control d-inline-block" style="width: 60px; text-align: center;">                   
                        </div>
                        <button class="btn btn-success mt-3" type="submit">Buy Now</button>
                    </form>
                    <form method="post">
                        <input type="hidden" name="quantity" id="quantity" value="1" class="form-control d-inline-block" style="width: 60px; text-align: center;">                   
                        <input type="hidden" name="price" value="<?php echo $data["productprice"] ?>" class="form-control d-inline-block">
                        <input type="hidden" name="productid" value="<?php echo $data["productid"] ?>" class="form-control d-inline-block">
                        <button class="btn btn-primary mt-3" name="addtocart_btn">Add to Cart</button>
                    </form>
                </div>
                <p><?php echo $data['productdescription']; ?></p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <h1>Reviews</h1>
                <ul>
                    <li>User 1</li>
                    <p>The product quality is so good.</p>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
