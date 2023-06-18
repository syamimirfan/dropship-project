<?php
   include('../dropship-project/backend/Admin.php');

   $display = new Admin();
   $display2 = new Admin();
   $display3 = new Admin();
   $create = new Admin();

   $totalAgent = $display->getTotalAgentInDashboard();
   $totalStock = $display2->getTotalStockInDashboard();
   $totalOrder = $display2->getTotalOrderInDashboard();

// Define the rate limit settings
$limit = 1; // Maximum number of requests allowed
$duration = 15; // Time period in 15 seconds

// Generate a unique identifier for the user or client
$identifier = $_SERVER['REMOTE_ADDR']; // Use IP address as the identifier, but you can use any suitable value

// Get the current timestamp
$timestamp = time();

// Check if the rate limit has been exceeded
if (isset($_POST['submit'])) {
    // Check if the rate limit data is stored in the session
    if (!isset($_SESSION['rate_limit'][$identifier])) {
        // Initialize the rate limit data if it doesn't exist
        $_SESSION['rate_limit'][$identifier] = [
            'requests' => 1,
            'timestamp' => $timestamp
        ];
    } else {
        // Retrieve the rate limit data from the session
        $rateLimitData = $_SESSION['rate_limit'][$identifier];

        // Check if the time duration has elapsed
        if (($timestamp - $rateLimitData['timestamp']) > $duration) {
            // Reset the rate limit data
            $rateLimitData['requests'] = 1;
            $rateLimitData['timestamp'] = $timestamp;
        } else {
            // Increment the number of requests
            $rateLimitData['requests']++;
        }

        // Store the updated rate limit data in the session
        $_SESSION['rate_limit'][$identifier] = $rateLimitData;

        // Check if the rate limit has been exceeded
        if ($rateLimitData['requests'] > $limit) {
            // Rate limit exceeded, show an error message or take appropriate action
            echo "<script> 
                    alert('Rate limit exceeded. Please try again later.'); 
                    window.location.href = '" . SITEURL . "/adminhome.php';
                  </script>";
            exit; // Stop further execution
        }
    }

    // Proceed with the stock creation
    $create->productID = str_replace("'", "''", $_POST['productID']);
    $create->productName = str_replace("'", "''", $_POST['productName']);
    $create->price = str_replace("'", "''", $_POST['price']);
    $create->totalStock = str_replace("'", "''", $_POST['totalStock']);
    $create->description = str_replace("'", "''", $_POST['description']);

    // Check if an image was uploaded
    if (isset($_FILES['image']['name'])) {
        $create->image = str_replace("'", "''", $_FILES['image']['name']);
        $create->createStock();
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Create Product</title>
</head>

<body>
    <!-- SIDEBAR SECTION -->
<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <img class="logo-pic"src="./images/logo.png" alt="logo.png">
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="adminhome.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="admindropship.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-user me-2"></i>Dropship</a>
                <a href="adminproduct.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Product</a>
                <a href="adminorder.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-paperclip me-2"></i>Order</a>
                <a href="agentLogout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
              <!-- Page Content -->
              <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            
            </nav>

            <div class="container-fluid px-10">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <?php
                                  if($totalAgent){
                                      foreach($totalAgent as $row) {
                                        ?>
                                            <h3 class="fs-2"><?php echo $row;?></h3>
                                        <?php
                                      }
                                  }
                                ?>
                            
                                <p class="fs-5">Dropship</p>
                            </div>
                            <i class="fas fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                  if($totalStock){
                                      foreach($totalStock as $row) {
                                       ?>
                                       <h3 class="fs-2"><?php echo $row;?></h3>
                                       <?php
                                      }
                                  }
                                ?>
                                <p class="fs-5">Product</p>
                            </div>
                            <i
                                class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                  if($totalOrder){
                                      foreach($totalOrder as $row) {
                                       ?>
                                       <h3 class="fs-2"><?php echo $row;?></h3>
                                       <?php
                                      }
                                  }
                                ?>
                                <p class="fs-5">Order</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                   
                </div>

                <div class="row my-5">
                    <h1 class="text-center fw-bold">Product Form</h1>
                    <div class="col">
                            <!-- MAIN SECTION -->
    <div class="container request">
        <div class="row">
            <div class="col-12">
      
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label for="productID" name="productID" class="form-label fw-bold mt-3">Product ID</label>
                            <input type="text" id="productID" name="productID" placeholder="Product ID" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="productname" class="form-label fw-bold mt-3">Product Name</label>
                            <input type="text" name="productName" id="productName" placeholder="Product Name" name="productname" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="price" class="form-label fw-bold mt-3">Price (RM)</label>
                            <input type="number" id="price" name="price" placeholder="Price" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="stock" class="form-label fw-bold mt-3">Total of Stock</label>
                            <input type="number" id="stock" name="totalStock" class="form-control" placeholder="Total of Stock" required>
                        </div>

                        <div class="col-6">
                            <br>
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea name="description"  cols="156" rows="5" placeholder="Description of Hijab" required></textarea>
                        </div>
                        <div class="col-12">
                            <br>
                            <label for="image" class="form-label fw-bold">Select Image</label>
                            <input type="file" name="image" class="form-control"  placeholder="Place a picture" required>
                        </div>
                    </div>


            </div>
 
            </div>
            <br>
            <button type="submit" name="submit" class="btn ml-5">Submit</button>
            </form>
        </div>
    </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>

</body>

</html>