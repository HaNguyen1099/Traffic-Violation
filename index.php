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
  $sql_name = "SELECT name FROM admin";

  $result_vehicles = $conn->query($sql_vehicles);
  $result_violations = $conn->query($sql_violations);
  $result_licenses = $conn->query($sql_licenses);
  $result_name = $conn->query($sql_name);


  // Assuming results are retrieved successfully
  if ($result_vehicles->num_rows > 0 && $result_violations->num_rows > 0 && $result_licenses->num_rows > 0 && $result_name->num_rows > 0) {
    $row_vehicles = $result_vehicles->fetch_assoc();
    $row_violations = $result_violations->fetch_assoc();
    $row_licenses = $result_licenses->fetch_assoc();
    if ($result_name->num_rows > 0) {
        $row_name = $result_name->fetch_assoc();
        $total_name = $row_name['name']; // Access name using the key
    } else {
    // Handle cases where data retrieval fails for admin name
    echo "Error fetching administrator name";
    }
    
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
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="#">
          <img src="assets/img/brand/logo.png" class="navbar-brand-img" alt="logo">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Thống kê</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="lookup.html">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Tra cứu</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link vio-link" href="violations.php">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Quản lý lỗi vi phạm</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vehicles.php">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Quản lý phương tiện</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="licenses.php">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Quản lý bằng lái</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
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
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="assets/img/brand/favicon.png">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $total_name; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <div class="dropdown-divider"></div>
                <a href="info.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Tài khoản</span>
                </a>
                <a href="login.html" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
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
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Thống kê</li>
                </ol>
              </nav>
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
      <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Top 5 lỗi giao thông vi phạm nhiều nhất</h3>
              </div>
            </div>
          </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                  <tr>
                    <th scope="col" class="sort" data-sort="id">STT</th>
                    <th scope="col" class="sort" data-sort="name">Lỗi vi phạm</th>
                    <th scope="col" class="sort" data-sort="fine">Mức phạt</th>
                    <th scope="col" class="sort" data-sort="num">Số người vi phạm</th>
                    <th scope="col"></th>
                  </tr>
                  <?php
                  // Connect to your database
                  $hostname = 'localhost';
                  $username = 'root';
                  $password = ''; 
                  $database = 'traffic_violation_db';

                  // Create connection
                  $conn = new mysqli($hostname, $username, $password, $database);

                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  }

                  // SQL query to fetch violations data
                  $sql = "SELECT ROW_NUMBER() OVER (ORDER BY violation_count DESC) AS row_num, violation_type, COUNT(*) AS violation_count, fine AS fine
                          FROM traffic_reports
                          GROUP BY violation_type
                          ORDER BY violation_count DESC
                          LIMIT 5;";
                  $result = $conn->query($sql);

                  // Check if there are results
                  if ($result->num_rows > 0) {
                      // Output data for each row
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["row_num"] . "</td>";
                        echo "<td>" . $row["violation_type"] . "</td>";
                        echo "<td>" . $row["fine"] . "</td>";
                        echo "<td>" . $row["violation_count"] . "</td>";
                        echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='6'>Không tìm thấy dữ liệu vi phạm nào.</td></tr>";
                  }
                  $conn->close();
                  ?>
              </table>
              <br> <br> <br> <br>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h5 class="h3 mb-0">Tỷ lệ các lỗi vi phạm</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
                <canvas id="chart-pie" class="chart-canvas img-center" style="width:400px"></canvas>
                <?php
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

                  // Execute the query to retrieve violation types and counts
                  $sql = "SELECT violation_type, COUNT(*) AS violation_count FROM traffic_reports GROUP BY violation_type";
                  $result = mysqli_query($conn, $sql);

                  if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                  }

                  // Prepare data for the chart
                  $chartData = [];
                  $labels = [];
                  $counts = [];
                  while ($row = mysqli_fetch_assoc($result)) {
                    $labels[] = $row['violation_type'];
                    $counts[] = $row['violation_count'];
                  }

                  $chartData = [
                    'labels' => $labels,
                    'datasets' => [
                      [
                        'data' => $counts,
                        'backgroundColor' => [
                          '#F05A41',
                          '#FEB74F',
                          '#F6ED60',
                          '#ADD461',
                          '#70C3ED',
                          '#9A6DB0',
                          '#D671AB',
                          '#F26091',
                        ],
                        'borderColor' => [
                          '#FFFFFF'
                        ],
                        'borderWidth' => 1,
                        'label' => 'Số lượng vi phạm theo loại'
                      ]
                    ],
                  ];

                  // Close the database connection
                  mysqli_close($conn);

                  // Encode the chart data as JSON for Chart.js
                  $encodedChartData = json_encode($chartData);
                ?>
                <script>
                  const chartPieData = <?php echo $encodedChartData; ?>;
                  new Chart("chart-pie", {
                    type: "pie",
                    data: chartPieData,
                    options: {
                      responsive: true,
                      plugins: {
                          legend: {
                              position: 'bottom',
                          }
                        }
                      }
                  });
                </script>
            </div>
            <br>
          </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <style>
    .chart {
  position: relative; /* Make the chart container relative for absolute positioning */
}

.chart canvas {
  /* Your existing styles for the canvas */
}

.chart legend {
  position: absolute;
  bottom: 10px; /* Adjust the bottom position as needed */
  left: 50%; /* Center the legend horizontally */
  transform: translateX(-50%); /* Offset the legend to center */
}

  </style>  
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
