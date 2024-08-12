<?php
session_start();
?>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<style>
     .border {
    border-radius: 0%;
}

.nav {
width:100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    height:13vh;
   position: fixed; 
    top: 0; 
    left: 0; 
    z-index: 1000; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

}
.nav-right {
    margin-left: auto; 
    display: flex;
    align-items: center;
}
.nav-linke {
    display: flex;
    align-items: center;
    text-decoration:none;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0 20px;
    text-decoration:none;
    
}
.nav-link:hover {
    background-color: #033d42; 
    color: white; 
    border-radius:15px;
    text-decoration:none;
}
.nav-linke span {
    text-decoration: none;
    padding: 0 30px ;
}

.nav-linke:hover  {
    text-decoration: none; 
}




.search-bar {
    margin-left: 20px; 
}

.search-bar input[type="text"] {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.search-bar button {
    padding: 5px 10px;
    border-radius: 4px;
    border: none;
    background-color: #033d42;
    color: white;
}
</style>
<div class="border">
<ul class="nav homenav" style="background-color: #046169; padding: 10px;">
    <li class="nav-item">
       <a class="nav-linke text-white" href="index.php"> <span style="font-family: 'Pacifico', cursive; font-size:30px">ShopiFy</span></a>
    </li>
    
    

    <form class="search-bar" action="#" method="GET">
        <input type="text" name="query" placeholder="Search here..">
        <button type="submit">Search</button>
    </form>
    
    <div class="nav-right">
    <?php 
        if(isset($_SESSION["uid"]) || isset($_SESSION["admineid"]))
    {
        if(isset($_SESSION["uid"]))
        {
    ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="user.php">
                <img src="images/profile.png" alt="Profile Icon" width="20" height="20">Profile
            </a>
        </li>
        <?php
        }
        ?>
       
        <li class="nav-item">
            <a class="nav-link text-white" href="cart.php"><img src= "images/cart.png" alt="Cart Icon" width="20" height="20">My Cart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="logout.php">Logout</a>
        </li>
        <?php
    }
    else
    {
        ?>
        <li class="nav-item">
            <a class="nav-link text-white" href="register.php">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="login.php">Login</a>
        </li>
    <?php 
    }
    ?>
    </div>
</ul>
