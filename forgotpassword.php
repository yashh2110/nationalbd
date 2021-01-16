<?php
session_start();
include "dbconn.php";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/js/bootstrap.min.js">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="./css/forgotpassword.css">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@700&display=swap" rel="stylesheet">
    <title>Reset Password | NationalOpticals</title>
    <?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(empty($_POST['otpinput'])){
      ?>
      <style media="screen">
        .resetdiv{
          display: none;
        }
      </style>
      <?php
      require 'vendor/autoload.php';
      $mail = new PHPMailer(true);
      try {
        //Server settings

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'routnkart@gmail.com';                     // SMTP username
        $mail->Password   = 'srinu123';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('routnkart@gmail.com', 'RoutNkart');
        $mail->addAddress('yashwanth.muddana2110@gmail.com','yashwanth');     // Add a recipient

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "  ONE TIME PASSWORD";
        $mail->Body    = '<b style="color:orange">VERIFY YOUR GMAIL ADDRESS</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // if($mail->send()){
        //   echo "Change the password with otp sent to Master's mail";
        // }
      } catch (Exception $e) {
        echo "<p class='text-danger p-2 fas fa-exclamation-circle'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
      }
    }else{
      ?>
      <style media="screen">
        .resetdiv{
          display:initial;

        }
        .otpcard{
          display: none;
        }
      </style>
      <?php
    }

     ?>
  </head>
  <body>
    <div class="logo">
      <h2 class="text-right">NationalOpticals</h2>
    </div>
    <main>
      <!-- <div class="backgroundimg">
        <img src="./images/loginimg2.jpg">
      </div> -->
      <!-- <div class="backgrounddark">
      </div> -->
      <div class="otpcard">
        <h3 class="text-center p-2 m-2">ENTER THE OTP</h3>
        <form class="form-group optform" action="forgotpassword.php" method="post">
          <div class="user-input-wrp">
            <br>
            <input type="text" name ="otpinput" class="inputText" required/>
            <span class="floating-label">Enter OTP</span>
          </div>

          <button type="submit" class="d-block btn btn-primary otpbtn p-2 inputText" name="otpbtn">Verify</button>

        </form>
        <p class="text-center"><i class="fas fa-exclamation-circle"></i> Please check the master Gmail for otp</p>

        <a class="resend btn btn-success" href="forgotpassword.php">Resend OTP</a>
      </div>
      <div class="resetdiv">

        <div class="passwordreset">
          <h3 id="reasetheading" class="text-center">Reset Password</h3>
          <form class="form-control" id="chngpassform" action="forgotpassword.php" method="post">
            <div class="adj">

            <div class="user-input-wrp">
              <br>
              <input type="password" id="pass" name ="newpassword" class="inputText" required/>
              <span class="floating-label">Enter new password</span>
            </div>
            <div class="user-input-wrp">
              <br>
              <input type="password" id="rpass" name="repeatpass" class="inputText" required>
              <span class="floating-label">Repeat Password</span>
            </div>

            </div>
            <div class="form-check item">
              <label class="form-check-lable  d-block" id="seepass" style="float:right">
                <input type="checkbox"  onclick="seePassword()" name="showpassword" class="form-check-input"> Show password
              </label>
            </div>
            <button type="submit" class="btn btn-primary resetbtn"name="resetbtn">Reset</button>
          </form>
        </div>
      </div>
    </main>
    <script type="text/javascript" src="./js/index.js">

    </script>
  </body>

</html>
