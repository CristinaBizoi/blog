<?php
// echo date("Y-m-D")."<br/>";
// echo date("Y-m-d")."<br/>";
// echo date("y-m-d")."<br/>";
// echo date("Y-m-d H:i:s")."<br/>";
// $data_azi = date("Y-m-d");
// $timestamp = time();
// $timestamp_data = strtotime($data_azi);
// echo "Data azi:".$data_azi."<br/>";
// echo "timestamp :".$timestamp."<br/>";
// echo "timestamp_data:".$timestamp_data."<br/>";

// exit();
  include("./_inc/db.php");
  $con = connect();
      // $sql= "SELECT `categorii`.`nume`, `categorii`.`id`
      // FROM `categorii`
      // WHERE `status`= '1'";
      // $result = mysqli_query($con, $sql);
      // $categories = getArray($result);
      if(isset($_GET["categorie_id"]) && $_GET["categorie_id"]>0){
        //fac o variabila $termen unde curat ce primesc prin GET, variabila o trimit in query si o afisez la value la input
        $id_categorie = mysqli_real_escape_string($con, $_GET["categorie_id"]);
        $where = "`articole`.`id_categorie`= '".$id_categorie."'";
        
        /* cautare dupa un text
        = trebuie sa fie identic
        LIKE returneaza daca se potriveste intr-un camp
        LIKE => https://www.w3schools.com/sql/sql_like.asp

        */
    }else{
        //Daca nu gasesc un termen de cautat in where ca fi 1, adica caut tot si $termen va fi gol ca sa nu primesc erori (Notice:)
        $id_categorie = "";
        $where ="1";
    }
    
      $sql1= "SELECT `articole`.`id`, `articole`.`poza`, `articole`.`descriere`, `articole`.`nume`, `articole`.`data_adaugare`,
            `articole`.`status`
            FROM `articole`
            WHERE `status` = '1' AND ".$where." ORDER BY `data_adaugare` desc";
            // echo $sql1;
      $result1 = mysqli_query($con, $sql1);
      $articles = getArray($result1);
      $data_azi = date("Y-m-d H:i:s");
    
      $sql2= "SELECT `homepage_images`.`id`, `homepage_images`.`poza`, `homepage_images`.`titlu`
            FROM `homepage_images`
            WHERE (`homepage_images`.`data_start`<'".$data_azi."') AND ('".$data_azi."' < `homepage_images`.`data_end`)
            ORDER BY `homepage_images`.`data_start` DESC
            LIMIT 1";

      // echo $sql2;
      // exit();
      $result2 = mysqli_query($con, $sql2);
      $jumbotron = getRow($result2);
      $iesire = closedb ($con);

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./public/css/blog-home.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">

    

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
    <!-- Jumbotron -->
      <div class="jumbotron" style="background-image: url('./public/images/<?php echo $jumbotron["poza"]; ?>');">
        <h1> <?php echo $jumbotron["titlu"]; ?> </h1>
      </div>

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
          </h1>

          <!-- Blog Post -->
          <?php  
          foreach ($articles as $key => $article){
            if(is_file("./public/images/".$article["poza"]) && !empty($article["poza"])){
              $poza_articol = $article["poza"];
            }else{
              $poza_articol = "default.jpg";
            }
          ?>
          <div class="card mb-4">
            <img class="card-img-top" src="./public/images/<?php echo  $poza_articol;?>" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title"><?php echo $article["nume"]; ?></h2>
              <p class="card-text"><?php echo $article["descriere"]; ?></p>
              <a href="./articol.php?id=<?php echo $article["id"]; ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              <?php echo $article["data_adaugare"]; ?>
            </div>
          </div>
          <?php 
          }
          ?>
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul>

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
