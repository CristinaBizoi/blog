<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]!= true){
    header("Location:./login.php");
    exit();
}
if(isset($_GET["id"]) && $_GET["id"] > 0 ){
    $id_banner = $_GET["id"];
}else{
    exit();
}
if(isset($_POST)&&!empty($_POST)){
    include ("../_inc/db.php");
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
        $file_name = $_POST["poza_veche"];;
   }
   
    $id = mysqli_real_escape_string($con, $_GET["id"]);
    $query = "UPDATE `homepage_images` SET
    `poza` = '".$file_name."',
    `data_start` = '".$_POST["data_start"]."',
    `data_end` = '".$_POST["data_end"]."',
    `titlu` = '".$_POST["titlu"]."'
    WHERE `id`='".$id."'";
    $result = queryactive($con, $query);
    header("Location:./banner_editare.php?id=$id");
    exit();
     $iesire = closedb ($con);
}
include("../_inc/db.php");
$con = connect();
$query1 = "SELECT * FROM `homepage_images`
        WHERE `id`='".mysqli_real_escape_string($con, $_GET["id"])."'";
$rezultat = queryactive($con, $query1);
$baner = getRow($rezultat);
$iesire = closedb ($con);

include ("./header.php");

?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editare banner</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12">
            <form action="./banner_editare.php?id=<?php echo $baner["id"];?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titlu">Titlu</label>
                    <input type="text" class="form-control" id="titlu"  name="titlu" value="<?php echo $baner["titlu"]; ?>">
                </div>
                <div class="form-group">
                <div class="">
                    <img class="img-listare" src="../public/images/<?php echo $baner["poza"]; ?>">
                </div>
                <div class="form-group">
                    <label for="poza">Poza</label>
                    <input type="file" id="poza" name="poza">
                    <input type = "hidden" name = "poza_veche" value = "<?php echo $baner["poza"];?>">
                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="form-group">
                    <label for="data_start">Start date</label>
                    <input type="date" name="data_start" id="data_start" value="<?php echo date("Y-m-d", strtotime($baner["data_start"])); ?>">
                </div>
                <div class="form-group">
                    <label for="data_end">End date</label>
                    <input type="date" name="data_end" id="data_end" value="<?php echo date("Y-m-d", strtotime($baner["data_end"])); ?>">
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