<?php
  $servername = "localhost";
  $username = "helper";
  $password = "vmm_123";
  $database = "book_flights";
  session_start(); // Start session
  try { // Try to connect to the database
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) { // Catch Block for Exceptions
    echo "Connection failed: " . $e->getMessage();
  }

  if ( isset( $_POST['register'] ) ) { // If Register Button is clicked

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];

    if($password == $password1){ // If password is the same as confirmation field's password
      $hash_password = password_hash($password,PASSWORD_BCRYPT);
      
      $sql = "INSERT INTO users ( username, email,password) VALUES (?,?,?)"; // Query Template / Statement
      $connection->prepare($sql)->execute([$username,$email,$hash_password]); // Execute the Query with the given Username,Email and Password on "?" place

      header("location: ../AccountPage/index.php");

      echo "<b style='color:green;'>Успешна регистрация</b><br><br>";

    }else{
      echo "Missmatch password";
    }


  }else if(isset($_POST['login'])){ // If Login Button is clicked

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT * FROM users WHERE email = ?"); // Query Template / Statement
    $query->execute([ $email]); // Execute the Query with the given Email on "?" place
    $user = $query->fetch(); // Fetch (Search and Return) for Results

    if(password_verify($password,$user["password"])){ // If the found user's password is the same as the entered login password
      $_SESSION['user'] = $user; // Save the found User as a Session
      unset($_SESSION['flightNotFound']); // Delete flightNotFound Variable from Session array
      header("location: ../HomePage/HomePage.php");
      exit;
    } else {
      echo "<b style='color:red;'>Невалидни потребителски данни</b><br><br>";
    }
  }
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Page</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <button class="back-btn" onclick="backButtonClick()">Back</button>

  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
      <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login" onclick="loginButtonClick()">Login</label>
        <label for="signup" class="slide signup" onclick="signupButtonClick()">Signup</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">

        <form action="" class="login" method="post">
          <pre>
          </pre>
          <div class="field">
            <input type="text" name="email" placeholder="Email Address" required autocomplete="off">
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="Password" required autocomplete="off">
          </div>
          <div class="pass-link"><a href="#">Forgot password?</a></div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit"  name="login" value="Login">
          </div>
        </form>

        <form action="" class="signup" method="post">
          <div class="field">
            <input type="text"  name="username" placeholder="Name" required autocomplete="off">
          </div>
          <div class="field">
            <input type="text" name="email" placeholder="Email Address" required autocomplete="off">
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="Password" required autocomplete="off">
          </div>
          <div class="field">
            <input type="password" name="password1" placeholder="Confirm password" required autocomplete="off">
          </div>            
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="register" value="Signup">
          </div>
          
        </form>
      </div>
    </div>
  </div>
  <script  src="script.js"></script>

</body>
</html>


