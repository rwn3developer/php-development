<div class="card">
                    <h5 class="card-header">User Details</h5>
                    <div class="card-body">
                        <p class="card-text">Name :- <?php echo $_SESSION['username']; ?></p>
                        <p class="card-text">Email :- <?php echo $_SESSION['useremail']; ?></p>
                        <p class="card-text">Password :- <?php echo $_SESSION['userpassword']; ?></p>
                        <?php if ($_SESSION['role'] == 0) { ?>
                            <p class="card-text">Role :- user</p>
                        <?php } else{ ?>
                            <p class="card-text">Role :- admin</p>
                        <?php } ?>
                    </div>
</div>      