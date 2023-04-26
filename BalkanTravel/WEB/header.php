<?php
session_start(); // Initialize session data
?>

<?php
$mysqli = new mysqli("localhost:3307","root","","book_flights");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../HomePage/HomePage.php"><img src="../Images/Balkan-airlines-logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto mb-2 mb-lg-0">
        <a class="nav-link active" aria-current="page" href="../AboutUsPage/aboutus.php">About us</a>

        <?php if (isset($_SESSION['user'])) { // If there is a session - 'user' variable has value (there is logged in user) 
        ?>
          <a class="nav-link active" aria-current="page" href="../BookFlightPages/flightSetupPage.php">Buy ticket</a>


          <?php
          if ($_SESSION['user']['email'] == "admin@gmail.com") { ?>
            <a class="nav-link active">Welcome to your page, <?= @$_SESSION['user']['username'] ?></a>
            <a class="nav-link active" aria-current="page" href="../AdminPanel/showFlights.php">Admin Panel</a>
            <a class="nav-link active"  href="../AccountPage/logout.php">Logout</a>
          <?php  }  else if ($_SESSION['user']['email'] != "admin@gmail.com") { ?>
            

          <div class="dropdown">
            <a class="dropdown-toggle nav-link" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome to your page, <?= @$_SESSION['user']['username'] ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li class="dropdown-item">Welcome to your page, <?= @$_SESSION['user']['username'] ?></li>
              <li><a class="dropdown-item" href="#">Check your flights</a></li>
            
              <li><button type="button" class="btn btn-link" value=<?php ($_SESSION['user'] ['email']) ?> name="button"><a href="../AccountPage/editProfile.php" >Edit your profile </a></button></li>
              <li><a class="dropdown-item" aria-current="page" href="../AccountPage/logout.php">Logout</a></li>
            </ul>

          <?php
        }
          ?>

          <?php
        }else{ ?>
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