<?php
include('checkUser.php');
include('../admin/db.php');

// Delete task
if (isset($_GET['delete_taskid'])) {
    $taskid = $_GET['delete_taskid'];
    $qu = "DELETE FROM `task` WHERE `id`='$taskid'";
    $query = mysqli_query($con, $qu);
    if ($query) {
        $_SESSION['message'] = "Task deleted successfully";
    } else {
        $_SESSION['message'] = "Task not deleted";
    }
}

// Update task status
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

$userid = $_SESSION['userid'];  // Get the user ID
$query = "SELECT * FROM `task` WHERE `user_id`='$userid'";

// Search task
$search_query = '';
if (isset($_POST['searchtask']) && !empty($_POST['searchtask'])) {
    $taskname = $_POST['searchtask'];
    $query .= " AND `taskname` LIKE '%$taskname%'";
    $search_query = $taskname;  // Store the search term for pagination link
}

// Status filter
if (isset($_POST['filterstatus']) && $_POST['filterstatus'] != '---select status---') {
    $filterstatus = $_POST['filterstatus'];
    $query .= " AND `status`='$filterstatus'";
}

// Sorting the records
if (isset($_POST['changeorder']) && $_POST['changeorder'] != '---select order---') {
    $order = $_POST['changeorder'];
    $query .= " ORDER BY `taskname` $order";
} else {
    // Default order if no sorting is applied
    $query .= " ORDER BY `taskname` ASC";
}

// Pagination logic
$limit = 3; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting record for the current page
$start_from = ($page - 1) * $limit;

// Modify the query to limit the records per page
$query .= " LIMIT $start_from, $limit";

// Run the query to get the tasks for the current page
$res = mysqli_query($con, $query);

// Calculate the total number of records for pagination
$total_query = "SELECT COUNT(*) FROM `task` WHERE `user_id`='$userid'";
if (!empty($taskname)) {
    $total_query .= " AND `taskname` LIKE '%$taskname%'";
}
$total_result = mysqli_query($con, $total_query);
$total_rows = mysqli_fetch_array($total_result)[0];

// Calculate total pages
$total_pages = ceil($total_rows / $limit);

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
                    <?php unset($_SESSION['message']); } ?>

                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">View Task</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Search Form -->
                            <div class="col-md-4">
                                <form method="post" action="" class="d-flex">
                                    <input type="text" name="searchtask" class="form-control w-50" value="<?php echo $search_query; ?>" placeholder="Search by task name">
                                    <input type="submit" class="btn btn-success btn-sm ml-3" name="search" value="Search"/>
                                </form>
                            </div>
    
                            <!-- Status Filter Form -->
                            <div class="col-md-4">
                                <form method="post" action="" class="d-flex">
                                    <select name="filterstatus" class="form-control w-50">
                                        <option value="">---select status---</option>
                                        <option value="0" <?php if(isset($_POST['filterstatus']) && $_POST['filterstatus'] == '0') echo 'selected'; ?>>Pending</option>
                                        <option value="1" <?php if(isset($_POST['filterstatus']) && $_POST['filterstatus'] == '1') echo 'selected'; ?>>Progress</option>
                                        <option value="2" <?php if(isset($_POST['filterstatus']) && $_POST['filterstatus'] == '2') echo 'selected'; ?>>Done</option>
                                    </select>
                                    <input type="submit" class="btn btn-success btn-sm ml-3" name="status" value="Submit"/>
                                </form>
                            </div>

                            <!-- Order Form -->
                            <div class="col-md-4">
                                <form method="post" action="" class="d-flex">
                                    <select name="changeorder" class="form-control w-50">
                                        <option>---select order---</option>
                                        <option value="ASC" <?php if(isset($_POST['changeorder']) && $_POST['changeorder'] == 'ASC') echo 'selected'; ?>>ASC</option>
                                        <option value="DESC" <?php if(isset($_POST['changeorder']) && $_POST['changeorder'] == 'DESC') echo 'selected'; ?>>DSC</option>
                                    </select>
                                    <input type="submit" class="btn btn-success btn-sm ml-3" name="order" value="Submit"/>
                                </form>
                            </div>
                        </div>
                        
                        <br>

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
                                    while ($row = mysqli_fetch_array($res)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo ++$i; ?></th>
                                    <td><?php echo $row['taskname']; ?></td>
                                    <td>
                                        <?php if ($row['status'] == 0) { ?>
                                            <a href="#" class="btn btn-danger btn-sm">Pending</a>
                                        <?php } else if ($row['status'] == 1) { ?>
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
                                                <option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>>Pending</option>
                                                <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>Progress</option>
                                                <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>>Done</option>
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

                        <!-- Pagination Links -->
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="view_task.php?page=<?php echo $page - 1; ?>&searchtask=<?php echo $search_query; ?>">Previous</a>
                                </li>
                                <?php
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $active = ($i == $page) ? 'active' : '';
                                        echo "<li class='page-item $active'><a class='page-link' href='view_task.php?page=$i&searchtask=$search_query'>$i</a></li>";
                                    }
                                ?>
                                <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="view_task.php?page=<?php echo $page + 1; ?>&searchtask=<?php echo $search_query; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<?php include('footer.php'); ?>
