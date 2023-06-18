<?php
   
   include('../dropship-project/backend/orderbackend.php');
   $productDetail = new Order();

   if(isset($_GET['productID'])){
    $data = $productDetail->getProductDetail($_GET["productID"]);
    $row = mysqli_num_rows($data);
   }


// Define the rate limit settings
$limit = 1; // Maximum number of requests allowed
$duration = 15; // Time period in 15 seconds

// Generate a unique identifier for the user or client
$identifier = $_SERVER['REMOTE_ADDR']; // Use IP address as the identifier, but you can use any suitable value

// Get the current timestamp
$timestamp = time();

// Check if the rate limit has been exceeded
if (isset($_GET['productID']) && isset($_GET['agentID']) && isset($_POST['submit'])) {
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
                    window.location.href = '" . SITEURL . "/stock.php';
                  </script>";
            exit; // Stop further execution
        }
    }

    // Proceed with the order creation
    $result = $productDetail->createOrder($_GET['productID'], $_GET['agentID'], $_POST['quantity'], $_POST['customerName'], $_POST['customerTelephoneNo'], $_POST['customerAddress']);
    if ($result) {
        echo "<script> 
                alert('Order Stock Successful'); 
                setTimeout(function() {
                    window.location.href = '" . SITEURL . "/stock.php';
                }); 
              </script>";
    } else {
        echo "<script> 
                alert('Order Stock Failed'); 
                setTimeout(function() {
                    window.location.href = '" . SITEURL . "/stock.php';
                }); 
              </script>";
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
    <link rel="stylesheet" href="assets/dropship.css?modified=20012009">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Order</title>
</head>

<body>

    <!-- NAVBAR SECTION -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-light bg-white">
        <div class="container">
            <a class="logo navbar-brand" href="dropshiphome.php">
                <img class="logo-pic" src="images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dropshiphome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dropshiphome.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dropshiphome.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agentLogout.php">Logout</a>
                    </li>
                </ul>
                <!-- <a href="login.html"><button class="btn ms-lg-3">Sign in</button></a> -->
            </div>
        </div>
    </nav>
    <br><br>
    <!-- MAIN SECTION -->
    <div class="container request">
        <div class="row">
            <div class="col-8">
                <?php 
                  while($detail = mysqli_fetch_assoc($data)){
                ?>
                <h1>Order Form</h1>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <label for="productID" class="form-label">Product ID</label>
                            <h2 style="color: rgb(125, 32, 32);"><?php echo $detail['productID'];?></h2>
                        </div>
                        <div class="col-12">
                            <br>
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number"name="quantity" id="quantity"  class="form-control">
                        </div>
                        <div class="col-12">
                            <br>
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text"name="customerName" id="customerName" class="form-control">
                        </div>
                        <div class="col-12">
                            <br>
                            <label for="customerTelephoneNo" class="form-label">Customer Phone Number</label>
                            <input type="text"name="customerTelephoneNo" id="customerTelephoneNo" class="form-control">
                        </div>
                        <div class="col-12">
                            <br>
                            <label for="customerAddress" class="form-label">Customer Address</label>
                            <textarea name="customerAddress" id="customerAddress" class="form-control" cols="30" rows="10"></textarea>
                            
                        </div>
                    </div>
            </div>

                    <div class="offset-1 col-lg-10">
                            <button type="submit" name="submit" class="btn1">Submit</button>
                    </div>     
            </div>

            </form>
            <?php
             }
            ?>
        </div>
    </div>

    <br><br>
    <!-- ABOUT SECTION -->
    <footer id="about">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-md-4">
                        <h1 class="logo text-white">ElHaurah.MY</h1>
                        <h6 class="reserved">© Elhaurah All rights reserved</h6>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-white">Contact Us</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">019-4078581</a></li>
                            <li><a href="#">syamimirfan59@gmail.com</a></li>
                            <li>
                                <a href="">No 2090 Taman Ceria, Kuala Lumpur</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-white">Support</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">Terms $ Condition</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li>
                                <a href="#">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>