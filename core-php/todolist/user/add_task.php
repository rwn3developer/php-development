<?php
    include('checkUser.php');
    include('../admin/db.php');
    if(isset($_POST['submit'])){
        $userid = $_SESSION['userid'];
        $task = $_POST['task'];
        $qu = "INSERT INTO `task`(`taskname`,`user_id`) VALUES ('$task','$userid')";
        $res = mysqli_query($con,$qu);
        $msg = "";
        if($res > 0){
            $msg = "Task successfully add";
        }
    } 
    include('header.php'); 
?>

<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>View Task</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">User</a></li>
                                    <li><a href="#">Add task</a></li>
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
                    <div class="col-lg-6">
                    
                    <?php
                        if(isset($msg)){ 
                    ?>
                        <div class="alert alert-success">
                           <?php echo $msg; ?>
                        </div>
                    <?php } ?>
                   

                        <div class="card">
                            <div class="card-header">
                                <strong>Add Task</strong>
                            </div>
                            <div class="card-body card-block">
                               <form method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Task</label>
                                        <input type="text" name="task" placeholder="Enter your task" required class="form-control"> 
                                    </div>
                                    
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    
                </div>

                

                

               

                

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

<?php include('footer.php'); ?>