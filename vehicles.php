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
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $total_name; ?></span>
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
                <h6 class="h2 text-white d-inline-block mb-0">Phương tiện</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Phương tiện</li>
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
                        <h3 class="mb-0">Quản lý phương tiện</h3>
                    </div>
                    <!-- Add report -->
                    <div class="row mr-sm-4 mt-3" style="margin-left: auto;">
                        <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRecordModal">
                            Thêm bản ghi
                        </button>
                        </div>
                    </div>
                    <div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="addRecordModalLabel">Thêm bản ghi mới</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form action="addVehicle.php" method="post">
                                <div class="form-group">
                                    <label for="vehicle_id">Nhập ID phương tiện:</label>
                                    <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" placeholder="Nhập ID phương tiện">
                                </div>
                                <div class="form-group">
                                    <label for="license_plate">Nhập biển số xe:</label>
                                    <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="Nhập biển số xe">
                                </div>
                                <div class="form-group">
                                    <label for="owner_name">Nhập tên chủ phương tiện:</label>
                                    <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Nhập tên chủ phương tiện">
                                </div>
                                <div class="form-group">
                                    <label for="registration_date">Ngày đăng ký phương tiện:</label>
                                    <input type="date" class="form-control" id="registration_date" name="registration_date">
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_type">Loại phương tiện:</label>
                                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Nhập Loại phương tiện">
                                </div>
                                <div class="form-group">
                                    <label for="color">Màu phương tiện:</label>
                                    <input type="text" class="form-control" id="color" name="color" placeholder="Nhập màu phương tiện">
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
              <!-- Light table -->
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <tr>
                      <th scope="col" class="sort" data-sort="id">STT</th>  
                      <th scope="col" class="sort" data-sort="number">Biển số xe</th>
                      <th scope="col" class="sort" data-sort="user">Chủ phương tiện</th>
                      <th scope="col" class="sort" data-sort="date">Ngày đăng ký</th>
                      <th scope="col" class="sort" data-sort="type">Loại phương tiện</th>
                      <th scope="col" class="sort" data-sort="color">Màu phương tiện</th>
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
                    $sql = "SELECT vehicle_id, license_plate, owner_name, registration_date, vehicle_type, color FROM vehicles";
                    $result = $conn->query($sql);

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["vehicle_id"] . "</td>";
                            echo "<td>" . $row["license_plate"] . "</td>";
                            echo "<td>" . $row["owner_name"] . "</td>";
                            echo "<td>" . $row["registration_date"] . "</td>";
                            echo "<td>" . $row["vehicle_type"] . "</td>";
                            echo "<td>" . $row["color"] . "</td>";

                            // Delete button with data-id attribute for identification
                            echo "<td><button class='btn btn-sm btn-success edit-vehicle' data-id='" . $row["vehicle_id"] . "'>Sửa</button>
                            <button class='btn btn-sm btn-danger delete-vehicle' data-id='" . $row["vehicle_id"] . "'>Xóa</button></td>";
                            echo "<tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Không tìm thấy dữ liệu vi phạm nào.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </table>
                <br>
                </div>
                <div class="modal fade" id="editVehicleModal" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editVehicleModalLabel">Sửa thông tin phương tiện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="editVehicleForm">
                          <input type="hidden" id="vehicleId" name="vehicleId">
                            <div class="form-group">
                                <label for="vehicle_idE">Nhập ID phương tiện:</label>
                                <input type="text" class="form-control" id="vehicle_idE" name="vehicle_idE" placeholder="Nhập ID phương tiện">
                            </div>
                            <div class="form-group">
                                <label for="license_plateE">Nhập biển số xe:</label>
                                <input type="text" class="form-control" id="license_plateE" name="license_plateE" placeholder="Nhập biển số xe">
                            </div>
                            <div class="form-group">
                                <label for="owner_nameE">Nhập tên chủ phương tiện:</label>
                                <input type="text" class="form-control" id="owner_nameE" name="owner_nameE" placeholder="Nhập tên chủ phương tiện">
                            </div>
                            <div class="form-group">
                                <label for="registration_dateE">Ngày đăng ký phương tiện:</label>
                                <input type="date" class="form-control" id="registration_dateE" name="registration_dateE">
                            </div>
                            <div class="form-group">
                                <label for="vehicle_typeE">Loại phương tiện:</label>
                                <input type="text" class="form-control" id="vehicle_typeE" name="vehicle_typeE" placeholder="Nhập Loại phương tiện">
                            </div>
                            <div class="form-group">
                                <label for="colorE">Màu phương tiện:</label>
                                <input type="text" class="form-control" id="colorE" name="colorE" placeholder="Nhập màu phương tiện">
                            </div>
                            <button type="submit" class="btn btn-primary">Sửa</button>
                          </input>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
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
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
  <script>
    $(document).ready(function() {
      // Edit button click event
      $('.edit-vehicle').click(function() {
        const vehicleId = $(this).data('id'); // Get ID from button's data-id attribute

        // Fetch data from the database using AJAX
        $.ajax({
          url: 'getVehicleData.php', // Replace with your actual URL
          method: 'POST',
          data: { vehicleId: vehicleId },
          success: function(response) {
            // Parse JSON response and populate modal fields
            const vehicleData = JSON.parse(response);
            $('#vehicle_idE').val(vehicleData.vehicle_id);
            $('#license_plateE').val(vehicleData.license_plate);
            $('#owner_nameE').val(vehicleData.owner_name);
            $('#registration_dateE').val(vehicleData.registration_date);
            $('#vehicle_typeE').val(vehicleData.vehicle_type);
            $('#colorE').val(vehicleData.color);
            
            console.log(vehicleData);

            // Show the edit modal
            $('#editVehicleModal').modal('show');
          }
        });
        $('#editVehicleForm').submit(function(event) {
          event.preventDefault(); // Prevent default form submission

          // Get edited data from the form fields
          const editedVehicleData = {
            vehicle_id: $('#vehicle_idE').val(),
            license_plate: $('#license_plateE').val(),
            owner_name: $('#owner_nameE').val(),
            registration_date: $('#registration_dateE').val(),
            vehicle_type: $('#vehicle_typeE').val(),
            color: $('#colorE').val()
          };

          // Send AJAX request to update data
          $.ajax({
            url: 'updateVehicleData.php', // Replace with your actual URL for update script
            method: 'POST',
            data: editedVehicleData,
            success: function(response) {
              console.log(response); // Handle success response (e.g., confirmation message)
              // Optionally, reload the table or update the modal content to reflect changes
              $('#editVehicleModal').modal('hide'); // Hide the modal after successful update
              window.location.href = "vehicles.php";
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.error("Error updating data:", textStatus, errorThrown);
              // Handle errors appropriately (e.g., display error message to the user)
            }
          });
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Add event listener for the "delete-violation" class buttons
      $('.delete-vehicle').click(function(e) {
        e.preventDefault();
        var vehicleId = $(this).data('id'); // Get report ID from data-id attribute
        // Confirmation prompt before deletion (optional)
        if (confirm("Bạn có chắc chắn muốn xóa bản ghi phương tiện này?")) {
          // AJAX request to delete record
          $.ajax({
            url: "deleteVehicle.php",
            method: "POST",
            data: {
              vehicleId: vehicleId
            },
            success: function() {
              alert("Bản ghi phương tiện đã được xóa thành công!");
              window.location.href = "vehicles.php";
            },
            error: function(xhr, status, error) {
              console.error("Error:", status, error);
              alert("An error occurred while deleting the record.");
            }
          });
        }
      });
    });
  </script>
</body>

</html>
