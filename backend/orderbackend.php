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
       public function getTotalAgentInDashboard() {
        $result = mysqli_query($this->conn,"SELECT COUNT(agentID) FROM agent");
        return mysqli_fetch_assoc($result);
    }

    public function getTotalStockInDashboard() {
        $result = mysqli_query($this->conn,"SELECT COUNT(productID) FROM stock");
        return mysqli_fetch_assoc($result);
    }
    public function getTotalOrderInDashboard(){
        $result = mysqli_query($this->conn,"SELECT COUNT(orderID) FROM orderstock");
        return mysqli_fetch_assoc($result);
    }

       public function getOrder(){
        $query = "SELECT *, p.productID, p.productName, a.firstname, a.lastname
        FROM agent a, stock p, orderstock o
        WHERE o.productID = p.productID AND o.agentID = a.agentID";

            $result = mysqli_query($this->conn,$query);
            return  $result; 
       }

       public function updateOrder($orderID, $agentID){
         $queryOrder = "UPDATE orderstock SET shippingStatus = 'Ship' WHERE orderID = '$orderID'";
         $orderResult = mysqli_query($this->conn, $queryOrder);

         $queryAgent = "UPDATE agent SET commision = commision + 5.00 WHERE agentID = '$agentID'";
         $agentResult = mysqli_query($this->conn, $queryAgent);

            // Check if both queries were successful and return the appropriate result
            if ($orderResult && $agentResult) {
                return true; // Success
            } else {
                return false; // Failure
            }
       }
     }
?>