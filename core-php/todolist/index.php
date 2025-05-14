<?php
    include('admin/db.php');
    session_start();

  

    if(isset($_POST['submit'])){
      
      $email = $_POST['email'];
      $password = $_POST['password'];
    
      //email and password validation 
      $qu = "SELECT * FROM users WHERE `email` = '$email' AND `password` = '$password'";

      $result = mysqli_query($con, $qu);
      //row count 
      $row = mysqli_num_rows($result);

      // select user data from database
      $data = mysqli_fetch_array($result);

      
      $msg = "";
        if ($row == 1 && isset($data)) {

          if ($data['status'] == 0) {
            $msg = "Your account is not active";
          } else {
              //login user all data store in session 
              $_SESSION['userid'] = $data['id'];
              $_SESSION['username'] = $data['name'];
              $_SESSION['useremail'] = $data['email'];
              $_SESSION['userpassword'] = $data['password'];
              $_SESSION['role'] = $data['role'];

              if($_SESSION['role'] == 1){
                header('location:admin/dashboard.php');
              }else{
                header('location:user/dashboard.php');
              }
            }
          } else {
            $msg = "Invalid Email or Password";
          }
    }
    // If already logged in, redirect based on role
    if(isset($_SESSION['userid']) && isset($_SESSION['role'])){
        if($_SESSION['role'] == 1){
            header('Location: admin/dashboard.php');
        } else {
            header('Location: user/dashboard.php');
        }
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      margin-top: 100px;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <div class="container login-container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">

      <?php
          if(isset($msg)){
       ?>
         <div class="alert alert-danger">
            <?php echo $msg; ?>
        </div>
       <?php } ?>
     


        <div class="card p-4">
          <h3 class="text-center mb-4">Login</h3>
          <form method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
            <div class="d-grid">
              <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </div>
          </form>
          <p class="mt-3 text-center text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
