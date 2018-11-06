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
    
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./public/css/blog-home.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>

  <body>



  
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

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

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <?php
            include("./categories_widget.php");
          ?>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>

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
