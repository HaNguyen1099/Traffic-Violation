<?php
  // Database connection details (replace with your actual credentials)
  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'traffic_violation_db';
  
  // Connect to the database
  $conn = mysqli_connect($hostname, $username, $password, $database);
  
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // SQL queries to fetch data
  $sql_vehicles = "SELECT COUNT(*) AS total_vehicles FROM vehicles";
  $sql_violations = "SELECT COUNT(*) AS total_violations FROM traffic_reports";
  $sql_licenses = "SELECT COUNT(*) AS total_licenses FROM driving_licenses";

  $result_vehicles = $conn->query($sql_vehicles);
  $result_violations = $conn->query($sql_violations);
  $result_licenses = $conn->query($sql_licenses);

  // Assuming results are retrieved successfully
  if ($result_vehicles->num_rows > 0 && $result_violations->num_rows > 0 && $result_licenses->num_rows > 0) {
    $row_vehicles = $result_vehicles->fetch_assoc();
    $row_violations = $result_violations->fetch_assoc();
    $row_licenses = $result_licenses->fetch_assoc();
    
    $total_vehicles = $row_vehicles['total_vehicles'];
    $total_violations = $row_violations['total_violations'];
    $total_licenses = $row_licenses['total_licenses'];
  } else {
    // Handle cases where data retrieval fails
    echo "Error fetching data";
  }

  $conn->close();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <title>Tra Cứu Vi phạm Giao thông</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/logo.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body> 
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0">
            <li class="nav-item">
              <a class="nav-link" href="signup.html">
                <button type="signup" class="btn btn-primary" style="margin: auto 10px; width: 130px; height: 40px; border-color: white;"> Đăng ký </button>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.html">
                <button type="login" class="btn btn-primary" style="margin: auto 10px; width: 130px; height: 40px; border-color: white;"> Đăng nhập </button>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Thống kê</h6>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng số phương tiện</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_vehicles; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">So với tháng trước</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng số bằng lái xe</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_licenses; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">So với tháng trước</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Tổng số lỗi vi phạm giao thông</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_violations; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">So với tháng trước</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row justify-content-center">
          <div class="col">
            <div class="card" style="background-image: url(assets/img/theme/bgG.png);">
                <div class="col-xs-12" style="height:60px;"></div>
                <div class="userForm center-block">
                    <div class="text-center align-content-center">
                <form action="lookupGuest.php" method ="POST">
                    <div class="form-group align-content-center justify-content-center text-center">
                    <h1><label for="vhno" style="margin:20px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" class="text-primary mb-5 mt-5">Tra cứu Vi phạm Giao thông</label></h1>
                    <div class="d-flex justify-content-center">
                        <input type="text" class="input_form form-control" id="vhno" placeholder="Nhập biển số xe" name="vhno" style="width: 600px; height: 60px; border-color: steelblue;" required>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4" style="width: 170px; height: 45px;">Tra Cứu</button>
                    <br> <br> <br>
                    <br> <br> <br>
                </form>
                </div>
                </div>
            </div>
          </div>
          </div>  
        </div>
    </div>
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-6">
            <div class="copyright text-center  text-muted">
              &copy; 2024 <a class="font-weight-bold ml-1 text-primary">Nguyn Ha</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
