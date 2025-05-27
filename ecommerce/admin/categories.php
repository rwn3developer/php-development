<?php 
    
    require('connection.inc.php');
    require('header.inc.php'); 
    
?>


 <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Categories</strong>
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
                                        $sql = "SELECT * FROM `categories` order by categories desc";
                                        $res = mysqli_query($con,$sql); 
                                        while($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>
                                            <th><?php echo $row['id'] ?></th>
                                            <td><?php echo $row['categories'] ?></td>
                                            <td>
                                                <?php
                                                    if($row['status']==1){
                                                        echo "<a href=''></a>";
                                                    }else{

                                                    }
                                                 ?>
                                            </td>
                                            <td></td>
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