<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]!= true){
    header("Location:./login.php");
}
include("../_inc/db.php");
$con = connect();
$query = " SELECT `categorii`.`id`, `categorii`.`status`
        FROM `categorii` 
        WHERE `id`='".mysqli_real_escape_string($con, $_GET["id"])."'";
$rezultat = queryactive($con, $query);
$result = getRow($rezultat);
$status = $result["status"];
if($status==0){
    $query1 = "UPDATE `categorii`
            SET `categorii`.`status` = '1'
            WHERE `id` = '".mysqli_real_escape_string($con, $_GET["id"])."'";
    queryactive($con, $query1);
    if(mysqli_affected_rows($con)>0){
        $mesaj = " categoria a fost activata";
        header("Location:./categorii_listare.php?mesaj=$mesaj");
        exit();
    }
}elseif($status==1){
    $query2 = "UPDATE `categorii`
            SET `categorii`.`status` = '0'
            WHERE `id` ='".mysqli_real_escape_string($con, $_GET["id"])."'";
    queryactive($con, $query2);
    if(mysqli_affected_rows($con)>0){
        $mesaj = " categoria a fost dezactivata";
        header("Location:./categorii_listare.php?mesaj=$mesaj");
        exit();
    }
                
}


?>