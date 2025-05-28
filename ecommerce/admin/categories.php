<?php 
    
    require('connection.inc.php');
    require('header.inc.php'); 

    if(isset($_GET['type']) && $_GET['type']!=''){
        $type = $_GET['type'];
        if($type=="status"){
            $operation = $_GET['operation'];
            $id = $_GET['id'];
            if($operation == "active"){
                $status=0;
            }else{
                $status=1;
            }
            $sql = "UPDATE `categories` SET `status`='$status' WHERE `id`='$id'";
            $res = mysqli_query($con,$sql);
        }

        if($type=="delete"){
            $id = $_GET['id'];
            $sql = "DELETE FROM `categories` WHERE `id`='$id'";
            $res = mysqli_query($con,$sql);
        }
    }
    
?>


 <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Categories</strong>
                                <span class="ml-5"><a href="add_categories.php" class="btn btn-primary btn-sm">Add Categories</a></span>
                                
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Serial</th>
                                          <th scope="col">Id</th>
                                          <th scope="col">Categories</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $i=1;
                                        $sql = "SELECT * FROM `categories` ORDER BY categories ASC";
                                        $res = mysqli_query($con,$sql); 
                                        while($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $i; ?></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['categories'] ?></td>
                                            <td>
                                                <?php
                                                    if($row['status']==1){
                                                        echo "<a href='?type=status&operation=active&id=".$row['id']."' class='btn btn-info btn-sm'>Active</a>";
                                                    }else{
                                                        echo "<a href='?type=status&operation=deactive&id=".$row['id']."' class='btn btn-warning btn-sm'>Deactive</a>";
                                                    }
                                                 ?>
                                            </td>
                                            <td>
                                                <a href="?type=delete&id=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                                                 <a href="add_categories.php?id=<?php echo $row['id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

               

                

               
            </div>




          

            

        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>


<?php require('footer.inc.php'); ?>