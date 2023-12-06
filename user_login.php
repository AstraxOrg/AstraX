<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `User` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['username'];
      $message[] = 'login successful';
      $kf = $conn->prepare("SELECT username FROM User WHERE email = ? AND password = ?");
      $kf->execute([$email, $pass]);
      $fetchh = $kf->fetch(PDO::FETCH_ASSOC);
      $nnn = $fetchh["username"];
      setcookie("userr","$nnn", time() + (86400 * 30), "/");
      setcookie( "hi",1, time() + (86400 * 30), "/");
      header('location:home.php');
   }else{
      $message[] = 'wrong username or password';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>AstraX - Login</title>
</head>
<body>
    <div class="header">
    <a href="home.php"><div style="display: inline-block;"> <img src="images\logo.png" alt="?" height="150px" width="150px"></div></a>
    </div>
    <div class="loginform">
    <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
        <div id="msg">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      }
   ?>
        <form action="" method="post">
          <div class="paragraph"> <h3 id ="lala">Login</h3></div>
           <div class="no" id="email_login"> <input type="email" name="email" required placeholder="Email Address" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill1"></div>
           <div class="no" id="password_login"> <input type="password" name="pass" required placeholder="Password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill2"></div>
           <div class="no" id="submit_login"><input type="submit" value="login now" class="btn" name="submit" id = "fill3"></div> 
            <a id="lol" class="paragraph" href="user_register.php">Don't have an account?</a>
         </form>
    </div>
    <div id = "vinel">
        <img src="images\vinel.png" alt="?" height="450px" width="460px">
    </div>
    <div id = "viner">
        <img src="images\viner.png" alt="?" height="450px" width="460px">
    </div>
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
</body>
</html>