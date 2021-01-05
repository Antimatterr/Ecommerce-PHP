<?php
require('./top.inc.php');
if(isset($_GET['type']) &&$_GET['type'] != ''){
   $type = get_safe_value($con, $_GET['type']);

   if($type == "status"){
      $operation = get_safe_value($con, $_GET['operation']);
      $id = get_safe_value($con, $_GET['id']);

      if($operation == 'active')
      {
         $status = '1';
      }
      else{
         $status = '0';
      }
         $update_status_sql = "UPDATE `categories` SET status = '$status' WHERE id = '$id'";
      mysqli_query($con, $update_status_sql); 
   }

   if($type == "delete"){
      $id = get_safe_value($con, $_GET['id']);
      $delete_sql = "DELETE FROM `categories` WHERE id = '$id'";
      mysqli_query($con, $delete_sql); 
   }
}

$sql="SELECT * FROM `categories` ORDER BY categories DESC";
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
                                       <th>Categories</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                   <?php 
                                   $i = 1;
                                   while($row = mysqli_fetch_assoc($res)){ ?>
                                    <tr>
                                       <td class="serial"><?php echo $i ?></td>
                                       <td><?php echo $row['id'] ?></td>
                                       <td><?php echo $row['categories'] ?> </td>
                                       <td><?php
                                            if($row['status'] == 1){
                                              echo "<a class='badge badge-complete' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp;";
                                            }
                                            else{
                                              echo "<a class='badge badge-pending' href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp;";
                                            }
                                            echo "<a style='background-color:deepskyblue' class='badge' href='manage_categories.php?id=".$row['id']."'>Edit</a>&nbsp";

                                            echo "<a  style='background-color: red;' class='badge' href='?type=delete&id=".$row['id']."'>Delete</a>&nbsp";

                                            ?></td>
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