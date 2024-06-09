<?php
session_start();

// Check if a search was performed and results exist
if (isset($_SESSION['violation_results'])) {
  $violationsFound = true;
  $violations = $_SESSION['violation_results'];
  unset($_SESSION['violation_results']); // Clear session data after use
} else {
  // Handle the scenario where no search was performed or results were not found
  $violationsFound = false;
}
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
              <a class="nav-link" href="violations.php">
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
                    <span class="mb-0 text-sm  font-weight-bold">Nguyễn Ngọc Hà</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <div class="dropdown-divider"></div>
                <a href="info.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Tài khoản</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main section -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Tra cứu</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Kết quả</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tra cứu</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col">
            <div class="card">
                <div class="d-flex"> 
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Tra cứu vi phạm</h3>
                    </div>
                    <!-- Search form -->
                    <form class="navbar-search navbar-search-light form-inline mr-sm-3 float-right" id="navbar-search-main" style="margin-left: auto;">
                        <div class="form-group mb-0">
                        <div class="input-group input-group-alternative input-group-merge">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" placeholder="Search" type="text">
                        </div>
                        </div>
                        <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </form>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                      <tr>
                          <th scope="col" class="sort" data-sort="name">Lỗi vi phạm</th>
                          <th scope="col" class="sort" data-sort="user">Người vi phạm</th>
                          <th scope="col" class="sort" data-sort="date">Ngày vi phạm</th>
                          <th scope="col" class="sort" data-sort="address">Nơi vi phạm</th>
                          <th scope="col" class="sort" data-sort="fine">Nộp phạt</th>
                          <th scope="col" class="sort" data-sort="complete">Đã thanh toán</th>
                      </tr>
                        <?php if ($violationsFound): ?>
                          <?php foreach ($violations as $violation): ?>
                            <tr>
                              <td><?php echo $violation['violation_type']; ?></td>
                              <td><?php echo $violation['officer_name']; ?></td>
                              <td><?php echo $violation['report_date']; ?></td>
                              <td><?php echo $violation['location']; ?></td>
                              <td><?php echo $violation['fine']; ?></td>
                              <td><?php echo $violation['isPaymentDone'] ? 'Xong' : 'Chưa'; ?></td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr><td colspan="6">Không tìm thấy vi phạm nào.</td></tr>
                        <?php endif; ?>
                  </table>
                  <br>
                </div>
            </div>
          </div>
          <br> <br>
        </div>
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