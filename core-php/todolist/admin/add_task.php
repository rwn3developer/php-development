<?php 
    include('db.php');
    if(isset($_POST['submit'])){
       $task = $_POST['task'];
       $qu = "INSERT INTO `tasks`(`task_name`) VALUES ('$task')";
       $res = mysqli_query($con,$qu);
       $msg = "";
       if($res == 1){
            $msg = "task successfully add";
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
                        <h4 class="page-title">Task</h4>
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
                <div class="row">
                    <div class="col-md-6">
                    
                    <?php
                        if(isset($msg)){ 
                    ?>
                        <div class="alert alert-success">
                            <?php echo $msg; ?>
                        </div>
                    <?php } ?>
                        

                        <div class="card">
                            <form method="post" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Task Add</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Task</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="task" placeholder="Write task Here" required>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                       

                    </div>
                    
                </div>
                <!-- editor -->
               
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