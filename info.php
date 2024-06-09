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
  $sql_name = "SELECT name FROM admin";
  $sql_email = "SELECT email FROM admin";

  $result_name = $conn->query($sql_name);
  $result_email = $conn->query($sql_email);

  // Assuming results are retrieved successfully
  if ($result_name->num_rows > 0) {
      $row_name = $result_name->fetch_assoc();
      $total_name = $row_name['name']; // Access name using the key
  } else {
  // Handle cases where data retrieval fails for admin name
  echo "Error fetching administrator name";
  }

  if ($result_email->num_rows > 0) {
    $row_email = $result_email->fetch_assoc();
    $total_email = $row_email['email']; // Access name using the key
  } else {
  // Handle cases where data retrieval fails for admin name
  echo "Error fetching administrator name";
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
              <h6 class="h2 text-white d-inline-block mb-0">Thông tin</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
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
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image pt-7 mt-2">
                  <img id="profile-preview" src="assets/img/brand/favicon.png" alt="Image preview" class="rounded-circle" style="width: 150px; height: 150px;">
                </div>
              </div>
            </div>
            <div class="card-body pt-7">
              <div class="text-center">
                <h5 class="h3"><?php echo $total_name; ?></h5>
              </div>
            </div>
            <div class="card-img-top d-flex justify-content-center align-items-center p-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="profileImage" name="profileImage" accept="image/*">
                <label class="custom-file-label" for="profileImage"></label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                   <h3 class="mb-0">Chỉnh sửa thông tin cá nhân </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="updateUser.php" method="post">
                <h6 class="heading-small text-muted mb-4">Thông tin người dùng</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Họ và tên</label>
                        <input type="text" id="input-username" class="form-control" placeholder="Username" name="input-username" value="<?php echo $total_name; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" id="input-email" class="form-control" placeholder="Email" name="input-email" value="<?php echo $total_email; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary" id="edit-btn">Chỉnh sửa</button>
                </div>
                <div class="text-right">
                  <button type="button" class="btn btn-primary" id="change-password-btn">Đổi mật khẩu</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="change-password-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="change-password-modal-label">Đổi mật khẩu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="change-password-form">
          <div class="form-group">
            <label for="current-password">Mật khẩu hiện tại</label>
            <input type="password" class="form-control" id="current-password" name="current-password" placeHolder="Nhập mật khẩu hiện tại của bạn" required>
          </div>
          <div class="form-group">
            <label for="new-password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="new-password" name="new-password" placeHolder="Nhập mật khẩu mới" required>
          </div>
          <div class="form-group">
            <label for="confirm-password">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeHolder="Nhập lại mật khẩu mới" required>
          </div>
          <div class="alert alert-danger" id="password-error-message" role="alert" style="display: none;"></div>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
      </div>
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
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script>
    $(document).ready(function() {
      // Handle file upload and update preview
      $("#profileImage").change(function() {
        if (this.files && this.files[0]) {
          // Get the selected file
          const file = this.files[0];

          // Create a FileReader object
          const reader = new FileReader();

          // Read the file as data URL
          reader.onload = function(e) {
            // Set the data URL as the source of the preview image
            $("#profile-preview").attr("src", e.target.result);

            // Store data URL in local storage (optional)
            localStorage.setItem('profileImage', e.target.result);
          };

          // Read the file
          reader.readAsDataURL(file);
        }
      });

      // Check for stored image data on page load
      const storedImage = localStorage.getItem('profileImage');
      if (storedImage) {
        $("#profile-preview").attr("src", storedImage);
      }
    });
  </script>

  <script>
    // Get references to DOM elements
    const changePasswordBtn = document.getElementById('change-password-btn');
    const changePasswordForm = document.getElementById('change-password-form');
    const currentPasswordInput = document.getElementById('current-password');
    const newPasswordInput = document.getElementById('new-password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordErrorMessage = document.getElementById('password-error-message');

    // Add event listener to the 'click' event of the 'Đổi mật khẩu' button
    changePasswordBtn.addEventListener('click', function() {
      $('#change-password-modal').modal('show'); // Show the password change popup
    });

    // Add event listener to the 'submit' event of the password change form
    changePasswordForm.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission

      // Validate input fields
      const currentPassword = currentPasswordInput.value.trim();
      const newPassword = newPasswordInput.value.trim();
      const confirmPassword = confirmPasswordInput.value.trim();

      if (currentPassword === '' || newPassword === '' || confirmPassword === '') {
        displayErrorMessage('Vui lòng điền đầy đủ tất cả các trường.');
        return;
      }

      if (newPassword !== confirmPassword) {
        displayErrorMessage('Mật khẩu mới và mật khẩu xác nhận không khớp.');
        return;
      }

      // Send AJAX request to update the password
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'updatePassword.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);

          hidePasswordPopup();
          displaySuccessMessage();
          clearFormFields();
  
          if (response.success) {
            hidePasswordPopup();
            displaySuccessMessage(response.success);
            clearFormFields();
          } else {
            displayErrorMessage(response.error);
          }
        } else {
          displayErrorMessage('Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
      };
      xhr.send('currentPassword=' + encodeURIComponent(currentPassword) + '&newPassword=' + encodeURIComponent(newPassword));
    });

    // Function to display error message
    function displayErrorMessage(message) {
      passwordErrorMessage.textContent = message;
      passwordErrorMessage.style.display = 'block';
    }

    // Function to hide error message
    function hideErrorMessage() {
      passwordErrorMessage.style.display = 'none';
    }

    // Function to display success message
    function displaySuccessMessage() {
      alert("Mật khẩu đã được thay đổi thành công!"); // Use a modal or other UI element instead of alert if needed
    }

    // Function to hide the password change popup
    function hidePasswordPopup() {
      $('#change-password-modal').modal('hide');
    }

    // Function to clear form fields
    function clearFormFields() {
      currentPasswordInput.value = '';
      newPasswordInput.value = '';
      confirmPasswordInput.value = '';
    }
  </script>  
  
 
</body>

</html>
