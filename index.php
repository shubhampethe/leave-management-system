<?php

include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];

   $select = " SELECT * FROM app WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
      if(password_verify($pass,$row['password'])){

      if($row['email'] == 'shubhamspethe@coep.sveri.ac.in'){

         $_SESSION['admin'] = $row['name'];
         header('location:admin.php');

      }
      else{

         $_SESSION['user'] = $row['email'];
         $_SESSION['name'] = $row['name'];
         header('location:student.php');

      }
      }
      else{
         $error[] = 'incorrect email or password!';
      }
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="assets/style.css">

</head>
<body style="background-image: url('assets/ba.jpg'); background-repeat: no-repeat;
  background-size: cover;">
   
<div class="form-container">

   <form action="index.php" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="registration.php">register now</a></p>
   </form>

</div>

</body>
</html>