<?php
  session_start(); // Initialize session data
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="../HomePage/HomePage.php"><img src="../Images/Balkan-airlines-logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        <a class="nav-link active" aria-current="page" href="../AboutUsPage/aboutus.php">About us</a>

        <?php if(isset($_SESSION['user'])){ // If there is a session - 'user' variable has value (there is logged in user) ?>
            <a class="nav-link active" aria-current="page" href="../BookFlightPages/flightSetupPage.php">Buy ticket</a>
            <a class="nav-link active" aria-current="page" href="#"> Welcome to your page, <?= @$_SESSION['user']['username'] ?></a>
            <a class="nav-link active" aria-current="page" href="../AccountPage/logout.php">Logout</a>
        <?php 
          }else{
        ?>
            <a class="nav-link active" aria-current="page" href="../AccountPage/index.php">Buy ticket</a>
            <a class="nav-link active" aria-current="page" href="../AccountPage/index.php">Login | Sign Up</a>
        <?php 
          } 
        ?>
        <!-- <a class="nav-link active" aria-current="page" href="../AccountPages/SignUpPage/signUpPage.html">Register</a> -->
       
      </div>
    </div>
  </div>
</nav>