<?php

include("includes/dbconnect.php");

$category = isset($_GET["category"]) ? $_GET["category"] : "all";
if ($category == "all") {
    $qry = "select * from product";
} else {
    $qry = "select * from product where productcategory = '$category'";
}

$result = mysqli_query($connect, $qry);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <?php include("includes/headercdn.php") ?>
    <link href="css/style.css" rel="stylesheet">
    <style>
.container-fluid.mt-5 {
    padding-top: 20px; 
}

        body {
        background-color: #f5f6f7;
         margin: 0;
         padding-top: 30px;
        }

       .hero-image {
    width: 100%;
    height: 50vh; 
    background: url('images/navdown.jpg') no-repeat center center;
    background-size: cover;
    opacity: 0.3; 
    position: relative; 
    margin-top: 60px; 
    color: black; 
    text-align: center; 
    display: flex; 
    justify-content: center;
    align-items: center;

}

.hero-text {
    position: absolute; 
    top: 50%; 
    left: 70%; 
    transform: translate(-50%, -50%); 
    padding: 20px; 
    border-radius: 10px; 
    color:black;
}

.hero-text h1 {

  font-family: Copperplate, Papyrus, fantasy;
   font-weight:bold;
   color: #000000; 
    font-size: 3.5rem; 
    margin: 0;
   text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.hero-text p {
font-family: Georgia, serif;
    font-size: 1.6rem; 
        
}

        .product-card {
            max-width: 200px; 
            margin: 0 auto; 
            padding: 10px;  
        }
.card {
    position: relative; 
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: scale(1.05); 
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
}

        .card-img-top {
            height: 120px; 
            object-fit: cover; 
        }

        .card-body {
            padding: 8px; 
        }

        .card-title {
            font-size: 0.9rem;
        }

        .rating {
            font-size: 0.8rem; 
        }

        .btn-primary {
            font-size: 0.8rem; 
            padding: 5px 10px; 
        }
    </style>
</head>
<body>
    <?php include("homenav.php") ?>

    
    <div class="hero-image">
<div class="hero-text">
        <h1>Welcome to ShopiFy</h1>
        <p>Your Style Your Smile!</p>
    </div>
            </div>

    <div class="container-fluid mt-5">
        <div class="row">
           
            <?php while($data = mysqli_fetch_assoc($result)) {
                $imagepath = "assets/".$data['productcategory']."/".$data['productimg'];
            ?>
            <div class="col-md-4 mb-4 product-card" data-category="<?php echo $data['productcategory']; ?>">
                <div class="card">
                    <img src="<?php echo $imagepath ?>" class="card-img-top img-fluid" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $data["productname"]; ?></h5>
                        <strong class="card-title"><?php echo $data["productprice"]; ?></strong>
                        <p class="card-text rating">Rating: ★★★★☆</p>
                        <a href="product.php?pid=<?php echo $data['productid']; ?>" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php include("includes/footercdn.php") ?>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>
