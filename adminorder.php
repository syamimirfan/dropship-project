<?php
  
   include('../dropship-project/backend/orderbackend.php');
   $display = new Order();
   $display2 = new Order();
   $display3 = new Order();
   $order = new Order();
 
   $totalAgent = $display->getTotalAgentInDashboard();
   $totalStock = $display2->getTotalStockInDashboard();
   $totalOrder = $display2->getTotalOrderInDashboard();


   if(isset($_POST['updateorder'])){
      $result = $order->updateOrder($_POST["orderID"],$_POST["agentID"]);
      if($result){      
            echo "<script> 
            alert('Shipping Successful'); 
       
        </script>";
      }else {
        echo "<script> 
        alert('Shipping Failed'); 
        setTimeout(function() {
            window.location.href = '" . SITEURL . "/adminorder.php';
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
    <link rel="stylesheet" href="assets/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Request</title>
</head>

<body>

<!-- SIDEBAR SECTION -->
<div class="d-flex" id="wrapper">
<div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <img class="logo-pic"src="./images/logo.png" alt="logo.png">
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="adminhome.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="admindropship.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-user me-2"></i>Dropship</a>
                <a href="adminproduct.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Product</a>
                <a href="adminorder.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
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
                                     foreach($totalOrder as $row){
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
                    <h3 class="fs-4 mb-3">Recent Order</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                        
                                    <th scope="col">Dropship Name</th>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Phone Number</th>
                                    <th scope="col">Customer Address</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                        $totalOrder = $order->getOrder();
                        if ($totalOrder) {
                            foreach ($totalOrder as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['productID']; ?></td>
                                    <td><?php echo $row['productName']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['customerName']; ?></td>
                                    <td><?php echo $row['customerTelephoneNo']; ?></td>
                                    <td><?php echo $row['customerAddress']; ?></td>
                                    <td>
                                        <?php if ($row['shippingStatus'] != 'Ship') { ?>
                                            <form action="" method="POST">
                                                <input type="hidden" name="orderID" value="<?= $row['orderID']; ?>">
                                                <input type="hidden" name="agentID" value="<?= $row['agentID']; ?>">
                                                <button class="restock-btn" name="updateorder" type="submit">Shipping</button>
                                            </form>
                                        <?php } else { ?>
                                           <h3 class="text-success fw-bold">Shipped</h3>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                            </tbody>
                        </table>
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