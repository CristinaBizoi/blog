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
    
      $sql1= "SELECT `articole`.`id`, `articole`.`id_categorie`, `articole`.`id_admin`, `articole`.`poza`, `articole`.`descriere`, `articole`.`nume`, `articole`.`data_adaugare`,
            `articole`.`status`, `categorii`.`id` as `id_categorie`, `categorii`.`nume` as `nume_categorie`, `utilizatori`.`id` as `id_utilizator`, `utilizatori`.`username` as `nume_utilizator`
            FROM `articole`
            LEFT JOIN `categorii` ON `articole`.`id_categorie` = `categorii`.`id`
            LEFT JOIN `utilizatori` ON `articole`.`id_admin` = `utilizatori`.`id`
            WHERE `articole`.`status` = '1' AND ".$where." ORDER BY `data_adaugare` desc";

            // echo $sql1;
      $result1 = mysqli_query($con, $sql1);
      $articles = getArray($result1);
      $data_azi = date("Y-m-d H:i:s");
    
      $sql2= "SELECT `homepage_images`.`id`, `homepage_images`.`poza`, `homepage_images`.`titlu`
            FROM `homepage_images`
            WHERE (`homepage_images`.`data_start`<'".$data_azi."') AND ('".$data_azi."' < `homepage_images`.`data_end`) AND `homepage_images`.`status`= '1'
            ORDER BY `homepage_images`.`data_start` DESC
            LIMIT 1";

      // echo $sql2;
      // exit();
      $result2 = mysqli_query($con, $sql2);
      $jumbotron = getRow($result2);
      $iesire = closedb ($con);
      include("./header.php");
?>


    <!-- Page Content -->
    <div class="container">
    <!-- Jumbotron -->
    <?php
    if(!empty($jumbotron)){
      
    ?>
      <div class="jumbotron" style="background-image: url('./public/images/<?php echo $jumbotron["poza"]; ?>');">
        <h1> <?php echo $jumbotron["titlu"]; ?> </h1>
      </div>
      <?php
    }
      ?>
      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


          <!-- Blog Post -->
          <?php  
          foreach ($articles as $key => $article){
            if(is_file("./public/images/".$article["poza"]) && !empty($article["poza"])){
              $poza_articol = $article["poza"];
            }else{
              $poza_articol = "default.jpg";
            }
          ?>
          <article class="article-description">
            <div class="image-media">
              <img class="image-description" src="./public/images/<?php echo  $poza_articol;?>" alt="Card image cap">
            </div>
            <div class="entry-text">
              <div class="publish-date">
                <?php echo date("d M Y", strtotime($article["data_adaugare"])); ?>
              </div>
              <div class="entry-author">
                <i class="fas fa-user"></i>
                <div class="author-username">
                  <?php echo $article["nume_utilizator"]; ?> 
                </div>
              </div>
              <div class="entry-name">
                <h2><?php echo $article["nume"]; ?></h2>
              </div>
              <div class="entry-meta">
                <a href="" class="meta-option light-text"><i class="far fa-comment"></i> Comments </a>
                <a href="" class="meta-option light-text"><i class="far fa-bookmark"></i> <?php echo $article["nume_categorie"]; ?></a>
              <div class="entry-summary">
                <p><?php echo $article["descriere"]; ?></p>
              </div>
              <div class="more-btn">
                <a href="./articol.php?id=<?php echo $article["id"]; ?>" class="btn btn-custom mx-auto">Read More</a>
              </div>
            </div>
          </article>
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
          <div class="search-form">
            <form class="form-inline md-form form-sm">
              <input class="form-control search-articol form-control-sm mr-3 w-75" type="text" placeholder="Search..." aria-label="Search">
              <i class="fas fa-search" aria-hidden="true"></i>
            </form>
          </div>
        
          <?php
            include("./categories_widget.php");
          ?>
          <!-- about me -->
          <div class="about-widget">
            <h4 class="widget-title"> About me </h4>
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
