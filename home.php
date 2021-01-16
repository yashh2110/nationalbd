<?php
session_start();
include "dbconn.php";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">
    <title>NationalOpticals | Datacenter</title>
  </head>
  <body>
    <nav class="navbar sticky-top navbar-expand-sm ">
      <div class="navbar-brand logo">
       <a class="text-dark"href="home.php"><h2 >NationalOpticals</h2></a>
      </div>
      <div class=" srcmrd">
        <form class="input-group"  action="home.php" method="post">
          <input type="text" class="form-control" id="src" name="mrd" placeholder="Enter MRD or Phone number" value="<?php if(isset($_POST['mrdsubmitbtn'])){
            if(!empty($_POST['mrd'])){
              echo $_POST['mrd'];
            }
          }
          if(isset($_GET['mrd'])){
            echo $_GET['mrd'];
          }
           ?>">
          <button type="submit" class="btn btn-primary" name="mrdsubmitbtn">Search</button>
        </form>
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

    <?php
      if(isset($_POST['mrdsubmitbtn'])||isset($_GET['view'])||isset($_GET['mrd1'])){
        if(isset($_POST['mrdsubmitbtn'])){
          $_SESSION['srcmrd']=$_POST['mrd'];
        }
        if (isset($_GET['mrd1'])) {
          $_SESSION['srcmrd']=$_GET['mrd1'];
        }
        if(!$conn){
          die("error ".mysqli_connect_error());
        }?>

            <div class="nav-item p-2">

              <a class="btn btn-warning p-2" href="addData.php">Add Record</a>

            </div>
            </nav>
            <?php
            $srcmrd = $_SESSION['srcmrd'];
            $num = mysqli_real_escape_string($conn,$srcmrd);
            $sql = "SELECT * FROM patientrecord WHERE MRD_NO='$num' || PHONE='$num' ORDER BY `date` DESC";
            if($query=mysqli_query($conn,$sql)){
              $numrowsdb=mysqli_num_rows($query);
              if($numrowsdb>0){
                if (! $conn) {
                  die("Connection failed" . mysqli_connect_error());
                }
                $results_per_page = 1;
                $query = "select *from patientrecord";
                $result = mysqli_query($conn, $query);
                $number_of_result = mysqli_num_rows($result);
                $number_of_page = ceil ($number_of_result / $results_per_page);
                if (!isset ($_GET['view']) ) {
                    $view = 1;
                } else {
                    $view = $_GET['view'];
                }
                $page_first_result = ($view-1) * $results_per_page;
                $query = "SELECT * FROM patientrecord WHERE MRD_NO='$num' || PHONE='$num' ORDER BY `date` DESC LIMIT " . $page_first_result . ',' . $results_per_page;
                $result = mysqli_query($conn, $query);

                while($info=mysqli_fetch_assoc($result)){
                  $_SESSION['mrd']=$info['MRD_NO'];
                  $_SESSION['name']=$info['NAME'];
                  $_SESSION['age']=$info['AGE'];
                  $_SESSION['phone']=$info['PHONE'];
                ?>
                <main>
                  <!-- DETAILS -->
                  <div class="container-sm bg-light">
                    <div class="input-group">
                      <h4 class="persondata">MRD NO:  <p class="ans"><?php echo $info['MRD_NO']; ?></p></h4>
                      <h4 class="persondata">NAME: <p class="ans"><?php echo $info['NAME']; ?></p></h4>
                      <h4 class="persondata">AGE:  <p class="ans"><?php echo $info['AGE']; ?></p></h4>
                      <h4 class="persondata">phone: <p class="ans"><?php echo $info['PHONE']; ?></p></h4>
                    </div>
                  </div>
                  <br>
                  <br>
                  <hr>
                  <div class="container-sm p-0 ">
                    <p class="text-center"><?php echo $info['date'] ?></p>
                  </div>
                  <!-- HISORY TAKING -->
                  <h5 class="container  p-2 mt-2">HISTORY TAKING
                    <form action="edit.php" style="float:right" method="post">
                      <input type="hidden" name="MRD_NO1" value="<?php echo $info['MRD_NO']; ?>">
                      <input type="hidden" name="NAME" value="<?php echo $info['NAME']; ?>">
                      <input type="hidden" name="AGE" value="<?php echo $info['AGE']; ?>">
                      <input type="hidden" name="PHONE" value="<?php echo $info['PHONE']; ?>">
                      <input type="hidden" name="reasonvisit" value="<?php echo $info['reasonvisit']; ?>">
                      <input type="hidden" name="complaints" value="<?php echo $info['complaints']; ?>">
                      <input type="hidden" name="ocularhistory" value="<?php echo $info['ocularhistory']; ?>">
                      <input type="hidden" name="medicalhistory" value="<?php echo $info['medicalhistory']; ?>">
                      <input type="hidden" name="birthhistory" value="<?php echo $info['birthhistory']; ?>">
                      <input type="hidden" name="remarks1" value="<?php echo $info['remarks1']; ?>">
                      <input type="hidden" name="vison_ODdistance" value="<?php echo $info['vison_ODdistance']; ?>">
                      <input type="hidden" name="vison_ODnear" value="<?php echo $info['vison_ODnear']; ?>">
                      <input type="hidden" name="vison_ODcm" value="<?php echo $info['vison_ODcm']; ?>">
                      <input type="hidden" name="vison_without_ODdistance" value="<?php echo $info['vison_without_ODdistance']; ?>">
                      <input type="hidden" name="vison_without_ODnear" value="<?php echo $info['vison_without_ODnear']; ?>">
                      <input type="hidden" name="vison_without_ODcm" value="<?php echo $info['vison_without_ODcm']; ?>">
                      <input type="hidden" name="vison_without_ODwhithph" value="<?php echo $info['vison_without_ODwhithph']; ?>">
                      <input type="hidden" name="vison_OSdistance" value="<?php echo $info['vison_OSdistance']; ?>">
                      <input type="hidden" name="vison_OSnear" value="<?php echo $info['vison_OSnear']; ?>">
                      <input type="hidden" name="vison_OScm" value="<?php echo $info['vison_OScm']; ?>">
                      <input type="hidden" name="vison_without_OSdistance" value="<?php echo $info['vison_without_OSdistance']; ?>">
                      <input type="hidden" name="vison_without_OSnear" value="<?php echo $info['vison_without_OSnear']; ?>">
                      <input type="hidden" name="vison_without_OScm" value="<?php echo $info['vison_without_OScm']; ?>">
                      <input type="hidden" name="vison_without_OSwhithph" value="<?php echo $info['vison_without_OSwhithph']; ?>">
                      <input type="hidden" name="type_of_chat1" value="<?php echo $info['type_of_chat1']; ?>">
                      <input type="hidden" name="type_of_chat2" value="<?php echo $info['type_of_chat2']; ?>">
                      <input type="hidden" name="refraction_OD_SPH" value="<?php echo $info['refraction_OD_SPH']; ?>">
                      <input type="hidden" name="refraction_OD_CYL" value="<?php echo $info['refraction_OD_CYL']; ?>">
                      <input type="hidden" name="refraction_OD_A" value="<?php echo $info['refraction_OD_A']; ?>">
                      <input type="hidden" name="refraction_OD_TYPEOFREFLEX" value="<?php echo $info['refraction_OD_TYPEOFREFLEX']; ?>">
                      <input type="hidden" name="PGG_OD_SPH" value="<?php echo $info['PGG_OD_SPH']; ?>">
                      <input type="hidden" name="PGG_OD_CYL" value="<?php echo $info['PGG_OD_CYL']; ?>">
                      <input type="hidden" name="PGG_OD_A" value="<?php echo $info['PGG_OD_A']; ?>">
                      <input type="hidden" name="PGG_OD_ADD" value="<?php echo $info['PGG_OD_ADD']; ?>">
                      <input type="hidden" name="refraction_OS_SPH" value="<?php echo $info['refraction_OS_SPH']; ?>">
                      <input type="hidden" name="refraction_OS_CYL" value="<?php echo $info['refraction_OS_CYL']; ?>">
                      <input type="hidden" name="refraction_OS_A" value="<?php echo $info['refraction_OS_A']; ?>">
                      <input type="hidden" name="refraction_OS_TYPEOFREFLEX" value="<?php echo $info['refraction_OS_TYPEOFREFLEX']; ?>">
                      <input type="hidden" name="PGG_OS_SPH" value="<?php echo $info['PGG_OS_SPH']; ?>">
                      <input type="hidden" name="PGG_OS_CYL" value="<?php echo $info['PGG_OS_CYL']; ?>">
                      <input type="hidden" name="PGG_OS_A" value="<?php echo $info['PGG_OS_A']; ?>">
                      <input type="hidden" name="PGG_OS_ADD" value="<?php echo $info['PGG_OS_ADD']; ?>">
                      <input type="hidden" name="acceptance_OD_SPH" value="<?php echo $info['acceptance_OD_SPH']; ?>">
                      <input type="hidden" name="acceptance_OD_CYL" value="<?php echo $info['acceptance_OD_CYL']; ?>">
                      <input type="hidden" name="acceptance_OD_A" value="<?php echo $info['acceptance_OD_A']; ?>">
                      <input type="hidden" name="acceptance_OD_ADD" value="<?php echo $info['acceptance_OD_ADD']; ?>">
                      <input type="hidden" name="acceptance_OD_cm" value="<?php echo $info['acceptance_OD_cm']; ?>">
                      <input type="hidden" name="acceptance_OS_SPH" value="<?php echo $info['acceptance_OS_SPH']; ?>">
                      <input type="hidden" name="acceptance_OS_CYL" value="<?php echo $info['acceptance_OS_CYL']; ?>">
                      <input type="hidden" name="acceptance_OS_A" value="<?php echo $info['acceptance_OS_A']; ?>">
                      <input type="hidden" name="acceptance_OS_ADD" value="<?php echo $info['acceptance_OS_ADD']; ?>">
                      <input type="hidden" name="acceptance_OS_cm" value="<?php echo $info['acceptance_OS_cm']; ?>">
                      <input type="hidden" name="K1_OD_SPH" value="<?php echo $info['K1_OD_SPH']; ?>">
                      <input type="hidden" name="K1_OD_CYL" value="<?php echo $info['K1_OD_CYL']; ?>">
                      <input type="hidden" name="K1_OD_A" value="<?php echo $info['K1_OD_A']; ?>">
                      <input type="hidden" name="K1_OS_SPH" value="<?php echo $info['K1_OS_SPH']; ?>">
                      <input type="hidden" name="K1_OS_CYL" value="<?php echo $info['K1_OS_CYL']; ?>">
                      <input type="hidden" name="K1_OS_A" value="<?php echo $info['K1_OS_A']; ?>">
                      <input type="hidden" name="K2_OD_SPH" value="<?php echo $info['K2_OD_SPH']; ?>">
                      <input type="hidden" name="K2_OD_CYL" value="<?php echo $info['K2_OD_CYL']; ?>">
                      <input type="hidden" name="K2_OD_A" value="<?php echo $info['K2_OD_A']; ?>">
                      <input type="hidden" name="K2_OS_SPH" value="<?php echo $info['K2_OS_SPH']; ?>">
                      <input type="hidden" name="K2_OS_CYL" value="<?php echo $info['K2_OS_CYL']; ?>">
                      <input type="hidden" name="K2_OS_A" value="<?php echo $info['K2_OS_A']; ?>">
                      <input type="hidden" name="remarks2" value="<?php echo $info['remarks2']; ?>">
                      <input type="hidden" name="PGG_OD_TYPEOFGLASS" value="<?php echo $info['PGG_OD_TYPEOFGLASS']; ?>">
                      <input type="hidden" name="PGG_OS_TYPEOFGLASS" value="<?php echo $info['PGG_OS_TYPEOFGLASS']; ?>">
                      <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                      <input type="hidden" name="PGG_GLASS_STATUS" value="<?php echo $info['PGG_GLASS_STATUS']; ?>">

                      <button type="submit" class="btn btn-primary" name="button">EDIT</button>



                    </form>
                  </h5>
                  <div class="container-sm history">
                    <h5 class="historyitem persondata">PURPOSE OF VISIT: <p class="ans"> <?php echo $info['reasonvisit'] ?></p></h5>
                    <h5 class="historyitem persondata">COMPLAINTS:   <p class="ans"><?php echo $info['complaints'] ?></p></h5>
                    <h5 class="historyitem persondata">OCULAR HISTORY:  <p class="ans"><?php echo $info['ocularhistory'] ?></p></h5>
                    <h5 class="historyitem persondata">MEDICAL HISTORY: <p class="ans"><?php echo $info['medicalhistory'] ?></p></h5>
                    <h5 class="historyitem persondata">BIRTH HISTORY :  <p class="ans"><?php echo $info['birthhistory'] ?></p></h5>
                    <h5 class="historyitem persondata">REMARKS: <p class="ans"><?php echo $info['remarks1'] ?></h5>
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
                          <th>DISTANCE</th>
                          <th>NEAR</th>
                          <th></th>
                          <th></th>
                          <th>DISTANCE</th>
                          <th>NEAR</th>
                          <th>cm</th>
                          <th>WITH PH</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>OD</td>
                          <td><?php echo $info['vison_ODdistance'] ?></td>
                          <td><?php echo $info['vison_ODnear'] ?></td>
                          <td><?php echo $info['vison_ODcm'] ?></td>
                          <td>OD</td>
                          <td><?php echo $info['vison_without_ODdistance'] ?></td>
                          <td><?php echo $info['vison_without_ODnear'] ?></td>
                          <td><?php echo $info['vison_without_ODcm'] ?></td>
                          <td><?php echo $info['vison_without_ODwhithph'] ?></td>
                        </tr>
                        <tr>
                          <td>OS</td>
                          <td><?php echo $info['vison_OSdistance'] ?></td>
                          <td><?php echo $info['vison_OSnear'] ?></td>
                          <td><?php echo $info['vison_OScm'] ?></td>
                          <td>OS</td>
                          <td><?php echo $info['vison_without_OSdistance'] ?></td>
                          <td><?php echo $info['vison_without_OSnear'] ?></td>
                          <td><?php echo $info['vison_without_OScm'] ?></td>
                          <td><?php echo $info['vison_without_OSwhithph'] ?></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>TYPE OF CHARTS</td>
                          <td><?php echo $info['type_of_chat1'] ?></td>

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
                          <?php echo $info['PGG_GLASS_STATUS'] ?>
                        </div>
                      </tr>
                      </thead>
                    </table>
                    <table class="table table-sm table-hover refclass">
                      <thead>
                        <tr>
                          <th></th>
                          <th>SPH</th>
                          <th>CYL</th>
                          <th >A</th>
                          <th>TYPE OF REFLEX</th>
                          <th></th>
                          <th>SPH</th>
                          <th>CYL</th>
                          <th>ADD</th>
                          <th>TYPE OF GLASS</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>OD</td>
                          <td><?php echo $info['refraction_OD_SPH'] ?></td>
                          <td><?php echo $info['refraction_OD_CYL'] ?></td>
                          <td><?php echo $info['refraction_OD_A'] ?></td>
                          <td><?php echo $info['refraction_OD_TYPEOFREFLEX'] ?></td>
                          <td>OD</td>
                          <td><?php echo $info['PGG_OD_SPH'] ?></td>
                          <td><?php echo $info['PGG_OD_CYL'] ?></td>
                          <td><?php echo $info['PGG_OD_A'] ?></td>
                          <td><?php echo $info['PGG_OD_ADD'] ?></td>
                          <td><?php echo $info['PGG_OD_TYPEOFGLASS'] ?></td>
                        </tr>
                        <tr>
                          <td>OS</td>
                          <td><?php echo $info['refraction_OS_SPH'] ?></td>
                          <td><?php echo $info['refraction_OS_CYL'] ?></td>
                          <td><?php echo $info['refraction_OS_A'] ?></td>
                          <td><?php echo $info['refraction_OS_TYPEOFREFLEX'] ?></td>
                          <td>OS</td>
                          <td><?php echo $info['PGG_OS_SPH'] ?></td>
                          <td><?php echo $info['PGG_OS_CYL'] ?></td>
                          <td><?php echo $info['PGG_OS_A'] ?></td>
                          <td><?php echo $info['PGG_OS_ADD'] ?></td>
                          <td><?php echo $info['PGG_OS_TYPEOFGLASS'] ?></td>
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
                          <th>SHP</th>
                          <th>CYL</th>
                          <th>A</th>
                          <th>ADD</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>OD</td>
                          <td><?php echo $info['acceptance_OD_SPH']; ?></td>
                          <td><?php echo $info['acceptance_OD_CYL']; ?></td>
                          <td><?php echo $info['acceptance_OD_A']; ?></td>
                          <td><?php echo $info['acceptance_OD_ADD']; ?></td>
                          <td><?php echo $info['acceptance_OD_cm']; ?>cm</td>

                        </tr>
                        <tr>
                          <td>OS</td>
                          <td><?php echo $info['acceptance_OS_SPH']; ?></td>
                          <td><?php echo $info['acceptance_OS_CYL']; ?></td>
                          <td><?php echo $info['acceptance_OS_A']; ?></td>
                          <td><?php echo $info['acceptance_OS_ADD']; ?></td>
                          <td><?php echo $info['acceptance_OS_cm']; ?>cm</td>

                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <h5 class="container-sm p-2 mt-2">GLASS PRESCRIPTION</h5>
                  <div class="container-sm prescriptionclass">
                    <table class="table table-borderless text-center">
                      <thead>
                        <tr>
                          <tr>
                            <th>GLASS PRESCRIPTION</th>
                          </tr>
                        </tr>
                      </thead>
                    </table>
                    <table class="table table-sm table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>SHP</th>
                          <th>CYL</th>
                          <th>A</th>
                          <th>ADD</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>OD</td>
                          <td><?php echo $info['acceptance_OD_SPH']; ?></td>
                          <td><?php echo $info['acceptance_OD_CYL']; ?></td>
                          <td><?php echo $info['acceptance_OD_A']; ?></td>
                          <td><?php echo $info['acceptance_OD_ADD']; ?></td>
                          <td><?php echo $info['acceptance_OD_cm']; ?>cm</td>

                        </tr>
                        <tr>
                          <td>OS</td>
                          <td><?php echo $info['acceptance_OS_SPH']; ?></td>
                          <td><?php echo $info['acceptance_OS_CYL']; ?></td>
                          <td><?php echo $info['acceptance_OS_A']; ?></td>
                          <td><?php echo $info['acceptance_OS_ADD']; ?></td>
                          <td><?php echo $info['acceptance_OS_cm']; ?>cm</td>

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

                            <th>SHP</th>
                            <th>CYL</th>
                            <th>A</th>
                            <th></th>
                            <th>SHP</th>
                            <th>CYL</th>
                            <th>A</th>

                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>K1</td>
                            <td><?php echo $info['K1_OD_SPH']; ?> </td>
                            <td><?php echo $info['K1_OD_CYL']; ?> </td>
                            <td><?php echo $info['K1_OD_A']; ?> </td>
                            <td></td>
                            <td><?php echo $info['K1_OS_SPH']; ?> </td>
                            <td><?php echo $info['K1_OS_CYL']; ?></td>
                            <td><?php echo $info['K1_OS_A']; ?></td>
                          </tr>
                          <tr>
                            <td>K2</td>
                            <td><?php echo $info['K2_OD_SPH']; ?> </td>
                            <td><?php echo $info['K2_OD_CYL']; ?> </td>
                            <td><?php echo $info['K2_OD_A']; ?> </td>
                            <td></td>
                            <td><?php echo $info['K2_OS_SPH']; ?> </td>
                            <td><?php echo $info['K2_OS_CYL']; ?></td>
                            <td><?php echo $info['K2_OS_A']; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                  <div class="container-sm p-2">
                    <div class="b-inline">
                      <h4>Remarks:</h4>
                      <?php echo $info['remarks2']; ?>
                    </div>
                  </div>
                </main>
                <hr>
                <br>
                <br>
                <?php

              }
                echo "<div class='container-sm text-center'>";
                for($view = 1; $view<= $number_of_page; $view++) {
                    echo '<a class="btn btn-primary m-1" href = "home.php?view=' . $view . '">' . $view . ' </a>';
                }
                echo "</div>";

          }else{
            ?>
            </nav>
            <main>
              <div  class="container-sm errorcon ">
                  <div class='error text-danger text-center'> <i class='fas fa-times-circle'>error no record found</i> </div>
              </div>
              <?php

          }
        }else{
          die("error".mysqli_error($conn));
        }
        mysqli_close($conn);
      }else{
        ?>
          </nav>
          <?php
          if(isset($_GET['mrd'])){
            ?>
            <div class="container-sm errorcon">
              <div class="error text-success">
                <i style="font-size:2em"class="far fa-smile-beam d-block text-center"></i> <p class="text-center">The Data have updated successfuly</p>
              </div>
            </div>



            <?php
          }
          if(isset($_GET['message'])){
            ?>
            <div class="container-sm errorcon">
              <div class="error text-success">
                <i style="font-size:2em"class="far fa-smile-beam d-block text-center"></i> <p class="text-center">Patient Data have updated successfuly</p>
              </div>
            </div>
            <?php
          }
          if(!isset($_GET['mrd'])){
            if(!isset($_GET['message'])){

              if (! $conn) {
                die("Connection failed" . mysqli_connect_error());
              }
              $results_per_page = 10;
              $query = "select *from patientrecord";
              $result = mysqli_query($conn, $query);
              $number_of_result = mysqli_num_rows($result);
              $number_of_page = ceil ($number_of_result / $results_per_page);
              if (!isset ($_GET['page']) ) {
                  $page = 1;
              } else {
                  $page = $_GET['page'];
              }
              $page_first_result = ($page-1) * $results_per_page;
              $query = "SELECT *FROM patientrecord ORDER BY `date` DESC LIMIT " . $page_first_result . ',' . $results_per_page;
              $result = mysqli_query($conn, $query);
              echo "<div class='container-sm bg-light'>";
              echo "<table class='table table-hover'>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>MRD NUM / PHONE</th>";
              echo "<th>Patient Name</th>";
              // echo "<th></th>";
              echo "<th>Last vist</th>";
              echo "<th></th>";
              echo "<th></th>";
              echo "</tr>";
              echo "</thead>";
              while($info= mysqli_fetch_assoc($result)){
                ?>
                <tbody>
                  <tr>
                    <td class="filter"><a class="text-dark a" href="home.php?mrd1=<?php echo $info['MRD_NO'];?>"><?php echo $info['MRD_NO']  ." / ". $info['PHONE']; ?></a></td>
                    <td><a class="text-dark a" href="home.php?mrd1=<?php echo $info['MRD_NO'];?>"><?php echo $info['NAME']; ?></a></td>

                    <td><a class="text-dark a" href="home.php?mrd1=<?php echo $info['MRD_NO'];?>"><?php echo $info['date']; ?></a></td>
                    <td><form action="edit.php" style="float:right" method="post">
                      <input type="hidden" name="MRD_NO1" value="<?php echo $info['MRD_NO']; ?>">
                      <input type="hidden" name="NAME" value="<?php echo $info['NAME']; ?>">
                      <input type="hidden" name="AGE" value="<?php echo $info['AGE']; ?>">
                      <input type="hidden" name="PHONE" value="<?php echo $info['PHONE']; ?>">
                      <input type="hidden" name="reasonvisit" value="<?php echo $info['reasonvisit']; ?>">
                      <input type="hidden" name="complaints" value="<?php echo $info['complaints']; ?>">
                      <input type="hidden" name="ocularhistory" value="<?php echo $info['ocularhistory']; ?>">
                      <input type="hidden" name="medicalhistory" value="<?php echo $info['medicalhistory']; ?>">
                      <input type="hidden" name="birthhistory" value="<?php echo $info['birthhistory']; ?>">
                      <input type="hidden" name="remarks1" value="<?php echo $info['remarks1']; ?>">
                      <input type="hidden" name="vison_ODdistance" value="<?php echo $info['vison_ODdistance']; ?>">
                      <input type="hidden" name="vison_ODnear" value="<?php echo $info['vison_ODnear']; ?>">
                      <input type="hidden" name="vison_ODcm" value="<?php echo $info['vison_ODcm']; ?>">
                      <input type="hidden" name="vison_without_ODdistance" value="<?php echo $info['vison_without_ODdistance']; ?>">
                      <input type="hidden" name="vison_without_ODnear" value="<?php echo $info['vison_without_ODnear']; ?>">
                      <input type="hidden" name="vison_without_ODcm" value="<?php echo $info['vison_without_ODcm']; ?>">
                      <input type="hidden" name="vison_without_ODwhithph" value="<?php echo $info['vison_without_ODwhithph']; ?>">
                      <input type="hidden" name="vison_OSdistance" value="<?php echo $info['vison_OSdistance']; ?>">
                      <input type="hidden" name="vison_OSnear" value="<?php echo $info['vison_OSnear']; ?>">
                      <input type="hidden" name="vison_OScm" value="<?php echo $info['vison_OScm']; ?>">
                      <input type="hidden" name="vison_without_OSdistance" value="<?php echo $info['vison_without_OSdistance']; ?>">
                      <input type="hidden" name="vison_without_OSnear" value="<?php echo $info['vison_without_OSnear']; ?>">
                      <input type="hidden" name="vison_without_OScm" value="<?php echo $info['vison_without_OScm']; ?>">
                      <input type="hidden" name="vison_without_OSwhithph" value="<?php echo $info['vison_without_OSwhithph']; ?>">
                      <input type="hidden" name="type_of_chat1" value="<?php echo $info['type_of_chat1']; ?>">
                      <input type="hidden" name="type_of_chat2" value="<?php echo $info['type_of_chat2']; ?>">
                      <input type="hidden" name="refraction_OD_SPH" value="<?php echo $info['refraction_OD_SPH']; ?>">
                      <input type="hidden" name="refraction_OD_CYL" value="<?php echo $info['refraction_OD_CYL']; ?>">
                      <input type="hidden" name="refraction_OD_A" value="<?php echo $info['refraction_OD_A']; ?>">
                      <input type="hidden" name="refraction_OD_TYPEOFREFLEX" value="<?php echo $info['refraction_OD_TYPEOFREFLEX']; ?>">
                      <input type="hidden" name="PGG_OD_SPH" value="<?php echo $info['PGG_OD_SPH']; ?>">
                      <input type="hidden" name="PGG_OD_CYL" value="<?php echo $info['PGG_OD_CYL']; ?>">
                      <input type="hidden" name="PGG_OD_A" value="<?php echo $info['PGG_OD_A']; ?>">
                      <input type="hidden" name="PGG_OD_ADD" value="<?php echo $info['PGG_OD_ADD']; ?>">
                      <input type="hidden" name="refraction_OS_SPH" value="<?php echo $info['refraction_OS_SPH']; ?>">
                      <input type="hidden" name="refraction_OS_CYL" value="<?php echo $info['refraction_OS_CYL']; ?>">
                      <input type="hidden" name="refraction_OS_A" value="<?php echo $info['refraction_OS_A']; ?>">
                      <input type="hidden" name="refraction_OS_TYPEOFREFLEX" value="<?php echo $info['refraction_OS_TYPEOFREFLEX']; ?>">
                      <input type="hidden" name="PGG_OS_SPH" value="<?php echo $info['PGG_OS_SPH']; ?>">
                      <input type="hidden" name="PGG_OS_CYL" value="<?php echo $info['PGG_OS_CYL']; ?>">
                      <input type="hidden" name="PGG_OS_A" value="<?php echo $info['PGG_OS_A']; ?>">
                      <input type="hidden" name="PGG_OS_ADD" value="<?php echo $info['PGG_OS_ADD']; ?>">
                      <input type="hidden" name="acceptance_OD_SPH" value="<?php echo $info['acceptance_OD_SPH']; ?>">
                      <input type="hidden" name="acceptance_OD_CYL" value="<?php echo $info['acceptance_OD_CYL']; ?>">
                      <input type="hidden" name="acceptance_OD_A" value="<?php echo $info['acceptance_OD_A']; ?>">
                      <input type="hidden" name="acceptance_OD_ADD" value="<?php echo $info['acceptance_OD_ADD']; ?>">
                      <input type="hidden" name="acceptance_OD_cm" value="<?php echo $info['acceptance_OD_cm']; ?>">
                      <input type="hidden" name="acceptance_OS_SPH" value="<?php echo $info['acceptance_OS_SPH']; ?>">
                      <input type="hidden" name="acceptance_OS_CYL" value="<?php echo $info['acceptance_OS_CYL']; ?>">
                      <input type="hidden" name="acceptance_OS_A" value="<?php echo $info['acceptance_OS_A']; ?>">
                      <input type="hidden" name="acceptance_OS_ADD" value="<?php echo $info['acceptance_OS_ADD']; ?>">
                      <input type="hidden" name="acceptance_OS_cm" value="<?php echo $info['acceptance_OS_cm']; ?>">
                      <input type="hidden" name="K1_OD_SPH" value="<?php echo $info['K1_OD_SPH']; ?>">
                      <input type="hidden" name="K1_OD_CYL" value="<?php echo $info['K1_OD_CYL']; ?>">
                      <input type="hidden" name="K1_OD_A" value="<?php echo $info['K1_OD_A']; ?>">
                      <input type="hidden" name="K1_OS_SPH" value="<?php echo $info['K1_OS_SPH']; ?>">
                      <input type="hidden" name="K1_OS_CYL" value="<?php echo $info['K1_OS_CYL']; ?>">
                      <input type="hidden" name="K1_OS_A" value="<?php echo $info['K1_OS_A']; ?>">
                      <input type="hidden" name="K2_OD_SPH" value="<?php echo $info['K2_OD_SPH']; ?>">
                      <input type="hidden" name="K2_OD_CYL" value="<?php echo $info['K2_OD_CYL']; ?>">
                      <input type="hidden" name="K2_OD_A" value="<?php echo $info['K2_OD_A']; ?>">
                      <input type="hidden" name="K2_OS_SPH" value="<?php echo $info['K2_OS_SPH']; ?>">
                      <input type="hidden" name="K2_OS_CYL" value="<?php echo $info['K2_OS_CYL']; ?>">
                      <input type="hidden" name="K2_OS_A" value="<?php echo $info['K2_OS_A']; ?>">
                      <input type="hidden" name="remarks2" value="<?php echo $info['remarks2']; ?>">
                      <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                      <input type="hidden" name="PGG_GLASS_STATUS" value="<?php echo $info['PGG_GLASS_STATUS']; ?>">
                      <input type="hidden" name="PGG_OD_TYPEOFGLASS" value="<?php echo $info['PGG_OD_TYPEOFGLASS']; ?>">
                      <input type="hidden" name="PGG_OS_TYPEOFGLASS" value="<?php echo $info['PGG_OS_TYPEOFGLASS']; ?>">
                      <button type="submit" class="btn btn-primary" name="button">EDIT</button>

                    </form> </td>
                    <td>
                      <form action="addData.php" method="post">
                      <input type="hidden" name="MRD_NO1" value="<?php echo $info['MRD_NO']; ?>">
                      <input type="hidden" name="NAME" value="<?php echo $info['NAME']; ?>">
                      <input type="hidden" name="AGE" value="<?php echo $info['AGE']; ?>">
                      <input type="hidden" name="PHONE" value="<?php echo $info['PHONE']; ?>">
                      <button type="submit" class="btn btn-warning text-white" name="addthroughdashbord">AddData</button>
                    </form>
                    </td>
                  </tr></a>

                </tbody>
                <?php
              }
              echo "</table>";
              echo "</div>";
              echo "<div class='container-sm text-center'>";

              for($page = 1; $page<= $number_of_page; $page++) {
                  echo '<a class="btn btn-primary m-1" href = "home.php?page=' . $page . '">' . $page . ' </a>';
              }

            }
          }
      echo  "</main>";
      }
     ?>
    <br>
    <script type="text/javascript" src="./js/home.js"></script>
  </body>
</html>
<?php
}
 ?>
