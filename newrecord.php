<?php
session_start();
include_once "dbconn.php";
if($_SESSION['row']!=1){
  header("location:index.php");
}else{

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
    <link rel="stylesheet" href="./css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>NationalOpticals | AddNewData</title>
  </head>
  <body>
    <nav class="navbar sticky-top navbar-expand-sm ">
      <div class="navbar-brand logo">
        <a class="text-dark"href="home.php"><h2 >NationalOpticals</h2></a>
      </div>
      <div class=" srcmrd">

      </div>
      <div class="nav-item p-2">
        <a class="btn btn-warning p-2" href="home.php">Home</a>
      </div>
      <div class="nav-item p-2">
        <a class="btn btn-success m-2" href="newrecord.php">New Patiant</a>
      </div>
      <div class="logout">
        <i style="float:right;font-size:1.4em"class="fas fa-bars barlogout"></i>
        <div class="usernamecard">
          <ul>
            <li class='text-center divs'><a class="text-dark" style="font-size: 1.3em;font-family: 'Audiowide', cursive;" href="#"><?php echo $_SESSION['username']; ?><a></li>
            <li class="text-center divs"><a class="text-dark" style="font-size: 1.3em;font-family: 'Audiowide', cursive;" href="logout.php">Logout</a> </li>
          </ul>
        </div>
      </div>
    </nav>
    <main>
      <div class="container-sm">
        <h3 style="font-family: 'Audiowide', cursive;"class="text-center">Add New Data</h3>
      </div>

      <form class="from-group" action="newrecord.php" method="post">
      <!-- DETAILS -->
      <div class="container-sm bg-light">
        <div class="input-group">
          <h4 class="persondata" >MRD NO : </h4><input type="text" class="form-control historyitem" name="MRD_NO1" value="
          <?php
          $mrdbool = true;
          do {
            $newmrd= rand(100000,999999);
            $sqladdmrd="SELECT * FROM patientrecord WHERE MRD_NO='$newmrd'";
            mysqli_query($conn,$sqladdmrd);
            if($sqladdmrd==0){
              $mrdbool=false;
              echo $newmrd;
              $_SESSION['newmrd']=$newmrd;

            }
          } while ($mrdbool);
          ?>"/>
          <h4 class="persondata">NAME : </h4><input type="text" class="form-control historyitem" name="NAME"/>
        </div>
        <div class="input-group">
          <h4 class="persondata">AGE :  </h4><input type="text" class="form-control historyitem" name="AGE"/>
          <h4 class="persondata">phone : </h4><input type="text" class="form-control historyitem" name="PHONE"/>
        </div>

      </div>


      <h5 class="container  p-2 mt-2">HISTORY TAKING</h5>
      <div class="container-sm history">
          <div class="input-group p-2">
            <h5 class="historyitem m-2">PURPOSE OF VISIT: </h5>
            <input type="text" class="form-control historyitem" name="reasonvisit"/>
          </div>
          <div class="input-group p-2">
            <h5 class="historyitem m-2">COMPLAINTS:</h5>
            <input type="text" class="form-control historyitem" name="complaints"/>
          </div>
          <div class="input-group p-2">
            <h5 class="historyitem m-2">OCULAR HISTORY:</h5>
            <input type="text" class="form-control historyitem" name="ocularhistory"/>
          </div>
          <div class="input-group p-2">
            <h5 class="historyitem m-2">MEDICAL HISTORY:</h5>
            <input type="text" class="form-control historyitem" name="medicalhistory"/>
          </div>
          <div class="input-group p-2">
            <h5 class="historyitem m-2">BIRTH HISTORY :</h5>
            <input type="text" class="form-control historyitem" name="birthhistory"/>
          </div>
          <div class="input-group p-2">
            <h5 class="historyitem m-2">REMARKS:</h5>
            <input type="text" class="form-control historyitem" name="remarks1"/>
          </div>




      </div>
      <h5 class="container-sm p-2 mt-2">VISION PART</h5>
      <div class="container-sm visionpart">
        <table class="table table-borderless text-center">
          <thead>
            <tr>
              <tr>
                <th>VISION WITH GLASSES</th>

                <th>VISION WITHOUT GLASSES</th>
              </tr>
            </tr>
          </thead>
        </table>
        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">DISTANCE</th>
              <th class="text-center">NEAR</th>
              <th></th>
              <th></th>
              <th class="text-center">DISTANCE</th>
              <th class="text-center">NEAR</th>
              <th class="text-center">cm</th>
              <th class="text-center">WITH PH</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>OD</td>
              <td> <input type="text" class="form-control"name="vison_ODdistance"/> </td>
              <td><input type="text" class="form-control"name="vison_ODnear"/> </td>
              <td><input type="text" class="form-control"name="vison_ODcm"/> </td>
              <td>OD</td>
              <td><input type="text" class="form-control"name="vison_without_ODdistance"/> </td>
              <td><input type="text" class="form-control"name="vison_without_ODnear"/> </td>
              <td><input type="text" class="form-control"name="vison_without_ODcm"/> </td>
              <td><input type="text" class="form-control"name="vison_without_ODwhithph"/> </td>
            </tr>
            <tr>
              <td>OS</td>
              <td> <input type="text" class="form-control"name="vison_OSdistance"/> </td>
              <td><input type="text" class="form-control"name="vison_OSnear"/> </td>
              <td><input type="text" class="form-control"name="vison_OScm"/> </td>
              <td>OS</td>
              <td><input type="text" class="form-control"name="vison_without_OSdistance"/> </td>
              <td><input type="text" class="form-control"name="vison_without_OSnear"/> </td>
              <td><input type="text" class="form-control"name="vison_without_OScm"/> </td>
              <td><input type="text" class="form-control"name="vison_without_OSwhithph"/> </td>
            </tr>
            <tr>
              <td></td>
              <td>TYPE OF CHARTS</td>
              <td><input type="text" class="form-control"name="type_of_chat1"/></td>

              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <h5 class="container-sm p-2 mt-2">REFRACTION AND PGG</h5>
      <div class="container-sm refrac">
        <table class="table table-borderless  table-sm">
          <thead>
            <tr>
              <tr>
                <th>REFRACTION </th>
                <th>PGP</th>
              </tr>
            </tr>
          </thead>
          <thead>
            <tr>
            <th style="float:right"class="text-center">GLASS STATUS : </th>
            <div  style="width:22%;position:relative;float:right;top:67px;" class="f">
              <input type="text" class="form-control"name="PGG_GLASS_STATUS"/>
            </div>
          </tr>
          </thead>
        </table>
        <table class="table table-sm table-hover refclass">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">SPH</th>
              <th class="text-center">CYL</th>
              <th  class="text-center">A</th>
              <th class="text-center">TYPE OF REFLEX</th>
              <th class="text-center"></th>
              <th class="text-center">SPH</th>
              <th class="text-center">CYL</th>
              <th class="text-center">A</th>
              <th class="text-center">ADD</th>
              <th class="text-center">TYPE OF GLASS</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td>OD</td>
              <td> <input type="text" class="form-control"name="refraction_OD_SPH"/> </td>
              <td><input type="text" class="form-control"name="refraction_OD_CYL"/> </td>
              <td><input type="text" class="form-control"name="refraction_OD_A"/> </td>
              <td><input type="text" class="form-control"name="refraction_OD_TYPEOFREFLEX"/> </td>
              <td>OD</td>
              <td><input type="text" class="form-control"name="PGG_OD_SPH"/> </td>
              <td><input type="text" class="form-control"name="PGG_OD_CYL"/> </td>
              <td><input type="text" class="form-control"name="PGG_OD_A"/> </td>
              <td><input type="text" class="form-control"name="PGG_OD_ADD"/> </td>
              <td><input type="text" class="form-control"name="PGG_OD_TYPEOFGLASS"/> </td>

            </tr>
            <tr>
              <td>OS</td>
              <td> <input type="text" class="form-control"name="refraction_OS_SPH"/> </td>
              <td><input type="text" class="form-control"name="refraction_OS_CYL"/> </td>
              <td><input type="text" class="form-control"name="refraction_OS_A"/> </td>
              <td><input type="text" class="form-control"name="refraction_OS_TYPEOFREFLEX"/> </td>
              <td>OS</td>
              <td><input type="text" class="form-control"name="PGG_OS_SPH"/> </td>
              <td><input type="text" class="form-control"name="PGG_OS_CYL"/> </td>
              <td><input type="text" class="form-control"name="PGG_OS_A"/> </td>
              <td><input type="text" class="form-control"name="PGG_OS_ADD"/> </td>
              <td><input type="text" class="form-control"name="PGG_OS_TYPEOFGLASS"/> </td>

            </tr>
          </tbody>
        </table>

      </div>
      <h5 class="container-sm p-2 mt-2">ACCEPTANCE</h5>
      <div class="container-sm acceptclass">
        <table class="table table-borderless text-center">
          <thead>
            <tr>
              <tr>
                <th>ACCEPTANCE</th>
              </tr>
            </tr>
          </thead>
        </table>
        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">SHP</th>
              <th class="text-center">CYL</th>
              <th class="text-center">A</th>
              <th class="text-center">ADD</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>OD</td>
              <td> <input type="text" class="form-control"name="acceptance_OD_SPH"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OD_CYL"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OD_A"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OD_ADD"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OD_cm" placeholder="cm"/></td>
            </tr>
            <tr>
              <td>OS</td>
              <td> <input type="text" class="form-control"name="acceptance_OS_SPH"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OS_CYL"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OS_A"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OS_ADD"/> </td>
              <td><input type="text" class="form-control"name="acceptance_OS_cm" placeholder="cm"/></td>
            </tr>
          </tbody>
        </table>
      </div>
      <h5 class="container-sm p-2 mt-2">K-TABLE</h5>
      <div class="container-sm prescriptionclass">
        <table class="table table-borderless text-center">
          <thead>
            <tr>
              <tr>
                <th>OD</th>
                <th>OS</th>

              </tr>
            </tr>
          </thead>
        </table>
        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">SHP</th>
              <th class="text-center">CYL</th>
              <th class="text-center">A</th>
              <th></th>
              <th class="text-center">SHP</th>
              <th class="text-center">CYL</th>
              <th class="text-center">A</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>K1</td>
              <td> <input type="text" class="form-control"name="K1_OD_SPH"/> </td>
              <td><input type="text" class="form-control"name="K1_OD_CYL"/> </td>
              <td><input type="text" class="form-control"name="K1_OD_A"/> </td>
              <td></td>
              <td><input type="text" class="form-control"name="K1_OS_SPH"/> </td>
              <td><input type="text" class="form-control"name="K1_OS_CYL" placeholder="cm"/></td>
              <td><input type="text" class="form-control"name="K1_OS_A" placeholder="cm"/></td>
            </tr>
            <tr>
              <td>OS</td>
              <td> <input type="text" class="form-control"name="K2_OD_SPH"/> </td>
              <td><input type="text" class="form-control"name="K2_OD_CYL"/> </td>
              <td><input type="text" class="form-control"name="K2_OD_A"/> </td>
              <td></td>
              <td><input type="text" class="form-control"name="K2_OS_SPH"/> </td>
              <td><input type="text" class="form-control"name="K2_OS_CYL" placeholder="cm"/></td>
              <td><input type="text" class="form-control"name="K2_OS_A" placeholder="cm"/></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="container-sm p-2">
        <div class="b-inline">
          <h4>Remarks:</h4>
          <input type="text" class="form-control" name="remarks2"/>
        </div>
      </div>
      <div class="container-sm d-flex justify-content-sm-center">
        <button type="submit"class="d-block btn btn-success p-2" name="oldpatientbtn">Submit</button>
        <i style="position:absolute;margin-top:60px;opacity:0.8"class="fas fa-exclamation-circle text-danger">Please check the data before you submit</i>
      </div>
      <br>
      <br>
    </form>
    </main>
  </body>
  <?php
    if(isset($_POST['oldpatientbtn'])){
      if(!$conn){
        die("error connection".mysqli_connect_error());
      }
      $MRD_NO =$_SESSION['newmrd'];
      $NAME = mysqli_real_escape_string($conn,$_POST['NAME']);
      $AGE = mysqli_real_escape_string($conn,$_POST['AGE']);
      $PHONE = mysqli_real_escape_string($conn,$_POST['PHONE']);
      $reasonvisit = mysqli_real_escape_string($conn,$_POST['reasonvisit']);
      $complaints = mysqli_real_escape_string($conn,$_POST['complaints']);
      $ocularhistory = mysqli_real_escape_string($conn,$_POST['ocularhistory']);
      $medicalhistory = mysqli_real_escape_string($conn,$_POST['medicalhistory']);
      $birthhistory = mysqli_real_escape_string($conn,$_POST['birthhistory']);
      $remarks1= mysqli_real_escape_string($conn,$_POST['remarks1']);
      $vison_ODdistance = mysqli_real_escape_string($conn,$_POST['vison_ODdistance']);
      $vison_ODnear = mysqli_real_escape_string($conn,$_POST['vison_ODnear']);
      $vison_ODcm = mysqli_real_escape_string($conn,$_POST['vison_ODcm']);
      $vison_without_ODdistance = mysqli_real_escape_string($conn,$_POST['vison_without_ODdistance']);
      $vison_without_ODnear = mysqli_real_escape_string($conn,$_POST['vison_without_ODnear']);
      $vison_without_ODcm = mysqli_real_escape_string($conn,$_POST['vison_without_ODcm']);
      $vison_without_ODwhithph = mysqli_real_escape_string($conn,$_POST['vison_without_ODwhithph']);

      $vison_OSdistance = mysqli_real_escape_string($conn,$_POST['vison_OSdistance']);
      $vison_OSnear = mysqli_real_escape_string($conn,$_POST['vison_OSnear']);
      $vison_OScm = mysqli_real_escape_string($conn,$_POST['vison_OScm']);
      $vison_without_OSdistance = mysqli_real_escape_string($conn,$_POST['vison_without_OSdistance']);
      $vison_without_OSnear = mysqli_real_escape_string($conn,$_POST['vison_without_OSnear']);
      $vison_without_OScm = mysqli_real_escape_string($conn,$_POST['vison_without_OScm']);
      $vison_without_OSwhithph = mysqli_real_escape_string($conn,$_POST['vison_without_OSwhithph']);

      $type_of_chat1 = mysqli_real_escape_string($conn,$_POST['type_of_chat1']);


      $refraction_OD_SPH = mysqli_real_escape_string($conn,$_POST['refraction_OD_SPH']);
      $refraction_OD_CYL = mysqli_real_escape_string($conn,$_POST['refraction_OD_CYL']);
      $refraction_OD_A = mysqli_real_escape_string($conn,$_POST['refraction_OD_A']);
      $refraction_OD_TYPEOFREFLEX = mysqli_real_escape_string($conn,$_POST['refraction_OD_TYPEOFREFLEX']);
      $PGG_OD_SPH = mysqli_real_escape_string($conn,$_POST['PGG_OD_SPH']);
      $PGG_OD_CYL = mysqli_real_escape_string($conn,$_POST['PGG_OD_CYL']);
      $PGG_OD_ADD = mysqli_real_escape_string($conn,$_POST['PGG_OD_ADD']);

      $refraction_OS_SPH = mysqli_real_escape_string($conn,$_POST['refraction_OS_SPH']);
      $refraction_OS_CYL = mysqli_real_escape_string($conn,$_POST['refraction_OS_CYL']);
      $refraction_OS_A = mysqli_real_escape_string($conn,$_POST['refraction_OS_A']);
      $refraction_OS_TYPEOFREFLEX = mysqli_real_escape_string($conn,$_POST['refraction_OS_TYPEOFREFLEX']);
      $PGG_OS_SPH = mysqli_real_escape_string($conn,$_POST['PGG_OS_SPH']);
      $PGG_OS_CYL = mysqli_real_escape_string($conn,$_POST['PGG_OS_CYL']);
      $PGG_OS_ADD = mysqli_real_escape_string($conn,$_POST['PGG_OS_ADD']);

      $acceptance_OD_SPH = mysqli_real_escape_string($conn,$_POST['acceptance_OD_SPH']);
      $acceptance_OD_CYL = mysqli_real_escape_string($conn,$_POST['acceptance_OD_CYL']);
      $acceptance_OD_A = mysqli_real_escape_string($conn,$_POST['acceptance_OD_A']);
      $acceptance_OD_ADD = mysqli_real_escape_string($conn,$_POST['acceptance_OD_ADD']);
      $acceptance_OD_cm = mysqli_real_escape_string($conn,$_POST['acceptance_OD_cm']);

      $acceptance_OS_SPH = mysqli_real_escape_string($conn,$_POST['acceptance_OS_SPH']);
      $acceptance_OS_CYL = mysqli_real_escape_string($conn,$_POST['acceptance_OS_CYL']);
      $acceptance_OS_A = mysqli_real_escape_string($conn,$_POST['acceptance_OS_A']);
      $acceptance_OS_ADD = mysqli_real_escape_string($conn,$_POST['acceptance_OS_ADD']);
      $acceptance_OS_cm = mysqli_real_escape_string($conn,$_POST['acceptance_OS_cm']);
      $K1_OD_SPH=   mysqli_real_escape_string($conn,$_POST['K1_OD_SPH']);
      $K1_OD_CYL=   mysqli_real_escape_string($conn,$_POST['K1_OD_CYL']);
      $K1_OD_A=   mysqli_real_escape_string($conn,$_POST['K1_OD_A']);
      $K1_OS_SPH=   mysqli_real_escape_string($conn,$_POST['K1_OS_SPH']);
      $K1_OS_CYL=   mysqli_real_escape_string($conn,$_POST['K1_OS_CYL']);
      $K1_OS_A=   mysqli_real_escape_string($conn,$_POST['K1_OS_A']);
      $K2_OD_SPH=   mysqli_real_escape_string($conn,$_POST['K2_OD_SPH']);
      $K2_OD_CYL=   mysqli_real_escape_string($conn,$_POST['K2_OD_CYL']);
      $K2_OD_A=   mysqli_real_escape_string($conn,$_POST['K2_OD_A']);
      $K2_OS_SPH=   mysqli_real_escape_string($conn,$_POST['K2_OS_SPH']);
      $K2_OS_CYL=   mysqli_real_escape_string($conn,$_POST['K2_OS_CYL']);
      $K2_OS_A=   mysqli_real_escape_string($conn,$_POST['K2_OS_A']);
      $remarks2= mysqli_real_escape_string($conn,$_POST['remarks2']);
      $PGG_OD_A=mysqli_real_escape_string($conn,$_POST['PGG_OD_A']);
      $PGG_OS_A=mysqli_real_escape_string($conn,$_POST['PGG_OS_A']);
      $PGG_OD_TYPEOFGLASS=mysqli_real_escape_string($conn,$_POST['PGG_OD_TYPEOFGLASS']);
      $PGG_OS_TYPEOFGLASS=mysqli_real_escape_string($conn,$_POST['PGG_OS_TYPEOFGLASS']);
      $sql ="INSERT INTO patientrecord(PGG_OD_TYPEOFGLASS,PGG_OS_TYPEOFGLASS,PGG_OD_A,PGG_OS_A,K1_OD_SPH,K1_OD_CYL,K1_OD_A,K1_OS_SPH,K1_OS_CYL,K1_OS_A,K2_OD_SPH,K2_OD_CYL,K2_OD_A,K2_OS_SPH,K2_OS_CYL,K2_OS_A,remarks1,remarks2,MRD_NO,NAME,AGE,PHONE,reasonvisit,complaints,ocularhistory,medicalhistory,birthhistory,vison_ODdistance,vison_ODnear,vison_ODcm,vison_without_ODdistance,vison_without_ODnear,vison_without_ODcm,vison_without_ODwhithph,vison_OSdistance,vison_OSnear,vison_OScm,vison_without_OSdistance,vison_without_OSnear,vison_without_OScm,vison_without_OSwhithph,type_of_chat1,refraction_OD_SPH,refraction_OD_CYL,refraction_OD_A,refraction_OD_TYPEOFREFLEX,PGG_OD_SPH,PGG_OD_CYL,PGG_OD_ADD,refraction_OS_SPH,refraction_OS_CYL,refraction_OS_A,refraction_OS_TYPEOFREFLEX,PGG_OS_SPH,PGG_OS_CYL,PGG_OS_ADD,acceptance_OD_SPH,acceptance_OD_CYL,acceptance_OD_A,acceptance_OD_ADD,acceptance_OD_cm,acceptance_OS_SPH,acceptance_OS_CYL,acceptance_OS_A,acceptance_OS_ADD,acceptance_OS_cm) VALUES('$PGG_OD_TYPEOFGLASS','$PGG_OD_TYPEOFGLASS','$PGG_OD_A','$PGG_OS_A','$K1_OD_SPH','$K1_OD_CYL','$K1_OD_A','$K1_OS_SPH','$K1_OS_CYL','$K1_OS_A','$K2_OD_SPH','$K2_OD_CYL','$K2_OD_A','$K2_OS_SPH','$K2_OS_CYL','$K2_OS_A','$remarks1','$remarks2','$MRD_NO','$NAME','$AGE','$PHONE','$reasonvisit','$complaints','$ocularhistory','$medicalhistory','$birthhistory','$vison_ODdistance','$vison_ODnear','$vison_ODcm','$vison_without_ODdistance','$vison_without_ODnear','$vison_without_ODcm','$vison_without_ODwhithph','$vison_OSdistance','$vison_OSnear','$vison_OScm','$vison_without_OSdistance','$vison_without_OSnear','$vison_without_OScm','$vison_without_OSwhithph','$type_of_chat1','$refraction_OD_SPH','$refraction_OD_CYL','$refraction_OD_A','$refraction_OD_TYPEOFREFLEX','$PGG_OD_SPH','$PGG_OD_CYL','$PGG_OD_ADD','$refraction_OS_SPH','$refraction_OS_CYL','$refraction_OS_A','$refraction_OS_TYPEOFREFLEX','$PGG_OS_SPH','$PGG_OS_CYL','$PGG_OS_ADD','$acceptance_OD_SPH','$acceptance_OD_CYL','$acceptance_OD_A','$acceptance_OD_ADD','$acceptance_OD_cm','$acceptance_OS_SPH','$acceptance_OS_CYL','$acceptance_OS_A','$acceptance_OS_ADD','$acceptance_OS_cm');";
      if(mysqli_query($conn,$sql)){
        echo "<div class='text-green m-2 p-2 text-center' style='font-size:1.5em;position:absolute;top:20%;px;left:40%;z-index:2'>patient data successfuly updated</div>";


      }else{
        echo "error".mysqli_error($conn);
      }
      mysqli_close($conn);
    }
  }
  ?>
