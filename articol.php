<?php
include("./_inc/db.php");
$con = connect();
$query = "SELECT `articole`.`nume`, `articole`.`poza`, `articole`.`descriere`, `articole`.`continut`, `articole`.`data_adaugare`
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
$meta_name = $articol["nume"];
$meta_description = $articol["descriere"];
$meta_image = $articol["poza"];
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
            <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>"></li>
          <?php  } ?>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <?php foreach ($galerie as $key => $picture){
              if( $key == 0 ){
                $active = "active";
              }else{
                $active = "";
              }
              ?>
              <div class="carousel-item <?php echo $active; ?> ">
                <img src="./public/images/<?php echo $picture["poza"]; ?>" class="d-block w-100" alt="Chicago">
                <div class="carousel-caption d-none d-md-block">
                  <h3><?php echo $picture["titlu"]; ?></h3>
                </div>
              </div>
            <?php } ?>
          
   
          </div>

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- end carusel -->


          <!-- Comments Form -->
          <div class="my-4">
            <div class="card-body">
              <form action="./articol.php?id=<?php  echo $id_articol; ?>" method="post" class="form-comments">
                <div class="comments-form-header">
                  <h5>Leave a Comment</h5>
                </div>
                <div class="form-group">
                  <input type="text" name="username" class="form-control" id="nume" placeholder="Name">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="continut" id="continut" placeholder="Comment" rows="5"></textarea>
                </div>
                <div class="d-flex">
                  <button type="submit" class="btn btn-custom mx-auto mt-3">Post Comment</button>
                </div>
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
    <script src="./public/js/bootstrap.min.js"></script>

  </body>

</html>
