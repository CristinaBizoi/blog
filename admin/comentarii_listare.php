<?php
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"]!= true){
    header("Location:./login.php");
    exit();
}
include("../_inc/db.php");
$con = connect();

$query = "SELECT `comentarii`.`id`, `comentarii`.`username`, `comentarii`.`continut`, `comentarii`.`status`, `comentarii`.`id_articol`
        FROM `comentarii`
        WHERE 1";
// echo $query;
$result = queryactive($con, $query);
$comentarii = getArray($result);



include ("./header.php");

?>

   <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-4">
                    <h1 class="page-header">Comentarii</h1>
                </div>
        </div>        <!-- /.col-lg-12 -->
        <div class = "row">
            <div class =" col-md-12">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Continut</th>
                                            <th>Id_Articol</th>
                                            <th>Status</th>
                                            <th>Operatii</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($comentarii as $key => $comentariu){

                                    ?>
                                        <tr>
                                            <td><?php echo $comentariu["id"]; ?></td>
                                            <td><?php echo $comentariu["username"]; ?></td>
                                            <td><?php echo $comentariu["continut"]; ?></td>
                                            <td><?php echo $comentariu["id_articol"]; ?></td>
                                            <td><?php echo $comentariu["status"]; ?></td>
                                            <td>
                                                <a href="./comentarii_sterge.php?id=<?php echo $comentariu["id"];?>"><i class="fa fa-trash"></i> </a>
                                                <?php
                                                 if($comentariu["status"] == 1){
                                                     $class="fa fa-low-vision";
                                                 }else{
                                                     $class="fa fa-eye";
                                                 }
                                                ?>
                                                <a href="./comentarii_activare.php?id=<?php echo $comentariu["id"];?>"> <i class="<?php echo $class; ?>"></i> </a>
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