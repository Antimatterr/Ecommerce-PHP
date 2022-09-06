<?php
require('./connection.inc.php');
require('./top.php');
require('./functions.inc.php');
$cat_id = mysqli_real_escape_string($con, $_GET['id']);
if($cat_id>0){
$cat_res = mysqli_query($con, "SELECT * FROM `categories` WHERE status = 1 ORDER BY categories ASC");
$cat_arr = array();
$cat_length = '';
while ($row = mysqli_fetch_assoc($cat_res)) {
  $cat_arr[] = $row;
}
}
else { ?>

<script>
window.location.href='index.php';
</script>

<?php }
?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <div class="left-sidebar">
          <h2>Category</h2>
          <?php
          foreach ($cat_arr as $list) {
          ?>
            <div class="panel-group category-products" id="accordian">
              <!--category-productsr-->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a href="categories.php?id=<?php echo $list['id']?>" data-parent="#accordian"> 
                      <?php 
                       echo $list['categories'] ?>
                    </a>
                  </h4>
                </div>
              </div>
            </div>

          <?php
          }
          ?>

          <!--/category-products-->

          <div class="brands_products">
            <!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
              </ul>
            </div>
          </div>
          <!--/brands_products-->



        </div>
      </div>

      <div class="col-sm-9 padding-right">
        <div class="features_items">
          <!--features_items-->
          <h2 class="title text-center">Items</h2>

          <?php
          $get_product = get_product($con ,6, $cat_id);
          if($get_product>0){
          foreach($get_product as $list){
          ?>
          <div class="col-sm-4">
            <div class="product-image-wrapper">
              <div class="single-products">
                <div class="productinfo text-center">
                  <a href="product.php?id=<?php echo $list['id']?>"><img src="./media/product/<?php echo $list['image'] ?>" alt="" /></a>
                  <h2>₹<?php echo $list['price'] ?></h2>
                  <p><?php echo $list['name']?></p>
                  <p><?php echo $list['short_desc']?></p>
                  <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
              </div>
              <div class="choose">
                <ul class="nav nav-pills nav-justified">
                  <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                  <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
              </div>
            </div>
          </div>
          <?php
          }
        }
        else{
          echo "nothing found";
        }
          ?>

      

        </div>

      </div>
    </div>
  </div>
</section>



<?php
require('./footer.php');
?>
