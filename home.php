<?php
include 'components/connect.php';
session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
if(isset($_POST['logg'])){
   header('location:user_login.php');
}
if(isset($_POST['registerr'])){
   header('location:user_register.php');
}
if(isset($_POST['logoutt'])){
   setcookie( "hi",0, time() + (86400 * 30), "/");
   header('location:home.php');
}
if(isset($_POST['prooo'])){
   header('location:user_update.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstraX</title>
</head>
<body>
   <?php
   if($_COOKIE["hi"] == 0){
      echo'
<form action="" method="post">
<input type="submit" value="Login" class="btn" name="logg" id = "logg">
</form>
<form action="" method="post">
<input type="submit" value="Signup" class="btn" name="registerr" id = "registerr">
</form>';
   }
   if($_COOKIE["hi"] == 1){
      echo'
      <form action="" method="post">
      <input type="submit" value="Profile" class="btn" name="prooo" id = "logg">
      </form>
      <form action="" method="post">
      <input type="submit" value="Logout" class="btn" name="logoutt" id = "registerr">
      </form>
      <a href="cart.php">
         <div id="carrt"></div>
      </a>';
   }
?>
<div class="header">
<a href="home.php"><div style="display: inline-block;"> <img src="images\logo.png" alt="?" height="150px" width="150px"></div></a>
    </div>
    <div class="list">
      
    <div class="certaincategory">
    <a href="filter.php?category=shirt">Shirt</a>
    </div><br>
    <div class="certaincategory">
    <a href="filter.php?category=pants">Pants</a>
    </div><br>
    <div class="certaincategory">
    <a href="filter.php?category=dress">Dress</a>
    </div><br>
    <div class="certaincategory">
    <a href="filter.php?category=shoes">Shoes</a>
    </div><br>
    <div class="certaincategory">
    <a href="filter.php?category=boots">Boots</a>
    </div><br>

    </div>
    <div class="shop">
<?php
     $select_products = $conn->prepare("SELECT * FROM `item`inner join`color` on item.item_name=color.item_name"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="product">
   <a href="product.php?color=<?= $fetch_product['color_name']; ?>,<?= $fetch_product['category']; ?>"> 
      <img src="<?= $fetch_product['photo_path']; ?>" alt="?" width="325px" height="390px">
        <ul></a>
        <li><?= $fetch_product['item_name']; ?></li> 
<li> quantity = <?= $fetch_product['quantity']; ?></li>
<li><?= $fetch_product['designer_name']; ?></li>
<li>
<?= $fetch_product['details']; ?>
</li>
<li> price = <?= $fetch_product['price']; ?> $</li>
</ul>  
</div>
<style>
    HTML {
    background-color: rgb(210,210,210);
    font-family: Playfair Display;
  }
  #logg{
   position: fixed;
   z-index: 2;
   left: 92%;
   top:6%;
   width: 90px;
   height: 50px;
   box-shadow: 5px 5px rgb(210,210,210);
   background-color: beige;
   border-radius: 10px;
   border: 0px;
   transition: 0.5s;
   color:#2f2f2f;
   font-size: calc(165%);
   font-family: Playfair Display;
  }
  #logg:hover{
   box-shadow: 0px 0px;
   background-color: black;
   color:aliceblue;
  }
   #carrt{
      background: url(images/cart.png) no-repeat beige;
      background-position: center;
      position: fixed;
      z-index: 2;
      left: 76%;
      top:6%;
      width: 90px;
      height: 50px;
      box-shadow: 5px 5px rgb(210,210,210);
      border-radius: 10px;
      border: 0px;
      transition: 0.5s;
      font-size: calc(165%);
      font-family: Playfair Display;
   }
  #carrt:hover{
   box-shadow: 0px 0px;
   background: url(images/cart2.png) no-repeat black;
   background-position: center;
   color:aliceblue;
  }
  #registerr{
   position: fixed;
   z-index: 2;
   left: 84%;
   top:6%;
   width: 90px;
   height: 50px;
   box-shadow: 5px 5px rgb(210,210,210);
   background-color: beige;
   border-radius: 10px;
   border: 0px;
   transition: 0.5s;
   color:#2f2f2f;
   font-size: calc(165%);
   font-family: Playfair Display;
  }
  #registerr:hover{
   box-shadow: 0px 0px;
   background-color: black;
   color:aliceblue;
  }
  .header{
    position: sticky;
    background-color: #2f2f2f;
z-index: 1;
    top:-10px;
    left: -10px;
    right: 10px;
    width: calc(100% + 19px);
    display: block;
    margin-left: -10px;
    margin-top: -10px;
  }
.list{
    position: absolute;
    font-size:40px;
    display:grid;
    left: -10px;
    background-color:beige;
    padding: 15px;
    border-radius: 10px;
    grid-template-rows:repeat(6,auto);
    grid-template-columns: (1,auto);
    width: calc(20%);
    height: calc(80%);
  transition-duration:3s;
}
.certaincategory{ 
    border-radius: 5px; 
    background-color:beige;
    text-align: center;
    border: 0px;
    transition: 0.5s;
    box-shadow: 5px 5px rgb(210,210,210);
    text-decoration: none!important;
     
}
.certaincategory:hover{

   box-shadow: 0px 0px;
    background-color: #2f2f2f;
}
.shop{
    position: relative;
    left: 25%;
width:70% ;
display: grid;
grid-template-columns:repeat(9,auto) ;
grid-template-rows:repeat(2,auto) ;
}
.product{
    background-color: #2f2f2f;
    padding: 5px;
    margin:5px ;
    color: #e4e5e1;
    font-size: 20px;
    grid-column: span 3;
    border-radius: 5px;
}
a{
   text-decoration: none!important;
}
a:link {
  color: #2f2f2f;
}
a:visited {
  color:#2f2f2f;
  background-color: transparent;
  text-decoration: none;
}
a:active {
  color: #fbfbfb;
  background-color: transparent;
  text-decoration: underline;
}
a:hover{
   color:white;
}
   </style>
<?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
   </body>
</html>