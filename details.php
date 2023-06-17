<?php
   
   include('../dropship-project/backend/Agent.php');
  
   $display = new Agent();
   $displayHero = new Agent();
   $getAgentID = new Agent();

  if(isset($_GET["productID"])){
    $data = $display->displayDetails($_GET["productID"]);
    $row = mysqli_num_rows($data);
  }

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
    <link rel="stylesheet" href="assets/dropship.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Dropship</title>
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
                        <a class="nav-link active" href="stock.php">Stock</a>
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

    <br><br>
    <!--MAIN SECTION -->
    <div class="container container-detail">
    <?php 
        while($detail = mysqli_fetch_assoc($data)){

        ?>
        <div class="row">
      
            <div class="col-sm-5">
                <img class="img-responsive" src="<?php echo SITEURL;?>/images/<?php echo $detail['imageStock'];?>" width="100%"alt="">
            </div>
            <div class="col-sm-7">
                <p class="title"> Product:</p>
                <h1><?php echo $detail['productName'];?></h1>
                <p class="title"> Price per piece:</p>
                <h3>RM <?php echo $detail['price'];?></h3>
                <p class="title">Description:</p>
                <p class="description"><?php echo $detail['description'];?></p>
                <p class="title">Stock Available:</p>
                <h3><?php echo $detail['totalStock'];?></h3>
            </div>
       
        </div>
        <?php
        }
            ?>
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