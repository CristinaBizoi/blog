<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}

    include ("../_inc/db.php");
    $con = connect();
    $sql= "SELECT * FROM `categorii`
    WHERE 1 ORDER BY `data_adaugare` desc, `status` desc ";
    $result = mysqli_query($con, $sql);
    //var_dump($result);
    $categories=getArray($result);
     $iesire = closedb ($con);
    //  var_dump($categories);



include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categorii <small><a href="./categorii_adaugare.php"><i class = "fa fa-plus"></i></a></small></h1>
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
                                            <th>Nume</th>
                                            <th>Data adaugarii</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($categories as $key => $category){

                                    ?>
                                        <tr>
                                            <td><?php echo $category["id"]; ?></td>
                                            <td><?php echo $category["nume"]; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($category["data_adaugare"])); ?></td>
                                            <td><?php echo $category["status"]; ?></td>
                                            <td>
                                                <a href="./categorii_sterge.php?id=<?php echo $category["id"];?>"><i class="fa fa-trash"></i> </a>
                                                <a href="./categorii_editare.php?id=<?php echo $category["id"];?>"> <i class="fa fa-pencil"></i> </a>
                                                <?php
                                                 if($category["status"] == 1){
                                                     $class="fa fa-low-vision";
                                                 }else{
                                                     $class="fa fa-eye";
                                                 }
                                                ?>
                                                <a href="./categorii_activare.php?id=<?php echo $category["id"];?>"> <i class="<?php echo $class; ?>"></i> </a>
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