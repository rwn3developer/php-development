<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Responsive Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  
    <?php include('header.php'); ?>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content-area pt-5 mt-3" style="height:94vh">
        <h2 class="mb-4">Dashboard Overview</h2>
        <div class="row g-4">
          <div class="col-sm-6 col-lg-4">
            <div class="card text-bg-primary">
              <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text">1,024</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="card text-bg-success">
              <div class="card-body">
                <h5 class="card-title">Revenue</h5>
                <p class="card-text">$12,340</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="card text-bg-warning">
              <div class="card-body">
                <h5 class="card-title">New Orders</h5>
                <p class="card-text">325</p>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <?php include('footer.php') ?>
</body>
</html>
