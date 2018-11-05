<?php
//includ fisierul pt a face disponibile variabilele
if(is_file("./config/db_config.php")){
    include("./config/db_config.php");
}elseif(is_file("../config/db_config.php")){
    include("../config/db_config.php");
}else{
    echo "Datele de logare nu au fost gasite";
}


// include("./config/db_config.php");
function connect(){
    //variabilele globale sunt declarate in fisierul db.config
   global $servername,$username, $password, $db;
    $con=mysqli_connect($servername, $username, $password, $db);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    else{
        // echo "Conexiune reusita";
    }
    return $con;
}
function closedb($con){
    mysqli_close($con);
 }
 // scoatem o lista de randuri din baza de date
 function getArray($result){
     $re = array();
     if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $re[]=$row;
            
        }
    } else {
        // echo "0 results";
    }
    return $re;
 }
 //returneaza un singur rand util cand populam un formular de editare
 function getRow($result){
    $re = array();
    if (mysqli_num_rows($result) > 0) {
       // output data of each row
       while($row = mysqli_fetch_assoc($result)) {
           $re=$row;
          break; 
       }
   } else {
       // echo "0 results";
   }
   return $re;
}
function queryactive($con, $query){
    $result = mysqli_query($con, $query);
    return $result;
}
function fileExists($filePath)
{
      return is_file($filePath) && file_exists($filePath);
}
?>