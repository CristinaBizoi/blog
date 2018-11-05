<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]!= true){
    header("Location:./login.php");
    exit();
}
if(isset($_POST)&&!empty($_POST)){
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
   }else{
       $file_name= "ceva";
   }

    $id_articol = $_POST["id_articol"];
    $query = "INSERT INTO `galerie` SET
            `titlu` = '".$_POST["titlu"]."',
            `poza` = '".$file_name."',
            `id_articol` = '".$_POST["id_articol"]."'
            ";
    $rezultat = queryactive($con, $query);
    header("Location:./articole_editare.php?id=$id_articol");
    // var_dump($rezultat);
}

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
            <form action="./galerie_adaugare.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titlu">Titlu</label>
                    <input type="text" class="form-control" id="titlu"  name="titlu" placeholder="Titlupoza">
                </div>
                <div class="form-group">
                    <label for="poza">Poza</label>
                    <input type="file" id="poza" name="poza">
                </div>
                <div class="form-group">
                    <input type = "hidden" name = "id_articol" value = "<?php echo $_GET["id"];?>">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                </form>

            </div>
         </div>
    </div>






<?php 
include ("./footer.php");
?>