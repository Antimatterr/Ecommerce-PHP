<?php
require('./top.inc.php');
if(isset($_GET['type']) &&$_GET['type'] != ''){
   $type = get_safe_value($con, $_GET['type']);

   if($type == "paymentstatus"){
      $operation = get_safe_value($con, $_GET['operation']);
      $id = get_safe_value($con, $_GET['id']);

      if($operation == 'active')
      {
         $status = '1';
      }
      else{
         $status = '0';
      }
         $update_status_sql = "UPDATE `orders` SET payment_status = '$status' WHERE id = '$id'";
      mysqli_query($con, $update_status_sql); 
   }
   if($type == "orderstatus"){
    $operation = get_safe_value($con, $_GET['operation']);
    $id = get_safe_value($con, $_GET['id']);

    if($operation == 'active')
    {
       $status = '1';
    }
    else{
       $status = '0';
    }
       $update_status_sql = "UPDATE `orders` SET order_status = '$status' WHERE id = '$id'";
    mysqli_query($con, $update_status_sql); 
 }

   if($type == "delete"){
      $id = get_safe_value($con, $_GET['id']);
      $delete_sql = "DELETE FROM `orders` WHERE id = '$id'";
      mysqli_query($con, $delete_sql); 
   }
}

$sql="SELECT * FROM `orders`";
$res = mysqli_query($con, $sql); 
?>
         <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Categories </h4>
                           <a style="color:deepskyblue;" href="manage_categories.php">Add Categories</a>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th>ID</th>
                                       <th>User id</th>
                                       <th>Pincode</th>
                                       <th>Total price</th>
                                       <th>Payment Status</th>
                                       <th>Order Status</th>
                                       <th>Order Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   <?php 
                                   $i = 1;
                                   while($row = mysqli_fetch_assoc($res)){ ?>
                                    <tr>
                                       <td class="serial"><?php echo $i ?></td>
                                       <td><?php echo $row['id'] ?></td>
                                       <td><?php echo $row['user_id'] ?> </td>
                                       <td><?php echo $row['pincode'] ?> </td>
                                       <td><?php echo $row['total_price'] ?> </td>
                                       <td><?php
                                            if($row['payment_status'] == 1){
                                              echo "<a class='badge badge-complete' href='?type=paymentstatus&operation=deactive&id=".$row['id']."'>Completed</a>&nbsp;";
                                            }
                                            else{
                                              echo "<a class='badge badge-pending' href='?type=paymentstatus&operation=active&id=".$row['id']."'>Pending</a>&nbsp;";
                                            }
                                            
                                           

                                            ?>
                                            
                                          </td>
                                            <td><?php
                                            if($row['order_status'] == 1){
                                              echo "<a class='badge badge-complete' href='?type=orderstatus&operation=deactive&id=".$row['id']."'>Completed</a>&nbsp;";
                                            }
                                            else{
                                              echo "<a class='badge badge-pending' href='?type=orderstatus&operation=active&id=".$row['id']."'>pending</a>&nbsp;";
                                            }
                                            
                                           

                                            ?>
                                            </td>

                                            <td>
                                            <?php   
                                            echo "<a  style='background-color: red;' class='badge' href='?type=delete&id=".$row['id']."'>Delete</a>&nbsp";
                                            ?>
                                            </td>
                                    </tr>
                                    <?php } ?>
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
<?php
require('./footer.inc.php');
?>