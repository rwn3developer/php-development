<?php
    
    include('checkUser.php');
    include('../admin/db.php');
    $userid = $_SESSION['userid'];
    $qu = "SELECT * FROM `task` WHERE `user_id`='$userid'";
    $res = mysqli_query($con,$qu);
    include('header.php'); 
?>

 

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">user</a></li>
                                    <li><a href="#">view task</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Task Manager</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                          <th scope="col">Id</th>
                                          <th scope="col">Task name</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Change status</th>

                                          <th scope="col">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                  <?php
                                    $i=0; 
                                    while($row = mysqli_fetch_array($res)){
                                        
                                  ?>
                                    <tr>
                                        <th scope="row"><?php echo ++$i; ?></th>
                                        <td><?php echo $row['taskname'] ?></td>
                                        <td>
                                            <?php if($row['status'] == 0) { ?>
                                                <a href="" class="btn btn-danger btn-sm">Pending</a>
                                            <?php } else if($row['status']==1) { ?>
                                                <a href="" class="btn btn-warning btn-sm">Progress</a>
                                            <?php }  else { ?>
                                                <a href="" class="btn btn-success btn-sm">Done</a>
                                            <?php } ?>
                                            
                                        </td>
                                        <td>
                                            <select class="form-control w-75">
                                                <option>select status</option>
                                                <option>pending</option>
                                                <option>progress</option>
                                                <option>done</option>


                                            </select>
                                        </td>

                                        <td>
                                            <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="edit_task.php?editid=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
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
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>

<?php include('footer.php'); ?>