<?php
    include('checkUser.php');
    include('../admin/db.php');

    //singel data fetch
    if(isset($_GET['editid'])){
        $editid = $_GET['editid'];
        
        $qu = "SELECT * FROM `task` WHERE `id`='$editid'";
        $res = mysqli_query($con,$qu);
        $single = mysqli_fetch_array($res);
    }

    //task update
    if(isset($_POST['submit'])){
        $userid = $_SESSION['userid'];
        $taskid = $_POST['editid'];
        $task = $_POST['task'];
        $status = $_POST['status'];
        $qu = "UPDATE `task` SET `taskname`='$task',`status`='$status',`user_id`='$userid' WHERE `id`='$taskid'";
        $res = mysqli_query($con,$qu);
        $msg = "";
        if($res > 0){
            $msg = "Task successfully update";
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
                                <h1>Task Manager</h1>
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
                                <strong>Edit Task</strong>
                            </div>
                            <div class="card-body card-block">
                               <form method="post">
                                <input type="hidden" name="editid" value="<?php echo $single['id'] ?>">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Task</label>
                                        <input type="text" value="<?php echo $single['taskname'] ?>" name="task" placeholder="Enter your task" required class="form-control"> 
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="">--- Select Status ---</option>
                                            <option value="0" <?php if($single['status'] == 0) echo 'selected'; ?>>Pending</option>
                                            <option value="1" <?php if($single['status'] == 1) echo 'selected'; ?>>Progress</option>
                                            <option value="2" <?php if($single['status'] == 2) echo 'selected'; ?>>Done</option>
                                        </select>
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

