<?php
require('./top.inc.php');
$categories_id = '';
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_desc = '';
$description =  '';
$meta_title = '';
$meta_desc = '';
$meta_keyword = '';
$status = '';
$msg = '';
$image_required = 'required';

if(isset($_GET['id']) && $_GET['id'] != ''){
  $image_required = '';
  $id = get_safe_value($con, $_GET['id']);
  $sql = "SELECT * FROM product WHERE id = '$id' ";
  $res = mysqli_query($con, $sql);
  $check = mysqli_num_rows($res);
  
  //to restrict invalid id in links.
  if($check>0)
  {
  $row = mysqli_fetch_assoc($res);
  $categories_id = $row['categories_id'];
  $name = $row['name'];
  $mrp = $row['mrp'];
  $price = $row['price'];
  $qty = $row['qty'];
  $short_desc = $row['short_desc'];
  $description = $row['description'];
  $meta_title = $row['meta_title'];
  $meta_desc = $row['meta_desc'];
  $meta_keyword = $row['meta_keyword'];
  
  }else {
    header('location:product.php');
    die(); 
  }

}

if(isset($_POST['submit'])){
  $categories_id = get_safe_value($con, $_POST['categories_id']);
  $name = get_safe_value($con, $_POST['name']);
  $mrp = get_safe_value($con, $_POST['mrp']);
  $price = get_safe_value($con, $_POST['price']);
  $qty = get_safe_value($con, $_POST['qty']);
  $short_desc = get_safe_value($con, $_POST['short_desc']);
  $description = get_safe_value($con, $_POST['description']);
  $meta_title = get_safe_value($con, $_POST['meta_title']);
  $meta_desc = get_safe_value($con, $_POST['meta_desc']);
  $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

  $res = mysqli_query($con, "SELECT * FROM product WHERE name='$name'");
  $check = mysqli_num_rows($res);
  if($check > 0){
    if(isset($_GET['id']) && $_GET['id'] != ''){
      $getData = mysqli_fetch_assoc($res);
      if($id = $getData['id']){

      }
      else{
        $msg = 'Product already exists!';
      }
    }
    else{
      $msg = 'Product already exists!';
    }
  }

  // if($_FILES['image']['type'] != '' && ($_FILES['image']['type'] != 'image/png' || $_FILES['image']['type'] != 'image/JPG' || $_FILES['image']['type'] != 'image/jpeg')){
  //   $msg = 'Only png, jpeg and jpg format files are allowed!';
  // }
   

  if($msg == ''){
    if(isset($_GET['id']) && $_GET['id'] != '')
    {
      if($_FILES['image']['name'] != ''){
        $image = rand(1111111,9999999).'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/'.$image);

        $update_sql = "UPDATE `product` SET `categories_id`='$categories_id', `name`='$name', `mrp`='$mrp', `price`='$price', `qty`='$qty', `short_desc`='$short_desc', `description`='$description', `meta_title`='$meta_title', `meta_desc`='$meta_desc', `meta_keyword`='$meta_keyword', `image`='$image' WHERE `id` = '$id'";
      }
      else{
        $update_sql = "UPDATE `product` SET `categories_id`='$categories_id', `name`='$name', `mrp`='$mrp', `price`='$price', `qty`='$qty', `short_desc`='$short_desc', `description`='$description', `meta_title`='$meta_title', `meta_desc`='$meta_desc', `meta_keyword`='$meta_keyword' WHERE `id` = '$id'";
      }
     mysqli_query($con , $update_sql);
    }
    else{
      $image = rand(1111111,9999999).'_'.$_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/'.$image);

    $sql = "INSERT INTO product(categories_id, name, mrp, price, qty, short_desc, description, meta_title, meta_desc, meta_keyword, status, image) VALUES('$categories_id','$name', '$mrp', '$price', '$qty', '$short_desc', '$description', '$meta_title', '$meta_desc', '$meta_keyword', '1', '$image')";

    mysqli_query($con, $sql);
    }
    header('location:product.php');
    die();
  }

}






?>
<div class="content pb-0">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header"><strong>Product</strong><small> Form</small></div>

<form method="post" enctype="multipart/form-data">
          <div class="card-body card-block">
            <!-- for category -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">Categories</label>

                <select class="form-control" name="categories_id">
                  <option>Select Category</option>
                  <?php 

                  $res = mysqli_query($con, "SELECT id, categories FROM categories ORDER BY categories ASC");
                  while($row = mysqli_fetch_assoc($res)){
                    if($row['id'] == $categories_id){
                      echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                    }
                    else{
                      echo "<option value=".$row['id'].">".$row['categories']."</option>";
                    }
                    
                  }
                  ?>
                </select>
              </div>
<!-- for product name -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">Product Name</label>
                <input type="text" name="name"  placeholder="Enter Product" class="form-control" required value="<?php echo $name ?>">
              </div>

<!-- for product mrp -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">MRP</label>
                <input type="text" name="mrp"  placeholder="Enter MRP" class="form-control" required value="<?php echo $mrp ?>">
              </div>

<!-- for product price -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">Price</label>
                <input type="text" name="price"  placeholder="Enter price" class="form-control" required value="<?php echo $price ?>">
              </div>

<!-- for product quantity -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">Quantity</label>
                <input type="text" name="qty"  placeholder="Enter quantity" class="form-control" required value="<?php echo $qty ?>">
              </div>

<!-- for product image -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">Product Image</label>
                <input type="file" name="image" class="form-control" <?php echo $image_required ?> >
              </div>

<!-- short description -->
              <div class="form-group">
                <label for="categories" class=" form-control-label">Short description</label>
                <textarea name="short_desc"  placeholder="Enter Product short description" class="form-control" required><?php echo $short_desc ?></textarea>
              </div>
<!-- description -->

              <div class="form-group">
                <label for="categories" class=" form-control-label">Description</label>
                <textarea type="text" name="description"  placeholder="Enter description" class="form-control" required><?php echo $description ?></textarea>
              </div>

              <div class="form-group">
                <label for="categories" class=" form-control-label">Meta Title</label>
                <textarea type="text" name="meta_title"  placeholder="Enter meta title" class="form-control"><?php echo $meta_title ?></textarea>
              </div>

              <div class="form-group">
                <label for="categories" class=" form-control-label">meta description</label>
                <textarea type="text" name="meta_desc"  placeholder="Enter meta description" class="form-control"><?php echo $meta_desc ?></textarea>
              </div>

              <div class="form-group">
                <label for="categories" class=" form-control-label">meta keyword</label>
                <textarea type="text" name="meta_keyword"  placeholder="Enter Product short description" class="form-control"><?php echo $meta_keyword ?></textarea>
              </div>

              <div class="form-group">
                <label for="categories" class=" form-control-label">meta description</label>
                <textarea type="text" name="meta_desc"  placeholder="Enter Product short description" class="form-control"><?php echo $meta_desc ?></textarea>
              </div>



            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
              <span id="payment-button-amount">Submit</span>
            </button>
            <div style="color: red;" ><?php echo $msg ?></div>
          </div>
</form>

        </div>
      </div>
    </div>
  </div>
</div>

<?php
require('./footer.inc.php');
?>