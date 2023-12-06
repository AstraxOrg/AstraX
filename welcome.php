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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/welcome.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Welcome</title>
</head>
<body>
<form action="" method="post">
<input type="submit" value="login" class="btn" name="logg" id = "logg">
</form>
<form action="" method="post">
<input type="submit" value="Signup" class="btn" name="registerr" id = "registerr">
</form>
<div class="header">
<a href="home.php"><div style="display: inline-block;"> <img src="images\logo.png" alt="?" height="150px" width="150px"></div></a>
    </div>
<div class="wel">
    Welcome ^_^
</div>
<form action="home.php" method="post">
<input type="submit" value="Shop Now!" class="btn" name="shop" id = "shop">
</form>
</body>
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
</div>
</html>