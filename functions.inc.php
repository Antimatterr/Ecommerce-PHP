<?php
function pr($arr){
  echo '<pre>';
  print_r($arr);
}

function prx($arr){
  echo '<pre>';
  print_r($arr);
  die();
}

function get_product($con, $limit='', $cat_id='', $product_id=''){
  $sql = "SELECT * FROM product WHERE status=1 ";
 
  if($cat_id != ''){
      $sql.=" AND categories_id = $cat_id";
  }

  if($product_id != ''){
    $sql.=" AND id = $product_id";
  }

  if($limit != ''){
    $sql.=" LIMIT $limit"; 
  }
  $res = mysqli_query($con, $sql) ;
  $data = array();
  while($row=mysqli_fetch_assoc($res)){
    $data[]=$row;
  }
  return $data;
  
}
?>











