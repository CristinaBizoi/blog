<?php
session_start();
if(!isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] != true){
    header("Location:./login.php");
}
include("../_inc/db.php");
$con = connect();
$query = "SELECT `galerie`.`id`, `galerie`.`status` 
        FROM `galerie`
        WHERE `galerie`.`id`='".$_GET["id"]."'";
$rezultat = queryactive($con, $query);
$gallery = getRow($rezultat);
$status = $gallery["status"];
echo $status;
$articol_id = $_GET["id_articol"];
if( $status == 1){
    $query1 = "UPDATE `galerie` SET 
            `galerie`.`status`='0' WHERE
            `galerie`.`id` = '".$_GET["id"]."'";
    queryactive($con, $query1);
    if(mysqli_affected_rows($con)>0){
        $mesaj = "S-a dezactivat imaginea";
        header("Location:./articole_editare.php?id=$articol_id&mesaj=$mesaj");
    }else{
        $mesaj = "A ramas la fel";
        header("Location:./articole_editare.php?id=$articol_id&mesaj=$mesaj");
    }
}elseif( $status == 0){
    $query2 = "UPDATE `galerie` SET 
            `galerie`.`status`='1' WHERE
            `galerie`.`id` = '".$_GET["id"]."'";
    echo $query2;
    queryactive($con, $query2);
    if(mysqli_affected_rows($con)>0){
        $mesaj = "S-a activat imaginea";
        header("Location:./articole_editare.php?id=$articol_id&mesaj=$mesaj");
    }else{
        $mesaj = "A ramas la fel";
        header("Location:./articole_editare.php?id=$articol_id&mesaj=$mesaj");
    }
}

?>