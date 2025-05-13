<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Responsive Admin Panel with Footer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    .main-wrapper {
      flex: 1;
    }

    .sidebar {
      background-color: #343a40;
      height: 100%;
      padding-top: 60px;
    }

    .sidebar a {
      color: #fff;
      padding: 15px 20px;
      display: block;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #495057;
    }

    .content-area {
      padding: 20px;
    }

    @media (min-width: 768px) {
      .sidebar {
        position: fixed;
        width: 250px;
        height: 100%;
      }

      .content-area {
        margin-left: 250px;
      }
    }

    .footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 12px 0;
    }
  </style>
</head>
<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <!-- Wrapper for main + footer -->
  <div class="main-wrapper">
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
          <div class="position-sticky">
            <a href="dashboard.php" class="nav-link">Dashboard</a>
            <a href="users.php" class="nav-link">Users</a>
            <a href="#" class="nav-link">Settings</a>
            <a href="#" class="nav-link">Reports</a>
            <a href="#" class="nav-link">Logout</a>
          </div>
        </nav>