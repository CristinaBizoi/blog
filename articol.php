<?php
include("./_inc/db.php");
$con = connect();
$query = "SELECT `articole`.`nume`, `articole`.`poza`, `articole`.`continut`, `articole`.`data_adaugare`
        FROM `articole`
        WHERE `id`='".$_GET["id"]."'";
$result = queryactive($con, $query);
$articol = getRow($result);
$sql1= "SELECT  `galerie`.`titlu`, `galerie`.`poza`, `galerie`.`id`, `galerie`.`status`
FROM `galerie`
LEFT JOIN `articole` ON `galerie`.`id_articol` = `articole`.`id` 
WHERE `articole`.`id` = '".$_GET["id"]."'";
// echo $sql1;

$result1 = queryactive($con, $sql1);
// var_dump($result1);
$galerie = getArray($result1);
// var_dump($galerie);
// foreach($galerie as $key => $galery){
//   echo "Key = ".$key."<br/>";
// }
// exit();
$id_articol = $_GET["id"];
if(isset($_POST) && !empty($_POST)){
  $query1 = "INSERT INTO `comentarii` SET
         `comentarii`.`username`='".$_POST["username"]."',
         `comentarii`.`continut`='".$_POST["continut"]."',
         `comentarii`.`id_articol`='".$id_articol."'";
  queryactive($con, $query1);
}
$query2 = "SELECT `comentarii`.`username`, `comentarii`.`continut`, `comentarii`.`id_articol`, `comentarii`.`status`
          FROM `comentarii`
          WHERE `id_articol`='".$id_articol."'
          AND `comentarii`.`status` = '1'";
$rezultat = queryactive($con, $query2);
$comentarii = getArray($rezultat);
// var_dump($comentarii);
  include("./header.php"); 
?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4"><?php echo $articol["nume"]; ?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="#">Start Bootstrap</a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $articol["data_adaugare"]; ?> </p>

          <hr>

          <!-- Preview Image -->
          <?php
          if(is_file("./public/images/".$articol["poza"]) && !empty($articol["poza"])){
            $articol_poza = $articol["poza"];
          } else{
            $articol_poza = "default.jpg";
          }
          ?>
          <img class="img-fluid rounded" src="./public/images/<?php echo  $articol_poza; ?>" alt="">
      

          <hr>

          <!-- Post Content -->
         <p> <?php echo $articol["continut"]; ?> </p>
       
          <!-- Carousel -->
       
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
          <ol class="carousel-indicators">
          <?php 
          for( $i = 0; $i < count($galerie); $i++ ){
            if( $i == 0 ){
              $active = "active";
            }else{
              $active = "";
            }
          ?>
            <li data-target="#myCarousel" data-slide-to="0" class="<?php echo $active; ?>"></li>
          <?php  } ?>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <!-- <div class="item active">
              <img src="la.jpg" alt="Chania">
              <div class="carousel-caption">
                <h3>Los Angeles</h3>
                <p>LA is always so much fun!</p>
              </div>
            </div> --> 

    
            <?php foreach ($galerie as $key => $picture){
              if( $key == 0 ){
                $active = "active";
              }else{
                $active = "";
              }
              ?>
              <div class="item <?php echo $active; ?> ">
                <img src="./public/images/<?php echo $picture["poza"]; ?>" alt="Chicago">
                <div class="carousel-caption">
                  <h3><?php echo $picture["titlu"]; ?></h3>
                </div>
              </div>
            <?php } ?>
          
   
          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- end carusel -->


          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form action="./articol.php?id=<?php  echo $id_articol; ?>" method="post">
                <div class="form-group">
                  <label for="nume">Nume</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Introduce username">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="continut" id="continut" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>

          <!-- Single Comment -->
          <?php foreach($comentarii as $key => $comentariu){

          ?>
          <div class="media mb-4">
            <div class="media-body">
              <h5 class="mt-0"><?php echo $comentariu["username"]; ?></h5>
              <?php echo $comentariu["continut"]; ?>
            </div>
          </div>
          <?php
          }
          ?>

        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Categories Widget -->
          <?php
            include("./categories_widget.php");
          ?>

          <!-- Side Widget -->

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="./public/vendor/jquery/jquery.min.js"></script>
    <script src="./public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
