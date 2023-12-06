<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){
   $firstname = $_POST['firstname'];
   $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
   $lastname = $_POST['lastname'];
   $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $dob = $_POST['dob'];
   $dob = filter_var($dob, FILTER_SANITIZE_STRING);
   $phonenum = $_POST['phonenum'];
   $phonenum = filter_var($phonenum, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $select_user = $conn->prepare("SELECT * FROM `User` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
$x_y=0;
   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO User(username, email, password, firstname, lastname, dob, phonenum, address) VALUES(?,?,?,?,?,?,?,?)");
         $insert_user->execute([$username, $email, $cpass, $firstname, $lastname, $dob, $phonenum, $address]);
         $message[] = 'registered successfully';
         $kf = $conn->prepare("SELECT username FROM User WHERE email = ? AND password = ?");
         $kf->execute([$email, $pass]);
         $fetchh = $kf->fetch(PDO::FETCH_ASSOC);
         $nnn = $fetchh["username"];
         setcookie("userr","$nnn", time() + (86400 * 30), "/");
         setcookie( "hi",1, time() + (86400 * 30), "/");
         header('location:home.php');
         $x_y=1;
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/signup.css">
    <title>AstraX - Signup</title>
</head>
<body>
    <div class="header">
    <a href="home.php"><div style="display: inline-block;"> <img src="images\logo.png" alt="?" height="150px" width="150px"></div></a>
    </div>
    <img src="images\goldendress.png" alt="?"  id = "pic1">
    <div class="signupform">
    <?php
   if(isset($message)){
      if($x_y==1){
      foreach($message as $message){
         echo '<div id="msg">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      }
         else{ 
            foreach($message as $message){
            echo '<div id="msgr">
               <span>'.$message.'</span>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
               </div>
               ';
            }}
      }
   ?>
         <form action="" method="post">
               <h3 id ="msg1">Your best choice yet 💖</h3>
               <input class="box" type="name" name="firstname" required placeholder="First Name" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill1">
               <input class="box" type="name" name="lastname" required placeholder="Last Name" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill2">
               <input class="box" type="name" name="username" required placeholder="Userame" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill3">
               <input class="box" type="date" name="dob" required placeholder="Date of Birth" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill4">
               <input class="box" type="number" name="phonenum" required placeholder="Phone Number" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill5">
               <input class="box" type="name" name="address" required placeholder="Address" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill6">
               <input class="box" type="email" name="email" required placeholder="Email Address" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill7">
               <input class="box" type="password" name="pass" required placeholder="Password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill8">
               <input class="box" type="password" name="cpass" required placeholder="Confirm Password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill9">
               <input class="btn" type="submit" value="Register" class="btn" name="submit" id = "fill10">
               <a id="msg2" class="paragraph" href="user_login.php">Already have an account?</a>
            </div>
         </form>
    </div>
    <img src="images\silversuit.png" alt="?"  id = "pic2">
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