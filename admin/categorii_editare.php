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

if(isset($_POST)&&!empty($_POST)){
    include ("../_inc/db.php");
    $con = connect();
    $query = "UPDATE `categorii` SET 
    `nume`='".$_POST["nume"] . "'
    WHERE `id`='".$id."'
    ";
    $result = mysqli_query($con, $query);
     $iesire = closedb ($con);
     header("Location:./categorii_listare.php");
    exit();
}
include ("../_inc/db.php");
$con = connect();
$query1 = "SELECT * FROM `categorii`
        WHERE `id` = '".$id."'";
$result = mysqli_query($con, $query1);
// var_dump($result);

$category=getRow($result);
// var_dump($category);
include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editare categorie</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12">
            <form action="./categorii_editare.php?id=<?php echo $id ;?>" method="post">
                <div class="form-group">
                    <label for="nume">Nume</label>
                    <input type="text" class="form-control" id="nume"  name="nume" placeholder="categorie" value="<?php echo $category["nume"];?>">
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