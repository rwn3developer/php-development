<?php
include('checkAdmin.php');
include('db.php');

    // Handle search
    if (isset($_POST['search'])) {
        $namesearch = mysqli_real_escape_string($con, $_POST['namesearch']);
        $qu = "SELECT * FROM `users` WHERE name LIKE '$namesearch%'";
    } else {
        $qu = "SELECT * FROM `users`";
    }
    $res = mysqli_query($con, $qu);

// Change user status (active/deactive)
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $status = intval($_GET['status']);

    $newStatus = ($status == 1) ? 0 : 1;
    $qu_status = "UPDATE `users` SET `status`='$newStatus' WHERE `id`='$id'";
    $res_status = mysqli_query($con, $qu_status);

    if ($res_status) {
        $_SESSION['message'] = "User status successfully changed.";
    } else {
        $_SESSION['message'] = "Failed to change user status.";
    }

    header("Location: view_user.php");
    exit();
}

// Update user role
if (isset($_POST['update_role'])) {
    $role_edit_id = intval($_POST['role_edit_id']);
    $changerole = intval($_POST['change_role']);

    $qu_role = "UPDATE `users` SET `role`='$changerole' WHERE `id`='$role_edit_id'";
    $res_role = mysqli_query($con, $qu_role);

    if ($res_role) {
        $_SESSION['message'] = "User role successfully changed.";
    } else {
        $_SESSION['message'] = "Failed to change user role.";
    }

    header("Location: view_user.php");
    exit();
}

include('header.php');
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <h4 class="page-title">User Management</h4>
            <div class="col-12 d-flex no-block align-items-center">
                <div class="mt-2">
                    <form method="post" class="d-flex">
                        <input type="text" name="namesearch" class="form-control" placeholder="Name search" />
                        <input type="submit" name="search" class="btn btn-success btn-sm ml-2" value="Search" />
                    </form>
                </div>
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

    <div class="container-fluid">

        <!-- Display alert message if available -->
        <?php 
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success w-25" role="alert">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        }
        ?>

        <div class="row">
            <?php 
            while ($row = mysqli_fetch_array($res)) {
            ?>
            <div class="col-md-3">
                <div class="card">
                    <h5 class="card-header">Name: <?php echo htmlspecialchars($row['name']); ?></h5>
                    <div class="card-body">
                        <p class="card-text">Email: <?php echo htmlspecialchars($row['email']); ?></p>

                        <p class="card-text" style="color:<?php echo $row['role'] == 1 ? 'green' : 'brown'; ?>">
                            Role: <?php echo $row['role'] == 1 ? 'admin' : 'user'; ?>
                        </p>

                        <form method="post">
                            <div class="d-flex justify-content-between">
                                <input type="hidden" name="role_edit_id" value="<?php echo $row['id']; ?>">
                                <select class="form-control w-75" name="change_role" required>
                                    <option value="">---select role---</option>
                                    <option value="1" <?php if($row['role']==1) echo "selected"; ?>>admin</option>
                                    <option value="0" <?php if($row['role']==0) echo "selected"; ?>>user</option>
                                </select>
                                <input type="submit" name="update_role" class="btn btn-success btn-sm" value="Change" />
                            </div>
                        </form>
                        <br>

                        <div class="d-flex justify-content-between">
                            <p class="card-text" style="color:<?php echo $row['status'] == 1 ? 'brown' : 'green'; ?>">
                                Status: <?php echo $row['status'] == 1 ? 'active' : 'deactive'; ?>
                            </p>

                            <a href="view_user.php?status=<?php echo $row['status']; ?>&id=<?php echo $row['id']; ?>" 
                               class="btn <?php echo $row['status'] == 1 ? 'btn-info' : 'btn-secondary'; ?>">
                                <?php echo $row['status'] == 1 ? 'Active' : 'Deactive'; ?>
                            </a>
                        </div>

                        <a href="user-all-details.php?userid=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">More Details</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <footer class="footer text-center">
        All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>
</div>

<?php include('footer.php'); ?>
