<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
    include ("../_inc/db.php");
    $con = connect();
    $sql= "SELECT * FROM `utilizatori`
    WHERE 1 ORDER BY `data_adaugare` desc, `status` desc ";
    $result = mysqli_query($con, $sql);
    //var_dump($result);
    $users=getArray($result);
     $iesire = closedb ($con);
    //  var_dump($users);



include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-4">
                    <h1 class="page-header">Categorie</h1>
                </div>
                <div class="col-lg-8">
                    <a href="./utilizatori_adaugare.php">Adaugare</a>
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
                                            <th>email</th>
                                            <th>Data adaugarii</th>
                                            <th>Status</th>
                                            <th>Gol</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($users as $key => $user){

                                    ?>
                                        <tr>
                                            <td><?php echo $user["id"]; ?></td>
                                            <td><?php echo $user["username"]; ?></td>
                                            <td><?php echo $user["email"]; ?></td>
                                            <td><?php echo $user["data_adaugare"]; ?></td>
                                            <td><?php echo $user["status"]; ?></td>
                                            <td>
                                                <a href="./utilizatori_sterge.php?id=<?php echo $user["id"];?>"><i class="fa fa-trash"></i> </a>
                                                <a href="./utilizatori_editare.php?id=<?php echo $user["id"];?>"> <i class="fa fa-pencil"></i> </a>
                                                <?php
                                                 if($user["status"] == 1){
                                                     $class="fa fa-low-vision";
                                                 }else{
                                                     $class="fa fa-eye";
                                                 }
                                                ?>
                                                <a href="./utilizatori_activare.php?id=<?php echo $user["id"];?>"> <i class="<?php echo $class; ?>"></i> </a>
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

        <!-- /#page-wrapper -->

<?php 
include ("./footer.php");
?>