<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true){
    header("Location:./login");
    exit();
}

include("../_inc/db.php");
$con = connect();
if(isset($_GET["banner_interval_inceput"]) && isset($_GET["banner_interval_final"]) && !empty($_GET["banner_interval_inceput"]) && !empty($_GET["banner_interval_final"])){
    $data_inceput = mysqli_real_escape_string($con, $_GET["banner_interval_inceput"]);
    $data_final = mysqli_real_escape_string($con, $_GET["banner_interval_final"]);
    if(strtotime($data_inceput) < strtotime($data_final)){
        $where = "(`homepage_images`.`data_start`>'".$data_inceput."') AND ('".$data_final."' > `homepage_images`.`data_end`)";
    }
    else{
        $where ="1";
    }
}else{

        //Daca nu gasesc un termen de cautat in where ca fi 1, adica caut tot si $termen va fi gol ca sa nu primesc erori (Notice:)

        $where ="1";
}
$query = "SELECT `homepage_images`.`id`, `homepage_images`.`poza`, `homepage_images`.`data_start`, `homepage_images`.`data_end`,
        `homepage_images`.`titlu`, `homepage_images`.`status`
        FROM `homepage_images`
        WHERE ".$where;
// echo $query;
$result = queryactive($con, $query);
$banere = getArray($result);



include("./header.php");

?>

 <div id="page-wrapper">
    <div class = "row">
            <div class =" col-md-12">
            <h1 class="page-header">Bannere <small><a href="./adaugare_banner.php"><i class = "fa fa-plus"></i></a></small></h1>
            <div class="row">
                <div class="col-md-12 pt-3">
                    <form class="form-inline" action="./banner_listare.php" method="get">
                        <div class="form-group ">
                            <label for="name">Cautare:</label>
                            <input type="date" class="form-control" name="banner_interval_inceput" id="banner_interval_inceput" value="<?php echo $termen_start; ?>">
                            <input type="date" class="form-control" name="banner_interval_final" id="banner_interval_final" value="<?php echo $termen_finish; ?>">
                        </div>
                        <button type="submit" class="btn btn-default">Cauta</button>
                    </form>
                </div>
            </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Poza</th>
                                            <th>Titlu</th>
                                            <th>Data start</th>
                                            <th>Data finish</th>
                                            <th>Status</th>
                                            <th>Operatii</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($banere as $key => $baner){

                                    ?>
                                        <tr>
                                            <td><?php echo $baner["id"]; ?></td>
                                            <td><img src="../public/images/<?php echo $baner["poza"]; ?>" height="50px" width="50px"></td>
                                            <td><?php echo $baner["titlu"]; ?></td>
                                            <td><?php echo $baner["data_start"]; ?></td>
                                            <td><?php echo $baner["data_end"]; ?></td>
                                            <td><?php echo $baner["status"]; ?></td>
                                            <td>
                                                <a href="./banner_sterge.php?id=<?php echo $baner["id"];?>"><i class="fa fa-trash"></i> </a>
                                                <a href="./banner_editare.php?id=<?php echo $baner["id"];?>"> <i class="fa fa-pencil"></i> </a>
                                                <?php
                                                 if($baner["status"] == 1){
                                                     $class="fa fa-low-vision";
                                                 }else{
                                                     $class="fa fa-eye";
                                                 }
                                                ?>
                                                <a href="./banner_activare.php?id=<?php echo $baner["id"];?>"> <i class="<?php echo $class; ?>"></i> </a>
                                            </td>
                    
                                        </tr>
                                    <?php } ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

            </div>
         </div>
    </div>




<?php 

include ("./footer.php");
?>