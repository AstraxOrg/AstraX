<?php
include 'components/connect.php';
session_start();
$kkk = $_COOKIE["userr"];
if(isset($_POST['clear'])) {
    $reset_cart = $conn->prepare("DELETE FROM `cart`");
    $reset_cart->execute();
    $reset_q = $conn->prepare("UPDATE `color` SET quantity=10");
    $reset_q->execute();
    header('location:cart.php');
}
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
   header('location:new.php');
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
    <title>Cart</title>
</head>
<body>

<form action="" method="post">
<input type="submit" value="profile" class="btn" name="prooo" id = "logg">
</form>
<form action="" method="post">
<input type="submit" value="logout" class="btn" name="logoutt" id = "registerr">
</form>
<div class="header">
<a href="home.php"><div style="display: inline-block;"> <img src="images\logo.png" alt="?" height="150px" width="150px"></div></a>
    </div>
    <?php
    $total =0;
     $select_products = $conn->prepare("SELECT * FROM `cart` where user_name= ? "); 
     $select_products->execute([$kkk,]);
     if($select_products->rowCount() > 0){
        echo '<span class="wel"> Confirm your order!</span>     <div class="shop">
        <form action="" method="post">
    <input type="submit" value="Reset Cart" class="btn" name="clear" id = "shop">
    </form>
    <style>
    #shop
    {
    text-align: center;
    transition: 0.5s;
        color:#2f2f2f;
        font-size:20px;
        font-family: Playfair Display;
        box-shadow: 5px 5px rgb(210,210,210);
        background-color: beige;
        border-radius: 10px;
        border: 0px;
        width: 140px;
        height: 70px;
    position: relative;
    top:65px;
    left: 1200px;
    } 
    #shop:hover{
        box-shadow: 0px 0px;
        background-color:tomato;
        color:aliceblue;
      }
    </style>
    </div>';
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
        $total =($fetch_product['item_price'] * $fetch_product['item_count']) + $total;
   ?>
    <div class="parent">
<div class="img">
<img src="<?= $fetch_product['item_photo_path']; ?>" alt="" width="170px" height="175px">
</div>
<div class="color"> <?= $fetch_product['item_color']; ?></div>
<div class="price"><?= $fetch_product['item_price']; ?> $ </div>
<div class="quan"><?= $fetch_product['item_count']; ?></div>
<div class="des"><img src="images\logo.png" alt="?" height="150px" width="150px"></div>

</div>

<style>
HTML {
    background-color: rgb(210,210,210);
    font-family: Playfair Display;
    font-size: 62.5%;
    /* background-image: url(../images/welcome.png); */
    min-width: 1080px;
    /* overflow-y: hidden; */
    overflow-x:hidden;
    scrollbar-width: 0px;
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
    color:aliceblue;}

    #thefooter{
        color:#fbfbfb;
        background-color: #2f2f2f;
        position: relative;
        height: 160px;
        left: -8px;
        right: 10px;
        width: calc(100% + 19px);
        display: block;
        margin-top: 50%;
        margin-bottom: -15px;
   
    }
    .fol{ 
        /* bottom:15px; */
        font-size:15px ;
      position: relative;
      left:1100px;
    }
    .imag
    {
        position: relative;
       right: 15px; 
    }
    .textface{
        position: relative;
    bottom: 15px;
    }
    .textinsta{
        position: relative;
    bottom: 15px;
    right:28px;
    }
.about
{
    display: inline-block;
    color:#fbfbfb;
    position: relative;
    left:15px;
   top:855px;
    font-size: 20px;
    z-index: 1;
}
/* .grandparent{
    align-items: center;
    font-size: 20px;
    width: 700px;
    display: grid;
    grid-template-columns: repeat(auto-fill, 50px);
    grid-auto-rows: 100px;
    column-gap: 10px;
    outline: 1px solid blue;
} */
.wel{
    color:#fbfbfb;
    position: relative;
    left:550px;
    top:80px;
background-color: #2f2f2f;
border-radius: 10px;
border: 0px;
font-size: 40px;
text-align: center;
width: 250px;
height: 100px;
overflow-x: hidden;
overflow-y: hidden;
  }
.parent{
    justify-content: center;
    position: relative;
    left:255px;
    top:150px;
  /* align-items: center; */
    font-size:30px;
    height: 200px;
    width:1000px;
    display: grid;
    grid-template-columns: repeat(auto-fill,190px);
    grid-auto-rows: repeat(auto-fill,3);
    column-gap: 10px;
    outline: 10px solid #2f2f2f;
    border-radius: 5px;
}
.img,.color,.price,.quan{
    display: flex;
        justify-content: center;
        align-items: center; 
}

</style>
<?php
}}else{
    ?>
    <span class="wel"> Your cart is empty!</span>
<style>
HTML {
    background-color: rgb(210,210,210);
    font-family: Playfair Display;
    font-size: 62.5%;
    /* background-image: url(../images/welcome.png); */
    min-width: 1080px;
    /* overflow-y: hidden; */
    overflow-x:hidden;
    scrollbar-width: 0px;
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
    color:aliceblue;}

    #thefooter{
        color:#fbfbfb;
        background-color: #2f2f2f;
        position: relative;
        height: 160px;
        left: -8px;
        right: 10px;
        width: calc(100% + 19px);
        display: block;
        margin-top: 50%;
        margin-bottom: -15px;
   
    }
    .fol{ 
        /* bottom:15px; */
        font-size:15px ;
      position: relative;
      left:1100px;
    }
    .imag
    {
        position: relative;
       right: 15px; 
    }
    .textface{
        position: relative;
    bottom: 15px;
    }
    .textinsta{
        position: relative;
    bottom: 15px;
    right:28px;
    }
.about
{
    display: inline-block;
    color:#fbfbfb;
    position: relative;
    left:15px;
   top:855px;
    font-size: 20px;
    z-index: 1;
}
.wel{
    color:#fbfbfb;
    position: relative;
    left:550px;
    top:80px;
background-color: #2f2f2f;
border-radius: 10px;
border: 0px;
font-size: 40px;
text-align: center;
width: 250px;
height: 100px;
overflow-x: hidden;
overflow-y: hidden;
  }
.parent{
    justify-content: center;
    position: relative;
    left:255px;
    top:150px;
  /* align-items: center; */
    font-size:30px;
    height: 200px;
    width:1000px;
    display: grid;
    grid-template-columns: repeat(auto-fill,240px);
    grid-auto-rows: repeat(auto-fill,3);
    column-gap: 10px;
    outline: 30px solid #2f2f2f;
    border-radius: 5px;
}
.img,.color,.price,.quan,.des{
    display: flex;
        justify-content: center;
        align-items: center; 
}
#shop
{
text-align: center;
transition: 0.5s;
    color:#2f2f2f;
    font-size:20px;
    font-family: Playfair Display;
    box-shadow: 5px 5px rgb(210,210,210);
    background-color: beige;
    border-radius: 10px;
    border: 0px;
    width: 140px;
    height: 70px;
position: relative;
top:65px;
left: 5px;
} 
#shop:hover{
    box-shadow: 0px 0px;
    background-color:tomato;
    color:aliceblue;
  }
    <?php
}
    ?>
    <?php
echo'<p id = "toto"> Total: $'.$total.'</p> <style>#toto{background-color:beige; position: relative; font-color: #2f2f2f; font-size: 30px; width: 200px; top:-290px;border-radius:4px;</style>';
?>