<?php
   
   include('../dropship-project/backend/Agent.php');
   
   $display = new Agent();
   $displayHero = new Agent();
   $getAgentID = new Agent();

   $data = $display->displayStock();
   $row = mysqli_num_rows($data);

   $data2 = $getAgentID->getAgentID();
   $row2 = mysqli_num_rows($data2);
   while($agent = mysqli_fetch_assoc($data2)){
     $agentID = $agent['agentID'];
   }

   if(isset($_SESSION["agentID"])){
    $display = $displayHero->heroSelectedAgentById($_SESSION["agentID"]);
} else {
  header("Location:".SITEURL."login.php");
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/dropship.css">
    <title>Stock</title>
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
                        <a class="nav-link " href="dropshiphome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dropshiphome.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dropshiphome.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Stock</a>
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


    <!-- LIST SECTION -->
    <div id="hot">
        <div class="box">
            <div class="container">
                <div class="col-md-12">
                    <h1>List Of Hijab</h1>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <!-- SEARCH BOX SECTION -->

    <div class="search_box">
        <form action="<?php echo SITEURL;?>hijabsearch.php" method="POST">
            <input type="search" name="search" class="input" placeholder="Search Hijab" required>
            <input type="submit" name="submit" value="Go" class="btn btn-primary">
        </form>
    </div>

    <br><br><br>
    <div id="content" class="container">
        <div class="row">
        <?php 
        while($stock = mysqli_fetch_assoc($data)){
        $productID = $stock['productID'];
        ?>
            <div class="col-sm-2 col-sm-4 single">
                <div class="product">
                    <div class="text">
                    <img class="img-responsive" src="<?php echo SITEURL;?>/images/<?php echo $stock['imageStock'];?>" alt="">
                        <h3><?php echo $stock['productName'];?></h3>

                        <p class="price">RM <?php echo $stock['price'];?></p>

                        <a href="<?php echo SITEURL;?>details.php?productID=<?php echo $productID;?>">
                            <button class="product-details">
                                Product Details
                              </button>
                        </a>
                    </div>         
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

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