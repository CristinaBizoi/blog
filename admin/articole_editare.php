<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ini_set('post_max_size', '10M');
// ini_set('upload_max_filesize', '20M');
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
            var_dump($_FILES);
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
           $file_name=$name.$ext;
            move_uploaded_file($_FILES["poza"]["tmp_name"], "../public/images/" . $file_name);
            //stergem poza veche de pe server 
            if(is_file("../public/images/".$_POST["poza_veche"])){
                unlink("../public/images/".$_POST["poza_veche"]);
            }
       }
       else {
           $file_name = $_POST["poza_veche"];
       }

    //    echo $file_name;
        $query = "UPDATE `articole` SET
                `nume` = '".$_POST["nume"]."',
                `id_categorie` = '".$_POST["id_categorie"]."',
                `descriere` = '".$_POST["descriere"]."',
                `continut` = '".$_POST["continut"]."',
                `poza` = '".$file_name."'
                WHERE `id`='".$id."'";
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
    $query = "SELECT * FROM `articole` WHERE `id` ='".$id."'";
    $rezultat = mysqli_query($con, $query);
    $article=getRow($rezultat);

    //selectam pozele si titlurile pentru articolul respectiv => galerie
    $sql1= "SELECT  `galerie`.`titlu`, `galerie`.`poza`, `galerie`.`id`, `galerie`.`status`, `galerie`.`id_articol`
            FROM `galerie`
            LEFT JOIN `articole` ON `galerie`.`id_articol` = `articole`.`id` 
            WHERE `articole`.`id` = '".$_GET["id"]."'";
    echo $sql1;

    $result1 = queryactive($con, $sql1);
    var_dump($result1);
    $galerie = getArray($result1);
    var_dump($galerie);

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
            <div class =" col-md-6">
            <form action="./articole_editare.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nume">Nume</label>
                    <input type="text" class="form-control" id="nume"  name="nume" placeholder="nume" value="<?php echo $article["nume"]; ?>">
                </div>
                <div class="form-group">
                    <label for="id_categorie">Categorie</label>
                    <select name="id_categorie" id="id_categorie" class="form-control">
                    <option value="">Alege</option>
                    <?php 
                    foreach ($categories as $key => $category){
                        if($category["id"]==$article["id_categorie"]){
                            $checked = "selected";
                        }
                    else{
                        $checked = "";
                    }
                    ?>
                        <option value="<?php echo $category["id"]; ?>" <?php echo $checked ; ?>><?php echo $category["nume"]; ?></option>
                       <?php } ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="descriere">Descriere</label>
                    <input type="text" class="form-control" id="descriere"  name="descriere" placeholder="descrierea articolului" value="<?php echo $article["descriere"]; ?>">
                </div>
                <div class="form-group">
                    <label for="continut">Continut</label>
                    <textarea class="form-control" id="continut"  name="continut" ><?php echo $article["continut"]; ?></textarea>
                </div>
                <div class="form-group">
                <div class="">
                    <img class="img-listare" src="../public/images/<?php echo $article["poza"]; ?>">
                </div>
                <div class="form-group">
                    <label for="poza">Poza</label>
                    <input type="file" id="poza" name="poza">
                    <input type = "hidden" name = "poza_veche" value = "<?php echo $article["poza"];?>">
                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class =" col-md-6">
                <div class="form-group">
                    <label for="galerie">Adauga galerie</label>
                    <a href="galerie_adaugare.php?id=<?php echo $_GET["id"]; ?>"><i class="fa fa-plus-square"></i></a>
                </div>
              <table class="table">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Poza</th>
                        <th>Titlu</th>
                        <th>Status</th>
                        <th>Operatii</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      foreach ($galerie as $key => $picture){
                      ?>
                      <tr>
                          <td><?php echo $picture["id"]; ?></td>
                          <td><img src="../public/images/<?php echo $picture["poza"]; ?>" height="300px" width="300px"></td>
                          <td><?php echo $picture["titlu"]; ?></td>
                          <td><?php echo $picture["status"]; ?></td>
                          <td>
                            <a href="./galerie_sterge.php?id=<?php echo $picture["id"];?>&id_articol=<?php echo $picture["id_articol"];?>"><i class="fa fa-trash"></i> </a>
                            <a href="./galerie_editare.php?id=<?php echo $picture["id"];?>&id_articol=<?php echo $picture["id_articol"];?>"> <i class="fa fa-pencil"></i> </a>
                            <?php
                                if($picture["status"] == 1){
                                    $class="fa fa-low-vision";
                                }else{
                                    $class="fa fa-eye";
                                }
                            ?>
                            <a href="./galerie_activare.php?id=<?php echo $picture["id"];?>&id_articol=<?php echo $picture["id_articol"];?>"> <i class="<?php echo $class; ?>"></i> </a>
                            </td>
                      </tr>
                      <?php
                        }
                      ?>
                  </tbody>

                </table>
            
            </div>

            </div>
         </div>
    </div>

        <!-- /#page-wrapper -->

<?php 
include ("./footer.php");
?>