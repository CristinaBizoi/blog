<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true){
    header("Location:./login.php");
    exit();
}
include("../_inc/db.php");
$con = connect();
$query = "SELECT `utilizatori`.`id`, `utilizatori`.`status` 
        FROM `utilizatori`
        WHERE `id` = '".mysqli_real_escape_string($con, $_GET["id"])."'";
$result = queryactive($con, $query);
$rezultat = getRow($result);
$status = $rezultat["status"];
if($status==1){
    $query1 = "UPDATE `utilizatori`
                SET `status` = '0'
                WHERE `id` = '".mysqli_real_escape_string($con, $_GET["id"])."'";
    queryactive($con, $query1);
    if(mysqli_affected_rows($con)>0){
        $mesaj = "Utilizatorul a fost dezactivat";
        header("Location:./utilizatori_listare.php?mesaj=$mesaj");
        exit();
    }
}
if($status==0){
    $query2 = "UPDATE `utilizatori`
                SET `status` = '1'
                WHERE `id` = '".mysqli_real_escape_string($con, $_GET["id"])."'";
    queryactive($con, $query2);
    if(mysqli_affected_rows($con)>0){
        $mesaj = "Utilizatorul a fost activat";
        header("Location:./utilizatori_listare.php?mesaj=$mesaj");
        exit();
    }
}
?>