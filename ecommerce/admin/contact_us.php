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
                                <strong class="card-title">Contact Us</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                          <th scope="col">Id</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Email</th>
                                          <th scope="col">Mobile</th>
                                          <th scope="col">Query</th>
                                          <th scope="col">Date</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                        $i=1;
                                        $sql = "SELECT * FROM `contact_us`";
                                        $res = mysqli_query($con,$sql);
                                        while($row = mysqli_fetch_array($res)) { 
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['mobile']; ?></td>
                                            <td><?php echo $row['comment']; ?></td>
                                            <td><?php echo $row['added_on']; ?></td>
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