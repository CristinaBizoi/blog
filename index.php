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
      //paginare
      if(!isset($_GET['page'])){
        $page = 1;
      }else{
        $page = $_GET['page'];
      }

      $results_per_page = 2;
      $page_first_results = ($page - 1)*$results_per_page;

    //selecteaza articolele
      $sql1= "SELECT `articole`.`id`, `articole`.`id_categorie`, `articole`.`id_admin`, `articole`.`poza`, `articole`.`descriere`, `articole`.`nume`, `articole`.`data_adaugare`,
            `articole`.`status`, `categorii`.`id` as `id_categorie`, `categorii`.`nume` as `nume_categorie`, `utilizatori`.`id` as `id_utilizator`, `utilizatori`.`username` as `nume_utilizator`
            FROM `articole`
            LEFT JOIN `categorii` ON `articole`.`id_categorie` = `categorii`.`id`
            LEFT JOIN `utilizatori` ON `articole`.`id_admin` = `utilizatori`.`id`
            WHERE `articole`.`status` = '1' AND ".$where."
             ORDER BY `data_adaugare` desc
             LIMIT ".$page_first_results.", ".$results_per_page."";
            
            // echo $sql1;
            // exit();
      $result1 = mysqli_query($con, $sql1);
      $articles = getArray($result1);
      $number_of_results =  mysqli_num_rows($result1);
      
      $number_of_pages = ceil( $number_of_results / $results_per_page);
       // jumbotron
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
      <div class="jumbotron d-flex justify-content-center align-items-center" style="background-image: url('./public/images/<?php echo $jumbotron["poza"]; ?>');">
        <div class="jumbotron-description text-center">
          <h1> <?php echo $jumbotron["titlu"]; ?> </h1>
        </div>
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
              <img class="image-description hover " src="./public/images/<?php echo  $poza_articol;?>" alt="Card image cap">
            </div>
            <div class="entry-text">
              <div class="publish-date transform-uppercase">
                <?php echo date("d M Y", strtotime($article["data_adaugare"])); ?>
              </div>
              <div class="entry-author">
                <i class="fas fa-user"></i>
                <div class="author-username transform-uppercase">
                  <?php echo $article["nume_utilizator"]; ?> 
                </div>
              </div>
              <div class="entry-name ">
                <a href="./articol.php?id=<?php echo $article["id"]; ?>"><h2 class="title-text"><?php echo $article["nume"]; ?></h2></a>
              </div>
              <div class="entry-meta">
                <a href="./articol.php?id=<?php echo $article["id"]; ?>#comment-section" class="meta-option light-text"><i class="far fa-comment"></i> Comments </a>
                <a href="./index.php?categorie_id=<?php echo $article["id_categorie"]; ?>" class="meta-option light-text"><i class="far fa-bookmark"></i> <?php echo $article["nume_categorie"]; ?></a>
              </div>
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
            <?php
              for($page=1; $page<= $number_of_pages; $page++){
                echo '<a href="./index.php?page='.$page.'">'.$page.'</a>';
              }

            ?>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="search-form mb-5">
            <form class="form-inline md-form form-sm">
              <input class="form-control search-articol form-control-sm w-100" type="text" placeholder="Search..." aria-label="Search">
              <span class="search-icon"><i class="fas fa-search light-text" aria-hidden="true"></i></span>
            </form>
          </div>
          <!-- about me -->
            <div class="about-widget">
              <h4 class="widget-title transform-uppercase"> About me </h4>
              <div id="widget-aboutme-image" class="mx-auto my-4"> </div>
              <div class="widget-aboutme-description text-center px-3">
                <p>  Ut dui mi, cursus id hendrerit non, laoreet sit amet arcu. Phasellus eu sem at elit ultrices venenatis. Mauris eget mi vel eros tempus varius vel vel libero.</p>
              </div>
            </div>
  
          <!-- categories widget -->
          <?php
            include("./categories_widget.php");
          ?>
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
