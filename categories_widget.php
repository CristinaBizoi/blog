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
      $sql= "SELECT `categorii`.`nume`, `categorii`.`id`
      FROM `categorii`
      WHERE `status`= '1'";
      $result = queryactive($con, $sql);
      $categories = getArray($result);

// exit();
?>


 <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12 coloane">

                  <ul class="list-unstyled mb-0">
                    <?php 
                    foreach ($categories as $key => $category){
                    ?>
                    <li>
                      <a href="index.php?categorie_id=<?php echo $category["id"]; ?>"><?php echo $category["nume"]; ?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>