<?php 
session_start();
if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true ){
    header("Location:./login.php");
    exit();
}
include ("../_inc/db.php");
$con = connect();
    if(isset($_GET["name_articol"]) && strlen($_GET["name_articol"])>0){
        //fac o variabila $termen unde curat ce primesc prin GET, variabila o trimit in query si o afisez la value la input
        $termen = mysqli_real_escape_string($con, $_GET["name_articol"]);
        $where = "`articole`.`nume` LIKE '%".$termen."%'";
        
        /* cautare dupa un text
        = trebuie sa fie identic
        LIKE returneaza daca se potriveste intr-un camp
        LIKE => https://www.w3schools.com/sql/sql_like.asp

        */
    }else{
        //Daca nu gasesc un termen de cautat in where ca fi 1, adica caut tot si $termen va fi gol ca sa nu primesc erori (Notice:)
        $termen = "";
        $where ="1";
    }
    
    $sql= "SELECT `articole`.`id`, `articole`.`poza`, `articole`.`descriere`, `articole`.`nume`, `articole`.`data_adaugare`,
    `articole`.`status`, `categorii`.`nume` AS `categorie_nume`
    FROM `articole`
    LEFT JOIN `categorii` ON `articole`.`id_categorie` = `categorii`.`id`
    WHERE ".$where." ORDER BY `articole`.`data_adaugare` desc, `articole`.`status` desc, `articole`.`id` desc";
   // echo nl2br($sql);
    $result = mysqli_query($con, $sql);
    //var_dump($result);
    $articles=getArray($result);

  
    //  var_dump($articles);

    

include ("./header.php");


?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Articole <small><a href="./articole_adaugare.php"><i class = "fa fa-plus"></i></a></small></h1>

            </div>
        </div>        <!-- /.col-lg-12 -->
        <div class="row">
            <div class="col-md-12">
            <form class="form-inline" action="./articole_listare.php" method="get">
                <div class="form-group">
                    <label for="name">Name</label>

                    <input type="text" class="form-control" name="name_articol" id="name" placeholder="Artiocul meu" value="<?php echo $termen; ?>">
                </div>
                <button type="submit" class="btn btn-default">Cauta</button>
                </form>
            </div>
        </div>
        <div class = "row">
            <div class =" col-md-12">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Imagine</th>
                                            <th>Nume</th>
                                            <th>Descriere</th>
                                            <th>Numele categoriei</th>
                                            <th>Data adaugarii</th>
                                            <th>Status</th>
                                            <th>Gol</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($articles as $key => $article){

                                    ?>
                                        <tr>
                                            <td><?php echo $article["id"]; ?></td>
                                            <?php 
                                            $articol_poza = $article["poza"];
                                            // var_dump(fileExists('../public/images/$article["poza"]'));
                                            if(is_file("../public/images/$articol_poza") && !empty($article["poza"])){
                                                $poza_articol = $article["poza"];
                                            }else{
                                                $poza_articol = "default.jpg";
                                            } 
                                            ?>
                                            <td><img class="img-listare" src="../public/images/<?php echo $poza_articol; ?>"></td>
                                            <td><?php echo $article["nume"]; ?></td>
                                            <td><?php echo $article["descriere"]; ?></td>
                                            <td><?php echo $article["categorie_nume"]; ?></td>
                                            <td><?php echo $article["data_adaugare"]; ?></td>
                                            <td><?php echo $article["status"]; ?></td>
                                            <td>
                                                <a href="./articole_sterge.php?id=<?php echo $article["id"];?>"><i class="fa fa-trash"></i> </a>
                                                <a href="./articole_editare.php?id=<?php echo $article["id"];?>"> <i class="fa fa-pencil"></i> </a>
                                                <?php
                                                 if($article["status"] == 1){
                                                     $class="fa fa-low-vision";
                                                 }else{
                                                     $class="fa fa-eye";
                                                 }
                                                ?>
                                                <a href="./articole_activare.php?id=<?php echo $article["id"];?>"> <i class="<?php echo $class; ?>"></i> </a>
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