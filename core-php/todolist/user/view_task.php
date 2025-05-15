<?php
    include('checkUser.php');
    include('../admin/db.php');

    //delete task

    if(isset($_GET['delete_taskid'])){
        $taskid = $_GET['delete_taskid'];
        $qu = "DELETE FROM `task` WHERE `id`='$taskid'";
        $query = mysqli_query($con, $qu);
        if($query){
            $_SESSION['message'] = "Task deleted successfully";
        }else {
            $_SESSION['message'] = "Task not deleted";
        }
    }
    
    //status update
    if (isset($_POST['update_status'])) {
        $task_id = $_POST['task_id'];
        $new_status = $_POST['status'];


        if ($new_status !== '') {
            $update_query = "UPDATE task SET status = '$new_status' WHERE id = '$task_id'";
            mysqli_query($con, $update_query);
            $_SESSION['message'] = "Task status updated successfully!";
            header("Location: view_task.php");
            exit();
        }
    }

    $userid = $_SESSION['userid'];
    $qu = "SELECT * FROM `task` WHERE `user_id`='$userid'";
    $res = mysqli_query($con, $qu);
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
            <div class="col-md-12">
                <?php include('../userdetail.php'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                 <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['message']; ?>
                       
                    </div>

                <!-- success message print after status_message session unset -->
                <?php unset($_SESSION['message']); } ?>


                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">View Task</strong>
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
                                    $i = 0; 
                                    while($row = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo ++$i; ?></th>
                                    <td><?php echo $row['taskname']; ?></td>
                                    <td>
                                        <?php if($row['status'] == 0) { ?>
                                            <a href="#" class="btn btn-danger btn-sm">Pending</a>
                                        <?php } else if($row['status'] == 1) { ?>
                                            <a href="#" class="btn btn-warning btn-sm">Progress</a>
                                        <?php } else { ?>
                                            <a href="#" class="btn btn-success btn-sm">Done</a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form method="POST" action="view_task.php">
                                            <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                                            <select name="status" class="form-control w-50 d-inline">
                                                <option value="">Select status</option>
                                                <option value="0" <?php if($row['status'] == 0) echo 'selected'; ?>>Pending</option>
                                                <option value="1" <?php if($row['status'] == 1) echo 'selected'; ?>>Progress</option>
                                                <option value="2" <?php if($row['status'] == 2) echo 'selected'; ?>>Done</option>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-sm btn-secondary">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="view_task.php?delete_taskid=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="edit_task.php?editid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
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
</div>

<div class="clearfix"></div>

<?php include('footer.php'); ?>
