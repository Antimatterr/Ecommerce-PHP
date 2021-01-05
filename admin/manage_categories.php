<?php
require('./top.inc.php');
$categories = '';
$msg = '';

if(isset($_GET['id']) && $_GET['id'] != ''){
  $id = get_safe_value($con, $_GET['id']);
  $sql = "SELECT * FROM categories WHERE id = '$id' ";
  $res = mysqli_query($con, $sql);
  $check = mysqli_num_rows($res);
  
  //to restrict invalid id in links.
  if($check>0)
  {
  $row = mysqli_fetch_assoc($res);
  $categories = $row['categories'];
  }else {
    header('location:categories.php');
    die(); 
  }

}

if(isset($_POST['submit'])){
  $categories = get_safe_value($con, $_POST['categories']);
  $res = mysqli_query($con, "SELECT * FROM categories WHERE categories='$categories'");
  $check = mysqli_num_rows($res);
  if($check > 0){
    if(isset($_GET['id']) && $_GET['id'] != ''){
      $getData = mysqli_fetch_assoc($res);
      if($id = $getData['id']){

      }
      else{
        $msg = 'category already exists!';
      }
    }
    else{
      $msg = 'Category already exists!';
    }
  }
  if($msg == ''){
    if(isset($_GET['id']) && $_GET['id'] != ''){
      mysqli_query($con , "UPDATE categories SET categories='$categories' WHERE id = '$id'");
    }
    else{
    $sql = "INSERT INTO categories(categories, status) VALUES('$categories', '1')";
    mysqli_query($con, $sql);
    }
    header('location:categories.php');
    die();
  }

}






?>
<div class="content pb-0">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header"><strong>Categories</strong><small> Form</small></div>

<form method="post">
          <div class="card-body card-block">
              <div class="form-group">
                <label for="categories" class=" form-control-label">Categories</label>
                <input type="text" name="categories"  placeholder="Enter category" class="form-control" required value="<?php echo $categories ?>">
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