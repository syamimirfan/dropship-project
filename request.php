<?php
   
   include('../dropship-project/backend/Agent.php');
   $displayHero = new Agent();
   $getRequest = new Agent();

   if(isset($_GET["agentID"]) && isset($_POST["submit"])){
    $result = $getRequest->getRequest($_POST["phoneNumber"],$_POST["address"],$_POST["stock"],$_GET["agentID"]);
    if($result) {
        echo "<script> alert('Request Stock Successful'); </script>";
    }
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
    <title>Request</title>
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
                        <a class="nav-link active" href="request.php">Request</a>
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
                <h1>Request Form</h1>
                <form action="" method="POST">
                    <div class="row">
                   
                        <div class="col-12">
                            <br>
                            <label for="phonenumber" class="form-label">Phone Number</label>
                            <input type="text"name="phoneNumber" id="phonenumber" class="form-control">
                        </div>
                        <div class="col-12">
                            <br>
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>


            </div>

            <div class="col-4">
                <h1>Products</h1>
                <ul class="list-group">
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Almond">
                        <label for="almond" class="form-label">Almond</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Bahulu">
                        <label for="bahulu" class="form-label">Bahulu</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Cornflake">
                        <label for="cornflakes" class="form-label">Cornflake</label>
                    </li>
                    <li class="list-group-product" >
                        <input type="radio" name="stock" value="Dahlia">
                        <label for="dahlia" class="form-label">Dahlia</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="French Rose">
                        <label for="dahlia" class="form-label">French Rose</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Makmur">
                        <label for="dahlia" class="form-label">Makmur</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Light Mocha">
                        <label for="dahlia" class="form-label">Light Mocha</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Mazola">
                        <label for="mazola" class="form-label">Mazola</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Mint Green">
                        <label for="mintgreen" class="form-label">Mint Green</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Navy Blue">
                        <label for="navyblue" class="form-label">Navy Blue</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Pastel Peach">
                        <label for="pastelpeach" class="form-label">Pastel Peach</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Pearl Grey">
                        <label for="pearlgrey" class="form-label">Pearl Grey</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Semperit">
                        <label for="semperit" class="form-label">Semperit</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Sky Blue">
                        <label for="skyblue" class="form-label">Sky Blue</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Soft Cream">
                        <label for="softcream" class="form-label">Soft Cream</label>
                    </li>
                    <li class="list-group-product">
                        <input type="radio" name="stock" value="Suji">
                        <label for="suji" class="form-label">Suji</label>
                    </li>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </ul>

            </div>

            </form>
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