<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
// functii criptare
// $parola = "213341";

// $hash = md5($parola);

// echo "hash md5: ". $hash. "</br>";

// $hash3 = hash("sha256",$parola);

// echo "hash sha256: ". $hash3. "</br>";

// $hash2 = base64_encode($parola);
// echo "hash base64 encode: ". $hash2. "</br>";

// echo "hash base64 decode: ". base64_decode($hash2). "</br>";



// exit();
if(isset($_POST)&&!empty($_POST)){
    // var_dump($_POST); exit();
    include ("../_inc/db.php");
    $con = connect();
    //1. curatare input
    $username = mysqli_real_escape_string($con,$_POST["username"]);
    $password = mysqli_real_escape_string($con,$_POST["password"]);
    $password_re = mysqli_real_escape_string($con,$_POST["password_re"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    //2. verifica parolele
    $error = false;
    if ($password !== $password_re){
        $error = true;
    }
    // 3. verific utilizatorul
    if (strlen($username)<=3){
        $error = true;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
    }
    if ($error == false){
    //    echo $file_name;
        $query = "INSERT INTO `utilizatori` SET
                `username` = '".$username."',
                `parola` = '".md5($password)."',
                `email` = '".$email."',
                `status` = '1'
                ";
                // echo nl2br($query) ;
                // exit();

         $result = mysqli_query($con, $query);
       $iesire = closedb ($con);
       header("Location:./utilizatori_listare.php");
       exit();
    }else{
        $mesaj = "Ai erori ba boule";
        echo $mesaj;
    }

}

include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adaugare utilizatori</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12">
            <form action="./utilizatori_adaugare.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username"  name="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email"  name="email" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="password">Parola</label>
                    <input type="password" class="form-control" id="password"  name="password" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="password_re">Parola din nou</label>
                    <input type="password" class="form-control" id="password_re"  name="password_re" placeholder="password_re">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                </form>


            </div>
         </div>
    </div>

        <!-- /#page-wrapper -->

<?php 
include ("./footer.php");
?>