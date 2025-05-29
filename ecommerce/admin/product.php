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
                                <strong class="card-title">Manage Product</strong>
                                <span class="ml-5"><a href="add_product.php" class="btn btn-primary btn-sm">Add Product</a></span>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                          <th scope="col">Id</th>
                                          <th scope="col">Categories</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Image</th>
                                          <th scope="col">Mrp</th>
                                          <th scope="col">Price</th>
                                          <th scope="col">Qty</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                        <?php
                                            $i=1;
                                            $sql = "SELECT * FROM `products` ORDER BY name DESC"; 
                                            $res = mysqli_query($con,$sql);
                                            while($row = mysqli_fetch_array($res)){
                                        ?>
                                            <tr>
                                                <td><?php echo $i++;  ?></td>
                                            </tr>

                                        <?php } ?>
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