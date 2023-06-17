<?php
   include('../dropship-project/backend/Admin.php');

   $display = new Admin();
   $display2 = new Admin();
   $display3 = new Admin();
   $deleteStock = new Admin();
   
   $totalAgent = $display->getTotalAgentInDashboard();
   $totalStock = $display2->getTotalStockInDashboard();
   $totalRequest = $display2->getTotalRequestInDashboard();
  
   $data_image = $display->getStock();
   $row=mysqli_num_rows($data_image);
   
   if(isset($_POST["deleteStock"])){
    //   $deleteStock->productID = str_replace("'", "''", $_GET["productID"]);

      $result = $deleteStock->deleteStock($_POST["deleteStock"]);
      if($result){
          
        header('Location:'.SITEURL.'adminproduct.php');
        echo "<script> alert('Update Stock Successful'); </script>";
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
    <title>Product</title>
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
                <a href="adminproduct.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
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
                                 if($totalRequest){
                                     foreach($totalRequest as $row){
                                         ?>
                                          <h3 class="fs-2"><?php echo $row;?></h3>   
                                         <?php
                                     }
                                 }
                                ?>
                                <p class="fs-5">Request</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                   
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Product</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price per Piece</th>
                                    <th scope="col">Total of Stock</th>
                                    <th scope="col">Image Stock</th>
                        
                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  $stock = $display->getStock();
        
                                         while($data = mysqli_fetch_assoc($data_image)){
                                          ?>
                                    <tr>
                                    <td><?php echo $data['productID'];?></td>
                                    <td><?php echo $data['productName'];?></td>
                                    <td><?php echo $data['price'];?></td>
                                    <td><?php echo $data['totalStock'];?></td>
                                    <td><img src="<?php echo SITEURL; ?>/stock/<?php echo $data['imageStock'];?>" alt="" width="300px"></td>
                                    <td><form action="" method="POST">
                                    <button type="submit" name="" value="" class="update-btn"><a href="adminupdateproduct.php" class="text-white">UPDATE</a></button>
                                            <button type="submit" name="deleteStock" value="<?= $data['productID'];?>" class="delete-btn">DELETE</button>
                                        </form</td>
                                </tr>
                                          <?php
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