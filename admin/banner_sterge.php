<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true){
    header("Location:./login.php");
    exit();
}
include("../_inc/db.php");
$con = connect();
$id_banner = mysqli_real_escape_string($con, $_GET["id"]);
$query = "DELETE FROM `homepage_images`
        WHERE `id`='".$id_banner."'";
queryactive($con, $query);
if(mysqli_affected_rows($con)>0){
    $mesaj = "Bannerul a fost sters";
    header("Location:./banner_listare.php?mesaj=$mesaj");
    exit();
}else{
    $mesaj = "Nu s-a schimbat nimic";
    header("Location:./banner_listare.php?mesaj=$mesaj");
    exit();
}
?>