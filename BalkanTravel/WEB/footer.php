<br><br><br>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-6">
        <div>
          <h3>Balkan travel</h3>
          <p class="mb-30 footer-desc">We are travel agency. We are on top of the world. We sell you the best tickets. Here you are on the right place to achieve your greatest dreams.</p>
        </div>
      </div>
      <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
        <div class="">
          <h4>Quick Link</h4>
          <ul class="list-unstyled">
            <li>
              <a href="../HomePage/HomePage.php" class="text-decoration-none">Home</a>
            </li>
            <li>
              <a href="../AboutUsPage/aboutus.php" class="text-decoration-none">About Us</a>
            </li>
            <li>
              <a href="../BookFlightPages/flightSetupPage.php" class="text-decoration-none">Buy ticket</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6">
        
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6">
        <div>
          <h4>Newsletter</h4>
          <div>
            <form action="" method="post">
              <label for="Newsletter" class="form-label">Subscribe To Our Newsletter</label>
              <input type="email" name="email" class="form-control" Placeholder="Enter Your Email" autocomplete="off">
              <button class="btn btn-danger mt-3" type="submit" name="subscribe" value="Subscribe">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <div class="copyright">
        <p>Developed and maintained by Mihaela Mihaylova, Viktor Asenov, Mitko Ivanov</p>
      </div>
    </div>
  </div>
</footer>

<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../PHPmailer/src/PHPMailer.php';
  require '../PHPmailer/src/SMTP.php';
  require '../PHPmailer/src/Exception.php';

  // echo "<pre>";
  // print_r( $_POST );

  $mail = new PHPMailer(true);
  if(isset($_POST['subscribe'])){
    
    try {
        $mail->isSMTP();                       
        $mail->Host = 'smtp.gmail.com';                     
        $mail->SMTPAuth = true;                                   
        $mail->Username = 'balkan.travel.192@gmail.com';                    
        $mail->Password = 'wbpysqzlnrmvpwoy';                             
        $mail->SMTPSecure = "SSL";            
        $mail->Port = 465;                                   
        $mail->setFrom('balkan.travel.192@gmail.com',"Flight Agency Newsletter Manager");
    
        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);
        $mail->Subject = "Subscription";
        $mail->Body = "You have subscribed for our newsletter";

        $mail->send();
        echo '<script>alert("EMAIL SENT")</script>';
        exit();
    } catch (Exception $e) {
      // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo '<script>alert("Error...Try again!")</script>';
        echo $e;
    }
  }
?>