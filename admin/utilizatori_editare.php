<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
if(isset($_GET["id"]) && $_GET["id"]>0){
    // echo "ID.ul este ".$_GET["id"];
    $id=$_GET["id"];
} else{ 
   // if (!isset($_POST["itemId"]){
    exit();
}

if(isset($_POST)&&!empty($_POST)&&$_POST["act"]=="changedetails"){

    // echo "modificam detaliile";
    // exit();
    include ("../_inc/db.php");
    $con = connect();
    $username = mysqli_real_escape_string($con,$_POST["username"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $query = "UPDATE `utilizatori` SET 
    `username`='".$username . "',
    `email`='".$email. "'
    WHERE `id`='".$id."'
    ";
    $result = mysqli_query($con, $query);
     $iesire = closedb ($con);
     header("Location:./utilizatori_listare.php");
    exit();
}
if(isset($_POST)&&!empty($_POST)&&$_POST["act"]=="changepassword"){

    // echo "modificam detaliile";
    // exit();
    include ("../_inc/db.php");
    $con = connect();
    $password = mysqli_real_escape_string($con,$_POST["password"]);
    $password_re = mysqli_real_escape_string($con, $_POST["password_re"]);
    $password_a = mysqli_real_escape_string($con, $_POST["password_a"]);
    $error = false;
    if ($password !== $password_re){
        $error = true;
    }
    //selectez parola actuala din baza de date pt a o compara cu ce a pus el la parola actuala
    $query1 = "SELECT `parola` FROM `utilizatori`
        WHERE `id` = '".$id."'";
    $result = mysqli_query($con, $query1);
// var_dump($result);

    $user = getRow($result);
    if($user["parola"]!==md5($password_a)){
        $error = true;
    }
    if ($error == false){
        $query = "UPDATE `utilizatori` SET 
        `parola`='".md5($password) . "'
        WHERE `id`='".$id."'
        ";
        $result = mysqli_query($con, $query);
        $iesire = closedb ($con);
        header("Location:./utilizatori_listare.php");
        exit();
    }else{
        $mesaj = "Ai erori ba boule";
        echo $mesaj;
        exit();
    }

}
include ("../_inc/db.php");
$con = connect();
$query1 = "SELECT `username`, `email`  FROM `utilizatori`
        WHERE `id` = '".$id."'";
$result = mysqli_query($con, $query1);
// var_dump($result);

$user=getRow($result);
// var_dump($category);
include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editare utilizator</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12 edit-form">
            <form action="./utilizatori_editare.php?id=<?php echo $id ;?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username"  name="username" placeholder="username" value="<?php echo $user["username"];?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email"  name="email" placeholder="email" value="<?php echo $user["email"];?>">
                </div>
                <input type="hidden" name="act" value="changedetails">
                <button type="submit" class="btn btn-default">Submit</button>
                </form>


            </div>
         </div>
         <div class = "row">
            <div class =" col-md-12 ">
            <form action="./utilizatori_editare.php?id=<?php echo $id ;?>" method="post">
                <div class="form-group">
                    <label for="password">Parola noua</label>
                    <input type="password" class="form-control" id="password"  name="password" placeholder="New password" >
                </div>
                <div class="form-group">
                    <label for="password_re">Reintroduceti parola</label>
                    <input type="password" class="form-control" id="password_re"  name="password_re" placeholder="New password">
                </div>
                <div class="form-group">
                    <label for="password_a">Parola veche</label>
                    <input type="password" class="form-control" id="password_a"  name="password_a" placeholder="old password" >
                </div>
                <input type="hidden" name="act" value="changepassword">
                <button type="submit" class="btn btn-default">Submit</button>
                </form>


            </div>
         </div>
    </div>

        <!-- /#page-wrapper -->

<?php 
include ("./footer.php");
?>