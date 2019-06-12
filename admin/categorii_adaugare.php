<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
if(isset($_POST)&&!empty($_POST)){
    include ("../_inc/db.php");
    $con = connect();
    $query = "INSERT INTO `categorii` SET
    `nume` = '".$_POST["nume"]."'";
    $result = mysqli_query($con, $query);
    header("Location:./categorii_listare.php");
    exit();
     $iesire = closedb ($con);

}

include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Adaugare categorie</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12">
            <form action="./categorii_adaugare.php" method="post">
                <div class="form-group">
                    <label for="nume">Nume</label>
                    <input type="text" class="form-control" id="nume"  name="nume" placeholder="Nume categorie">
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