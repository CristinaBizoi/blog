<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true){
    header("Location:./login.php"); 
    exit();   
}
include("../_inc/db.php");
$con = connect();
$id_poza = mysqli_real_escape_string($con, $_GET["id"]);
$id_articol = mysqli_real_escape_string($con, $_GET["id_articol"]);
$query = "DELETE FROM `galerie`
        WHERE `id`='".$id_poza."'";
echo $query;
queryactive($con, $query);
header("Location:./articole_editare.php?id=$id_articol");
exit();

?>