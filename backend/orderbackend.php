<?php
    include ('function.php');

    class Order extends Connection {
        public function getProductDetail($productID) {
            $query = "SELECT * FROM stock WHERE productID = '$productID'";
            $result = mysqli_query($this->conn, $query);
            return $result;
        }

        
      public function createOrder($productID,$agentID,$quantity,$customerName,$customerTelephoneNo, $customerAddress){
           // Insert order into orderstock table
          $insertQuery = "INSERT INTO orderstock(productID, agentID, quantity, customerName, customerTelephoneNo, customerAddress, shippingStatus) VALUES ('$productID', '$agentID', $quantity, '$customerName', '$customerTelephoneNo', '$customerAddress', 'Not Ship')";
          $insertResult = mysqli_query($this->conn, $insertQuery);

          // Update total stock in stock table by deducting the quantity
          $updateQuery = "UPDATE stock SET totalStock = totalStock - $quantity WHERE productID = '$productID'";
          $updateResult = mysqli_query($this->conn, $updateQuery);

          // Check if both queries were successful and return the appropriate result
          if ($insertResult && $updateResult) {
              return true; // Success
          } else {
              return false; // Failure
          }
      }
     }
?>