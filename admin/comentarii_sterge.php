<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
include ("../_inc/db.php");
$con = connect();
$query = "DELETE FROM `comentarii` 
          WHERE `id`='".mysqli_real_escape_string($con, $_GET["id"])."'";
echo $query;
$rezultat = queryactive($con, $query);
if(mysqli_affected_rows($con)>0){
    $mesaj = "Task-ul a fost sters";
}else{
    $mesaj = "A ramas la fel";
}
header("Location:./comentarii_listare.php?mesaj=$mesaj");
exit();
?>