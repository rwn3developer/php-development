<?php
    include('checkAdmin.php');
    include('db.php');

    //user status change active , deactive
    if(isset($_GET['status']) && isset($_GET['id'])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        if($status == 1){
            $qu = "UPDATE `users` SET `status`='0' WHERE `id`='$id'";
            $res = mysqli_query($con,$qu);
            if($res > 0){
                $_SESSION['message'] = "status successfully change";
            }else{
                $_SESSION['message'] = "status role successfully change";
            }
        }else{
            $qu = "UPDATE `users` SET `status`='1' WHERE `id`='$id'";
            $res = mysqli_query($con,$qu);
            if($res > 0){
                $_SESSION['message'] = "status successfully change";
            }else{
                $_SESSION['message'] = "status role successfully change";
            }
        }
    }

    //user role update 
    if(isset($_POST['update_role'])){
        $role_edit_id = $_POST['role_edit_id'];
        $changerole = $_POST['change_role'];
        $qu = "UPDATE `users` SET `role`='$changerole' WHERE `id`='$role_edit_id'";
        $res = mysqli_query($con,$qu);
        if($res > 0){
            $_SESSION['message'] = "user role successfully change";
        }else{
             $_SESSION['message'] = "role not successfully change";
        }
    }
    include('header.php'); 
?>

<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">User Management</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <!-- Table formate -->
                <!-- <div class="row">
                    <div class="col-12">
                        <?php 
                            if(isset($_SESSION['message'])){
                        ?>
                        <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['message'];  ?>
                        </div>
                        <?php } ?>
                        <?php unset($_SESSION['message']); ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Show all user</h5>
                            </div>
                            <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Id</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Password</th>
                                      <th scope="col">Role</th>
                                      <th scope="col">Change role</th>

                                      <th scope="col">Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        <?php
                                            $qu = "SELECT * FROM `users`";
                                            $alluser = mysqli_query($con,$qu);
                                            $i=0;
                                            while($row = mysqli_fetch_array($alluser)) 
                                            {
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo ++$i; ?></th>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['password'];?></td>
                                                <td>
                                                    <?php if($row['role']==1) { ?>
                                                        <a href=""  class="btn btn-info btn-sm">admin</a>
                                                    <?php } else { ?>
                                                        <a href=""  class="btn btn-secondary btn-sm">user</a>
                                                    <?php } ?>   
                                                </td>
                                                <td>
                                                    <form method="post" action="">
                                                        <input type="hidden" name="role_edit_id" value="<?php echo $row['id']; ?>">
                                                        <select class="form-control w-50" name="change_role">
                                                            <option value="">---select role---</option>
                                                            <option <?php if($row['role']==1) echo "selected"; ?> value="1">admin</option>
                                                            <option <?php if($row['role']==0) echo "selected"; ?> value="0">user</option>
                                                        </select><br>
                                                        <input type="submit" name="update_role" class="btn btn-primary btn-sm"/>
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php if($row['status']==1) { ?>
                                                        <a href="view_user.php?status=<?php echo $row['status'] ?>&id=<?php echo $row['id'] ?>"  class="btn btn-success btn-sm">active</a>
                                                    <?php } else { ?>
                                                        <a href="view_user.php?status=<?php echo $row['status'] ?>&id=<?php echo $row['id'] ?>"  class="btn btn-danger btn-sm">user</a>
                                                    <?php } ?>
                                                    
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    
                                  </tbody>
                            </table>
                        </div>
                        
                        
                    </div>
                </div> -->

                <!-- card view -->
                 <div class="row">
                        <?php 
                            $qu = "SELECT * FROM `users`";
                            $res = mysqli_query($con,$qu);
                            while($row = mysqli_fetch_array($res)) {

                        ?>
                                                        
                            <div class="col-md-3">
                                <div class="card">
                                <h5 class="card-header">Name :- <?php echo $row['name']; ?></h5>
                                <div class="card-body">
                                    <p class="card-text">Email :- <?php echo $row['email']; ?></p>
                                        <?php if($row['role']==1) { ?>
                                            <p style="color:green" class="card-text">Role :- admin</p>
                                        <?php } else { ?>
                                            <p style="color:brown" class="card-text">Role :- user</p>
                                        <?php } ?>

                                        <form method="post">
                                            <div class="d-flex justify-content-between">
                                                    <input type="hidden" name="role_edit_id" value="<?php echo $row['id']; ?>">
                                                <select class="form-control w-75" name="change_role">
                                                    <option value="">---select role---</option>
                                                    <option <?php if($row['role']==1) echo "selected"; ?> value="1">admin</option>
                                                    <option <?php if($row['role']==0) echo "selected"; ?> value="0">user</option>
                                                </select>
                                                <input type="submit" name="update_role" class="btn btn-success btn-sm"/>
                                            </div>
                                        </form><br>

                                        <?php if($row['status']==1) { ?>
                                                <p style="color:green" class="card-text">Status :- active</p>
                                        <?php } else { ?>
                                                <p style="color:brown" class="card-text">Role :- deactive</p>
                                        <?php } ?>

                                        <form method="post">
                                             <div class="d-flex justify-content-between">
                                                    <select class="form-control">
                                                        <option>---select role---</option>
                                                        <option>admin</option>
                                                        <option>user</option>

                                                </select>
                                            </div>
                                        </form><br>
                                    <a href="#" class="btn btn-primary">Mode Details</a>
                                </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                 </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>

<?php include('footer.php'); ?>

