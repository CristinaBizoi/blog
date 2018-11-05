<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]!= true){
    header("Location:./login.php");
    exit();
}
include("../_inc/db.php");
$con = connect();
$query = " SELECT `articole`.`id`, `articole`.`status` 
        FROM `articole`
        WHERE `id`='".mysqli_real_escape_string($con, $_GET["id"])."'";
        // echo $query;
$result = queryactive($con, $query);
var_dump($result);
$rezultat = getRow($result);
var_dump($rezultat);
$status = $rezultat["status"];
if($status==1){
    $query1 = "UPDATE `articole` 
    SET `status` = '0'
    WHERE `id` ='".mysqli_real_escape_string($con,$_GET["id"])."'";
    echo $query1;
    queryactive($con, $query1);
        if(mysqli_affected_rows($con)>0){
            $mesaj = "Articolul a fost dezactivat";
        }
    header("Location:./articole_listare.php?mesaj=$mesaj");
    exit();
}elseif($status==0){
    $query2 = "UPDATE `articole` 
    SET `status` = '1'
    WHERE `id` ='".mysqli_real_escape_string($con,$_GET["id"])."'";
    echo $query2;
    queryactive($con, $query2);
        if(mysqli_affected_rows($con)>0){
            $mesaj = "Articolul a fost activat";
        }
    header("Location:./articole_listare.php?mesaj=$mesaj");
    exit();

}

?>