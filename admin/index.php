<?php
session_start();
include ("../_inc/db.php");
$con = connect();
if(isset($_POST["act"]) && $_POST["act"]=="login"){
    // echo $_POST["username"]." Vrea sa se logheze";

   
    $username = mysqli_real_escape_string($con,$_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $query = "SELECT `id`, `parola` FROM `utilizatori` 
            WHERE `username`='".$username."'";

    $result = mysqli_query($con, $query);
    $user=array();
     if (mysqli_num_rows($result) > 0) {
         // output data of each row
         while($row = mysqli_fetch_assoc($result)) {
               $user=$row;//valoarea din baza de date il pun in array pt a.l afisa in formular
               break;
         }
     } else {
        //  echo "User.ul nu a fost gasit";
     }
    //  echo "Parola db " . $user["parola"] . "</br>";
    //  echo "Parola trimisa " . $password . "</br>";
    //  echo "Parola trimisa md5" . md5($password) . "</br>";
     if($user["parola"]===md5($password)){

       $_SESSION = array(
           "logged_in" => true, 
           "username" => $username,
           "user_id" => $user["id"]


       );

    //    echo "User logat";
     }else{
        // echo "Parola nu se potriveste";
     }
}

    // var_dump($_SESSION);
    if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
        header("Location:./login.php");
        exit();
    }
    $sql1 = "SELECT * FROM `categorii` WHERE 1";
    $result1 = mysqli_query($con,$sql1);
    $nr_categorii = mysqli_num_rows($result1);
    
    $sql2 = "SELECT * FROM `articole` WHERE 1";
    $result2 = mysqli_query($con,$sql2);
    $nr_articole = mysqli_num_rows($result2);

    $sql3 = "SELECT * FROM `utilizatori` WHERE 1";
    $result3 = mysqli_query($con,$sql3);
    $nr_utilizatori = mysqli_num_rows($result3);

  include("./header.php");
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nr_categorii; ?></div>
                                    <div>Categorii</div>
                                </div>
                            </div>
                        </div>
                        <a href="./categorii_listare.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nr_articole; ?></div>
                                    <div>Articole</div>
                                </div>
                            </div>
                        </div>
                        <a href="./articole_listare.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $nr_utilizatori; ?></div>
                                    <div>Utilizatori</div>
                                </div>
                            </div>
                        </div>
                        <a href="./utilizatori_listare.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /#page-wrapper -->

<?php 
include ("./footer.php");
?>