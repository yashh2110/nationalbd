<?php
  session_start();
  include "dbconn.php";
  if(empty($_SESSION['row'])){
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="apple-touch-icon" href="" />
    <meta name="description" content="This website is for custumer records" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="./css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Marko One' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>NationalOpticals | Login_page</title>

  </head>
  <body>
    <div class="backgroundimg">
      <img src="./images/loginimg2.jpg">
    </div>
    <div class="logodiv text-right">
      <div class="backgrounddark">
      </div>
      <h1 class="navbar-brand logo">National Opticals</h1>
    </div>
    <main>
      <div class="container-sm">
      <div class="dummycard">
        <div class="info">
          <h1 class="heading">LOGIN HERE</h1>
        </div>

      <div class="card logincard">

        <form class="form-group loginform" action="index.php" method="post">
          <div class="user-input-wrp">
            <br>
            <input class=" item inputText" type="text" name="username" required>
            <span class="floating-label">Enter Username</span>
          </div>
          <div class="user-input-wrp">
            <br>
            <input class=" item inputText" id="pass" type="password" name="password" required>
            <span class="floating-label">Enter password</span>
            <span id="eye1">
              <i  onclick="seePassword()" style="color:grey"class="far fa-eye-slash"></i>
            </span>
            <span id="eye">
              <i  onclick="seePassword()" style="color:grey" class="far fa-eye"></i>
            </span>

          </div>

          <div class="form-check item">
            <a style="text-decoration:none" style="color:grey"class="d-block text-right p-2 m-2" href="forgotpassword.php">Forgot password?</a>

          </div>
          <button type="submit" class="item btn" name="loginbtn">Login</button>
      </div>
      </div>

    </div>

    </main>
    <script type="text/javascript" src="./js/index.js">

    </script>
  </body>
  <?php
  if(isset($_POST['loginbtn'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $hashed_password =password_hash($password,PASSWORD_DEFAULT);
    echo $hashed_password;
    $sql = "SELECT * FROM users WHERE username='$username'";
    if(!empty($username)){
      if(!empty($password)){
        if($query = mysqli_query($conn,$sql)){
          $row=mysqli_num_rows($query);
          if($row=1){
            if($cred =mysqli_fetch_assoc($query)){
              if(password_verify($password,$cred['password'])){
              $_SESSION['row']=$row;
              $_SESSION['username']=$cred['username'];
              header("location:home.php");
            }else{
              echo "<div class='error text-warning far fa-times-circle'> Incorrect password</div>";
            }
            }else{
              echo "<div class='error text-warning far fa-times-circle'> Incorrect username</div>";
            }
          }else{
            echo "<div class='error text-warning far fa-times-circle'> Incorrect password or username</div>";
          }
        }else{
          echo "<div class='error text-warning far fa-times-circle'>Error in connection</div>";
        }
      }else{
        echo "<div class='error text-warning far fa-times-circle'>Please Enter the password</div>";
      }
    }else{
      echo "<div class='error text-warning far fa-times-circle'>Please Enter Username</div>";
    }
  }


  mysqli_close($conn);
   ?>
</html>
<?php
}else{
  header("location:home.php");
}
 ?>
