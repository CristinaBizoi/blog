<?php
session_start();
// include("../_inc/db.php");
// $con = connect();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true){
    header("Location:./login.php");
    exit();
}
if(isset($_POST) && !empty($_POST)){
    include("../_inc/db.php");
    $con = connect();

    $error=false;
    if ($_FILES["poza"]["error"] > 0){
        echo "ERROR: " , $_FILES["poza"]["error"] , "<br>";
         $error=true;
    }else {
        echo "Incarcare: " . $_FILES["poza"]["name"] . "<br>";
        echo "Tip: " . $_FILES["poza"]["type"] . "<br>";
        echo "Dimensiune: " . ($_FILES["poza"]["size"] / 1024) . " kB<br>";
        echo "Temporar salvat in: " . $_FILES["poza"]["tmp_name"]. "<br>";;
    }

   echo "<BR>";
   if($_FILES["poza"]["type"]=="image/jpeg"){
       $ext=".jpg";
       $name=date("YmdHis");
   }else{
       $error = true;
   }
   if($error == false){
        $file_name=$name.$ext;
        move_uploaded_file($_FILES["poza"]["tmp_name"], "../public/images/" . $file_name);
        if(is_file("../public/images/".$_POST["poza_veche"])){
            unlink("../public/images/".$_POST["poza_veche"]);
            } 
   }else{
        $file_name = $_POST["poza_veche"];
   }
    $id = $_POST["id"];
    $id_articol = $_POST["id_articol"];
    $query1 = "UPDATE `galerie` SET 
    `galerie`.`titlu` = '".$_POST["titlu"]."',
    `galerie`.`poza` = '".$file_name."'
    WHERE `id` = '". $id."'";
    // echo $query1;
    queryactive($con, $query1);
    header("Location:./articole_editare.php?id=$id_articol");
    exit();

}
include("../_inc/db.php");
$con = connect();
$id = mysqli_real_escape_string($con, $_GET["id"]);
$query = "SELECT `galerie`.`id`, `galerie`.`id_articol`, `galerie`.`poza`, `galerie`.`titlu`, `galerie`.`status`
        FROM `galerie`
        WHERE `id`='".$id."'";
$rezultat = queryactive($con, $query);
$gallery = getRow($rezultat);
// $query1 = "UPDATE `galerie`
//             SET `galerie`.`titlu` =  "
include("./header.php");
?>
<div id="page-wrapper">
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Adaugare poze</h1>
        </div>
</div>        <!-- /.col-lg-12 -->
<div class = "row">
    <div class =" col-md-12">
    <form action="./galerie_editare.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titlu">Titlu</label>
            <input type="text" class="form-control" id="titlu"  name="titlu" value="<?php echo $gallery["titlu"]; ?>">
        </div>
        <div class="form-group">
            <img src="../public/images/<?php echo $gallery["poza"]; ?>">
        </div>
        <div class="form-group">
            <label for="poza">Poza</label>
            <input type="file" id="poza" name="poza">
            <input type = "hidden" name = "poza_veche" value = "<?php echo $gallery["poza"];?>">
        </div>
        <div class="form-group">
            <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]; ?>">
            <input type="hidden" id="id_articol" name="id_articol" value="<?php echo $_GET["id_articol"]; ?>">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        </form>

    </div>
 </div>
</div>
<?php
include("./footer.php");
?>