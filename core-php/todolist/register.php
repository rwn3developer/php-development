<?php 
  include('admin/db.php');
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qu = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
    $res = mysqli_query($con,$qu);
    $msg = "";
    if($res){
      $msg = "User successfully create";
    }
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
          <div class="alert alert-success">
              <?php echo $msg; ?>
          </div>
        <?php } ?>            
        <div class="card p-4">
          <h3 class="text-center mb-4">Register</h3>
          <form method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email"  placeholder="Enter email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password"  placeholder="Enter password">
            </div>
            <div class="d-grid">
              <input type="submit" name="submit" value="submit" class="btn btn-primary"/>
            </div>
          </form>
          <p class="mt-3 text-center text-muted">Already have an account? <a href="index.php">Sign up</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
