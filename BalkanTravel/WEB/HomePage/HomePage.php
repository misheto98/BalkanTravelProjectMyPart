<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balkan travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="../Images/fafiIcon.png">
    <link rel="stylesheet" href="style.css" media="screen">
    <link rel="stylesheet" href="../header.css" media="screen">
    <link rel="stylesheet" href="../footer.css" media="screen">
    
  </head>

  <body>

  <?php include("../header.php"); ?>

    <?php 
      if(!empty($_SESSION["flightNotFound"])){ // If there is flightNotFound Variable (There is no flight with the user's data)
        unset($_SESSION["flightNotFound"]); // Delete flightNotFound Variable from Session array
      } ?>
    <!-- Generate Audio in the page-->
 		<audio controls loop autoplay hidden preload="auto" id="myAudio">
			<source src="borko.mp3" type="audio/mp3">
		</audio>
    
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3500">
          <img src="../images/Afrika.jpeg" class="d-block w-100" alt="..." style="height: auto; width:100%;">
          <div class="carousel-caption d-none d-md-block">
            <h2> You want to choose a desired destination?</h2>
            <p style="font-size: 18px;">Make the trip of your life. You have the opportunity to do it right now</p>
        </div>
        </div>
        <div class="carousel-item" data-bs-interval="3500">
          <img src="../images/dubai1jpg.png" class="d-block w-100" alt="..." style="height: auto; width:100%;">
          <div class="carousel-caption d-none d-md-block ">
            <h2> You want to choose a desired destination?</h2>
            <p>Make the trip of your life. You have the opportunity to do it right now</p>
        </div>
        </div>
        <div class="carousel-item" data-bs-interval="3500">
          <img src="../images/monaco1.png" class="d-block w-100" alt="..." style="height: auto; width:100%;">
          <div class="carousel-caption d-none d-md-block">
            <h2> You want to choose a desired destination?</h2>
            <p>Make the trip of your life. You have the opportunity to do it right now</p>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    
    <?php include("../footer.php"); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
  </body>

</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
   
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';

//function signUpButtonClick(){
if(isset($_POST["subscribe"])){
    $address = $_POST["email"];
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'balkan.travel.192@gmail.com';
    $mail->Password = 'wbpysqzlnrmvpwoy';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);

    $mail->setFrom('balkan.travel.192@gmail.com',"Flight Agency Newsletter Manager");
    $mail->addAddress($address);
    $mail->Subject = "$address Subscription";
    $mail->Body = "You have subscribed for our newsletter";
    $mail->send();

    echo '<script>alert("EMAIL SENT")</script>';
    
}
?>