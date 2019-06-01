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
      // include("./_inc/db.php");
      $con = connect();
      $sql= "SELECT `categorii`.`nume`, `categorii`.`id`, count(`articole`.`id`) as `nr_articole`
      FROM `categorii`
      LEFT JOIN `articole` ON `categorii`.`id` = `articole`.`id_categorie`
      WHERE `categorii`.`status`= '1'
      GROUP BY `categorii`.`id`";
      $result = queryactive($con, $sql);
      $categories = getArray($result);

// exit();
?>


 <div class="categories-widget my-5">
            <h4 class="widget-title transform-uppercase text-josefin-style">Categories</h4>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">

                  <ul class="list-unstyled mb-0">
                    <?php 
                    foreach ($categories as $key => $category){
                    ?>
                    <li>
                      <a href="index.php?categorie_id=<?php echo $category["id"]; ?>" class="light-text d-flex w-100 justify-content-between"><?php echo $category["nume"]; ?> <span class="count"><?php echo $category["nr_articole"]; ?></span></a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>