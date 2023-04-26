<?php
session_start();
$servername = "localhost:3307";
$usernameOfDb = "root";
$passwordOfDb = "";
$database = "book_flights";

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$database", $usernameOfDb, $passwordOfDb);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";

   

    $email=($_SESSION['user']['email']);
    

    $username=($_SESSION['user']['username']);
 

    $password=($_SESSION['user']['password']);
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $username1 = $_POST['username'];
        $email1 = $_POST['email'];
        $password1 = $_POST['password'];
  
  
  
        $sql = "UPDATE users SET username='$username1', email='$email1', password='$password1' WHERE username='$username1' OR email='$email1' OR password='$password1'";
        if ($conn->query($sql) == TRUE) {
       
         
            header('Location:../HomePage/HomePage.php');
            exit();
          } else {
            echo "Error updating record: " . $conn->$error;
          
          }
        }
    
    $conn = null;

} catch (PDOException $e) {
  echo "Connection failed" . $e->getMessage();
}  


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="editProfileStyle.css">
</head>

<body>

<div class="center">
    <h1>Update your profile</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <div class="txt_field">
        <input type="text" name="username" required value="<?php echo $username; ?>">
        <span></span>
        <label>Username</label>
      </div>

      <div class="txt_field">
        <input type="text" name="email" required value="<?php echo $email; ?>">
        <span></span>
        <label>Email</label>
      </div>

      <div class="txt_field">
        <input type="text" name="password" required value="<?php echo $password; ?>">
        <span></span>
        <label>Password</label>
      </div>
      
      <div class="pass"></div>
      <input type="submit" name="submit" value="Update">
    </form>
  </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</body>
</html>