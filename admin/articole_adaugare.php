<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
if(isset($_POST)&&!empty($_POST)){
    // var_dump($_POST); exit();
    include ("../_inc/db.php");
    $con = connect();
		/*
			Acum trebuie sa verific daca nu sunt erori, erorile unui fisier (daca nu a putut fi uloadata)

        */
        // var_dump($_FILES);
        // exit();
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
            $file_name= "";
        }
    //    echo $file_name;
        $query = "INSERT INTO `articole` SET
                `nume` = '".$_POST["nume"]."',
                `id_categorie` = '".$_POST["id_categorie"]."',
                `descriere` = '".$_POST["descriere"]."',
                `continut` = '".$_POST["continut"]."',
                `poza` = '".$file_name."'
                ";
                // echo nl2br($query) ;
                // exit();
         $result = mysqli_query($con, $query);
       $iesire = closedb ($con);
       header("Location:./articole_listare.php");
       exit();
    }
//selectam categoriile din db pt a le afisa in select
    include ("../_inc/db.php");
    $con = connect();
    $sql= "SELECT * FROM `categorii`
    WHERE 1 ORDER BY `data_adaugare` desc, `status` desc ";
    $result = mysqli_query($con, $sql);
    //var_dump($result);
    $categories=getArray($result);
     $iesire = closedb ($con);
include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adaugare articole</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12">
            <form action="./articole_adaugare.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nume">Nume</label>
                    <input type="text" class="form-control" id="nume"  name="nume" placeholder="Nume">
                </div>
                <div class="form-group">
                    <label for="id_categorie">Categorie</label>
                    <select name="id_categorie" id="id_categorie" class="form-control">
                    <?php 
                    foreach ($categories as $key => $category){
                    ?>
                        <option value="<?php echo $category["id"]; ?>"><?php echo $category["nume"]; ?></option>
                       <?php } ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="descriere">Descriere</label>
                    <input type="text" class="form-control" id="descriere"  name="descriere" placeholder="Descrierea articolului">
                </div>
                <div class="form-group">
                    <label for="continut">Continut</label>
                    <textarea class="form-control" id="continut"  name="continut"></textarea>
                </div>
                <div class="form-group">
                    <label for="poza">Poza</label>
                    <input type="file" id="poza" name="poza">
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