<?php
require('./connection.inc.php');
require('./top.php');
require('./functions.inc.php');
$product_id = mysqli_real_escape_string($con, $_GET['id']);
if ($product_id > 0) {
  $get_product = get_product($con, '', '', $product_id);
  $cat_res = mysqli_query($con, "SELECT * FROM `categories` WHERE status = 1 ORDER BY categories ASC");
  $cat_arr = array();
  $product_length = '';
  while ($row = mysqli_fetch_assoc($cat_res)) {
    $cat_arr[] = $row;
  }
} else { ?>
  <script>
    window.location.href = "index.php";
  </script>
<?php
}




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
                    <a data-parent="#accordian" href="categories.php?id=<?php echo $list['id'] ?>">
                      <span class="badge pull-right"></span>
                      <?php echo $list['categories'] ?>
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
            <h2></h2>
            <div class="brands-name">
              <!-- <ul class="nav nav-pills nav-stacked">
                <li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
                <li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                <li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
                <li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
                <li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
                <li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
                <li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
              </ul> -->
            </div>
          </div>
          <!--/brands_products-->



        </div>
      </div>

      <div class="col-sm-9 padding-right">

        <?php
        foreach ($get_product as $list) {
        ?>
          <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img src="./media/product/<?php echo $list['image'] ?>" alt="" />

              </div>

            </div>
            <div class="col-sm-7">
              <div class="product-information">
                <!--/product-information-->
                <img src="images/product-details/new.jpg" class="newarrival" alt="" />

                <form action="add_cart.php?action=add&id=<?php echo $list['id'] ?>" method="post">
                  <h2><?php echo $list['name'] ?></h2>
                  <p><?php echo $list['id'] ?></p>
                  <img src="images/product-details/rating.png" alt="" />
                  <span>
                    <span>₹<?php echo $list['price'] ?></span>
                    <?php if (isset($_SESSION['USER_LOGIN'])) {
                    ?>
                      <label>Quantity:</label>
                      <input type="text" name="qty">
                      <br>
                      <br>
                      <input type="submit" name="add_to_cart" value="Add to cart" style="font-size: 14px; width:85px; color:white; background-color:orange; border-radius:8px;">
                      <i class="fa fa-shopping-cart"></i>

                    <?php } ?>  
                </form>


                </span>
                <?php if ($list['status'] == 1 && $list['qty'] > 15) { ?>
                  <p style="color: green;"><b>Availability:</b> In Stock</p>
                <?php } else if ($list['status'] == 1 && $list['qty'] <= 15) {
                ?>
                  <p style="color: rgb(255, 61, 41);"><b>Availability:</b>Few left!</p>
                <?php } else {
                ?>
                  <p style="color:red;"><b>Availability:</b>Few left!
                  <p>
                  <?php } ?>
                  <h2>Description:</h2>
                  <div class="tab-content">
                    <div class="tab-pane fade active in" id="reviews">
                      <div class="col-sm-12">
                        <p><?php echo $list['description'] ?></b></p>

                      <?php
                    }
                      ?>
                      </div>
                    </div>

                  </div>

              </div>
              <!--/product-information-->
            </div>
          </div>
          <!--/product-details-->
      </div>
    </div>
  </div>
  </div>
</section>



<?php
require('./footer.php');
?>