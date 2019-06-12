
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php 
    if(isset($meta_name) && !empty($meta_name)){  ?>
       <meta name="og:title" content="<?php echo $meta_name; ?>"> 
       <?php 
    }
    ?>
    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="./public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,600|Raleway:400,600,700" rel="stylesheet">
    <link href="./public/css/blog-home.css" rel="stylesheet">
    <link href="./public/css/style.css" rel="stylesheet">
    
    

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg ">
      <div class="container">
        <a class="navbar-brand" id="nav-title" href="./">Personal Blog </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
      