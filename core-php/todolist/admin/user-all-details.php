<?php 
    include('checkAdmin.php');
    include('db.php');

    //task filter submit button
    if(isset($_POST['taskfilter'])){
        $taskfiltername = $_POST['taskfiltername'];
    }

    //userwise task show
    if(isset($_GET['userid'])){
        $userid = $_GET['userid'];
        $selectsingle = mysqli_query($con,"SELECT * FROM `users` WHERE `id`='$userid'");
        $singlerow = mysqli_fetch_array($selectsingle); 
        $qu = "
            SELECT users.name,users.email,users.role,users.status AS user_status,task.taskname,task.status AS task_status FROM users 
            LEFT JOIN task ON users.id = task.user_id WHERE users.id = $userid
        ";

        if(isset($taskfiltername) && $taskfiltername != "") {
            $qu .= " AND task.status = '$taskfiltername'";
        }else{
             $qu = "
                SELECT users.name,users.email,users.role,users.status AS user_status,task.taskname,task.status AS task_status FROM users 
                LEFT JOIN task ON users.id = task.user_id WHERE users.id = $userid
            ";
        }
        $allrecord = mysqli_query($con,$qu);
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
                        <h4 class="page-title">User Task</h4>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header">User Details</h5>
                            <div class="card-body">
                                <p class="card-text">Name :- <?php echo $singlerow['name']; ?></p>
                                <p class="card-text">Email :- <?php echo $singlerow['email']; ?></p>
                                <p class="card-text">Password :- <?php echo $singlerow['password']; ?></p>
                                <?php if($singlerow['role']==1) { ?>
                                    <p style="color:green">Role :- admin</p>
                                <?php } else { ?>
                                    <p style="color:purple">Role :-user</p>
                                <?php } ?>
                            </div>
                        </div> 
                    </div>
                </div>


                <div class="row">
                    
                        
                        <form method="post" class="d-flex">
                            <select name="taskfiltername" class="form-control">
                                <option value="">---select status---</option>
                                <option value="0">Pending</option>
                                <option value="1">Progress</option>
                                <option value="2">Done</option>
                            </select>
                            <input type="submit" name="taskfilter" class="btn btn-primary btn-sm">
                        </form>
                    
                </div>
                <br>
                
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <?php
                        $i=0;
                        while($row = mysqli_fetch_array($allrecord)) {
                    ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    Task no :- <?php echo  ++$i; ?>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Task name :- <?php echo $row['taskname']; ?></h5>
                                    <?php if($row['task_status'] == 0) { ?>
                                        <a href="#" class="btn btn-warning btn-sm">Pending</a>
                                    <?php } else if($row['task_status'] == 1) { ?>
                                        <a href="#" class="btn btn-primary btn-sm">Progress</a>
                                    <?php } else if($row['task_status'] == 2) {  ?>
                                        <a href="#" class="btn btn-primary btn-sm">Done</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
               
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
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
