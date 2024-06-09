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
