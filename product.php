<?php
include 'components/connect.php';
session_start();
$kkk = $_COOKIE["userr"];
$arr=$_GET['color'];
$parts = explode(',',$arr);
$color = $parts[0];
$category=$parts[1];
$select_u = $conn->prepare("SELECT * FROM `item`inner join`color` on item.item_name=color.item_name WHERE category LIKE '%{$category}%' AND color_name LIKE '%{$color}%'"); 
$select_u->execute();
$fetch_u = $select_u->fetch(PDO::FETCH_ASSOC);
$select_products1 = $conn->prepare("SELECT * FROM `item`inner join`color` on item.item_name=color.item_name WHERE category LIKE '%{$category}%' AND color_name LIKE '%{$color}%'"); 
$select_products1->execute();
$fetch_product1 = $select_products1->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['add_to_cart'])){
    if ($fetch_product1['quantity'] > 0) {
    $item_name = $fetch_u['item_name'];
    $item_photo_path = $fetch_u['photo_path'];
    $item_price = $fetch_u['price'];
    $item_color = $fetch_u['color_name'];
    $select_item = $conn->prepare("SELECT * FROM `cart` WHERE item_name = ? AND item_color = ?");
    $select_item->execute([$item_name,$item_color]);
    $row = $select_item->fetch(PDO::FETCH_ASSOC);
    if($select_item->rowCount() > 0){
        $increment_count = $conn->prepare("UPDATE Cart SET item_count = item_count + 1 WHERE item_name = ? AND item_color = ?");
        $increment_count->execute([$item_name,$item_color]);
    }else{
        $insert_item = $conn->prepare("INSERT INTO Cart (user_name, item_name, item_count, item_photo_path, item_price, item_color) VALUES(?,?,?,?,?,?)");
        $insert_item->execute([$kkk, $item_name, 1, $item_photo_path, $item_price, $item_color]);
    }
    $message[] = 'Item added to cart';
    $reduce_quantity = $conn->prepare("UPDATE `color` SET quantity = quantity - 1 WHERE item_name = ? AND color_name = ?"); 
    $reduce_quantity->execute([$item_name,$item_color]);
    }


}
if($_COOKIE["hi"] == 0){
    echo'
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AstraX - Please log in</title>
</head>
<body>
    <p>you must be logged in</p>
    </body>
    </html>
    ';
 }
 else{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/product.css">
    <title>AstraX</title>
</head>
<body>
    <div class="header">
    <a href="home.php"><div style="display: inline-block;"> <img src="images\logo.png" alt="?" height="150px" width="150px"></div></a>
</div>
            <?php
     $select_products = $conn->prepare("SELECT * FROM `item`inner join`color` on item.item_name=color.item_name WHERE category LIKE '%{$category}%' AND color_name LIKE '%{$color}%'"); 
     $select_products->execute();
     $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
   ?>
   
          <img id="imag" src="<?= $fetch_product['photo_path']; ?>" alt="" width="500px" hight="100px">

<div class="desc">
<ul>
<li><?= $fetch_product['item_name']; ?></li> 
<li> Quantity: <?= $fetch_product['quantity']; ?></li>
<li> Description: <?= $fetch_product['details']; ?></li>
</ul>
</div>
<?php if(isset($message)){
      foreach($message as $message){
         echo '
        <div id="msg">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      } ?>
<?php 
if ($fetch_product['quantity'] > 0) {
echo'
<div class="style7">
<form id="formName" action="" method="post">
<label class="button">Are you intrested?</label>
    <input type="submit" value="add to cart" name="add_to_cart">
</form>
</div>';
}
else {
    echo '
    <div class="style7">
        <p id = "oos">Out of stock</p>
    </div>';
}
?>
<span class ="about" > Made with 💖 by:<br> Mohamad Amer Khalil 202110942 <br>
  Abd Alaziz Arki 202110300 <br>
Ahmad Nassar 202110729 </span>
<div id="thefooter">
<span class="fol">Follow Us! <br>
 <span class="imag">   <img src="images/insta.png" alt="" width="80px" height="60px"> </span>
    <span class="textinsta" > instagram.com/Astrax </span> <br>
    <img src="images/facebook.png" alt="" width="50px" height="40px">
    <span class="textface" > facebook.com/Astrax </span>
</span>
<span class="trade"> AAA™©</span>
</body>
<?php
}

?>