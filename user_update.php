<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
$x_y=0;
$kkk = $_COOKIE["userr"];
$select_user = $conn->prepare("SELECT * FROM `User` WHERE username = ?");
$select_user->execute([$kkk]);
$row = $select_user->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
   $firstname = $_POST['firstname'];
   $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
   $lastname = $_POST['lastname'];
   $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
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
   if($_POST['cpass'] == NULL){
      $cpass=$pass;
   }else{
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

}

   $select_userrr = $conn->prepare("SELECT * FROM `User` WHERE email = ? AND password = ?");
   $select_userrr->execute([$email, $pass]);
   $rowww = $select_userrr->fetch(PDO::FETCH_ASSOC);

   if($select_userrr->rowCount() > 0){
      $update = $conn->prepare("UPDATE `User` SET `email` = ? , `firstname` = ? , `lastname` = ? , `dob` = ? , `phonenum` = ? , `address` = ? WHERE  `USERNAME` = ?");
         $update->execute([$email, $firstname,$lastname, $dob, $phonenum, $address ,$kkk]);
         $message[] = 'update successfully';
         $x_y=1;
      }else{
         $x_y=0;
         $message[] = 'wrong password not matched!';
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/update.css">
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
               <h3 id ="msg1">Tell us what has changed 😊</h3>
               <input class="box" type="name" name="firstname" placeholder="First Name" maxlength="50"require value ="<?= $row["firstname"]; ?>" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill1">
               <input class="box" type="name" name="lastname" placeholder="Last Name" maxlength="50" require value ="<?= $row["lastname"]; ?>" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill2">
               <input class="box" type="date" name="dob" placeholder="Date of Birth" class="box"require value ="<?= $row["dob"]; ?>" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill3">
               <input class="box" type="number" name="phonenum" placeholder="Phone Number" maxlength="50" require value ="<?= $row["phonenum"]; ?>" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill4">
               <input class="box" type="name" name="address" placeholder="Address" maxlength="50" class="box"require value ="<?= $row["address"]; ?>" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill5">
               <input class="box" type="email" name="email" placeholder="Email Address" maxlength="50" require value ="<?= $row["email"]; ?>" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill6">
               <input class="box" type="password" name="pass" placeholder="old password (required)" require maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill7">
               <input class="box" type="password" name="cpass" placeholder="new Password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" id = "fill8">
               <input class="btn" type="submit" value="Update" class="btn" name="submit" id = "fill9">
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
</body>
</html>