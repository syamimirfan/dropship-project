<?php 
  include('../dropship-project/backend/Agent.php');

  $displayHero = new Agent();
  $getAgentID = new Agent();
 
  if(isset($_SESSION["agentID"])){
      $display = $displayHero->heroSelectedAgentById($_SESSION["agentID"]);
  } else {
    header("Location:".SITEURL."login.php");
  }
  $data = $getAgentID->getAgentID();
  $row = mysqli_num_rows($data);
  while($agent = mysqli_fetch_assoc($data)){
    $agentID = $agent['agentID'];
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
    <link rel="stylesheet" href="assets/dropship.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Dropship</title>
</head>

<body>

    <!-- NAVBAR SECTION -->
    <nav class="navbar navbar-expand-lg py-3 sticky-top navbar-light bg-white">
        <div class="container">
            <a class="logo navbar-brand" href="#">
                <img class="logo-pic" src="images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
     
                     <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stock.php">Stock</a>
                    </li>
  
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL;?>request.php?agentID=<?php echo $agentID;?>">Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agentLogout.php">Logout</a>
                    </li>
                </ul>
                <!-- <a href="login.html"><button class="btn ms-lg-3">Sign in</button></a> -->
            </div>
   
        </div>
    </nav>

    <!-- HERO SECTION -->
    <div class="hero vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h1 class="display-4 text-white">Welcome <?php echo $display["firstname"]; ?>  <?php echo $display["lastname"]; ?></h1>
                    <p class="text-white">
                        Drop shipping is a form of retail business wherein the seller accepts customer orders without keeping stock on hand. Instead, in a form of supply chain management, the seller transfers the orders and their shipment details to either the manufacturer,
                        a wholesaler, another retailer, or a fulfillment house, which then ships the goods directly to the customer. As such, the retailer is responsible for marketing and selling a product, but has little or no control over product quality,
                        storage, inventory management, or shipping
                    </p>
                    <a href="stock.php" class="btn">Manage Stock</a>

                </div>
            </div>
        </div>
    </div>

    <!-- SERVICES SECTION -->
    <section id="services">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 mx-auto text-center">
                    <h6 class="text">SERVICES</h6>
                    <h1>Our Services</h1>
                    <p>Drop shipping is a form of retail business wherein the seller accepts customer orders without keeping stock on hand. Instead, in a form of supply chain management, the seller transfers the orders and their shipment details to either
                        the manufacturer, a wholesaler, another retailer, or a fulfillment house, which then ships the goods directly to the customer. As such, the retailer is responsible for marketing and selling a product, but has little or no control
                        over product quality, storage, inventory management, or shipping</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="services card-effect">
                        <div class="iconbox">
                            <i class='bx bxs-message-dots'></i>
                        </div>
                        <h5 class="mt-4 mb-2">Request</h5>
                        <p>If the stock are not available, Agent can request the stock to administrator to restock the items.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="services card-effect">
                        <div class="iconbox">
                            <i class='bx bx-user-circle'></i>
                        </div>
                        <h5 class="mt-4 mb-2">Dropship</h5>
                        <p>Hello fellows agent, please check and classify all the stock carefully to avoid problems for our customers</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="services card-effect">
                        <div class="iconbox">
                            <i class='bx bx-user'></i>
                        </div>
                        <h5 class="mt-4 mb-2">Administrator</h5>
                        <p>Adminstrator is the headquaters that provide all stock in the system.We are trying our best to serve you a good services</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="services card-effect">
                        <div class="iconbox">
                            <i class='bx bxl-php'></i>
                        </div>
                        <h5 class="mt-4 mb-2">Developed</h5>
                        <p>We are using the bootstrap 5 with html and css for frontend and PHP language for backend.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="services card-effect">
                        <div class="iconbox">
                            <i class='bx bxs-color'></i>
                        </div>
                        <h5 class="mt-4 mb-2">Colors</h5>
                        <p>We have variety of colors for the hijab. Please check the stock following the information by customer receipts.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="services card-effect">
                        <div class="iconbox">
                            <i class='bx bx-cart'></i>
                        </div>
                        <h5 class="mt-4 mb-2">Customer</h5>
                        <p>Customer are always number 1. So, please check the stock to continue the cart for our customers, Thank you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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