<?php
session_start();
if(!isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] != true){
    header("Location:./login.php");
    exit();
}
include("../_inc/db.php");
$con = connect();
$id = mysqli_real_escape_string($con, $_GET["id"]);
$query = "SELECT `homepage_images`.`id`, `homepage_images`.`status`
        FROM `homepage_images`
        WHERE `id`='".$id."'";
echo $query;
$rezultat = queryactive($con, $query);
$baner = getRow($rezultat);
$status = $baner["status"];
if($status == 1){
    $status = 0;
    $query1 = "UPDATE `homepage_images`
            SET `homepage_images`.`status`='".$status."'
            WHERE `id`='".$id."'"; 
    $rezultat1 = queryactive($con, $query1);
    if(mysqli_affected_rows($con) > 0){
        $mesaj = "Bannerul s-a dezactivat";
        header("Location:./banner_listare.php?mesaj=$mesaj");
        exit();
    }

}elseif($status == 0){
    $status = 1;
    $query2 = "UPDATE `homepage_images`
            SET `homepage_images`.`status`='".$status."'
            WHERE `id`='".$id."'"; 
    $rezultat2 = queryactive($con, $query2);
    if(mysqli_affected_rows($con) > 0){
        $mesaj = "Bannerul s-a activat";
        header("Location:./banner_listare.php?mesaj=$mesaj");
        exit();
    }
}



?>