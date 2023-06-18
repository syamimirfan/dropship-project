   <?php 

     include ('function.php');

       class Agent extends Connection{

        public function heroSelectedAgentById($agentID){
            $result = mysqli_query($this->conn,"SELECT firstname,lastname FROM agent WHERE agentID = '$agentID'");
            return mysqli_fetch_assoc($result);
        }
    
       public function displayStock(){
           $query = "SELECT productID,imageStock,productName,price FROM stock WHERE totalStock != 0 AND productID is NOT NULL";
           $result = mysqli_query($this->conn,$query);
           return $result;
           
      }

      public function displayDetails($productID){
        $query = "SELECT productID,imageStock,productName,price,description,totalStock FROM stock WHERE  productID ='$productID'";
        $result = mysqli_query($this->conn,$query);
        return $result;
      }

      public function displaySearchStock($search){
         $query = "SELECT  productID,imageStock,productName,price FROM stock WHERE productName LIKE '$search' AND totalStock != 0";
         $result = mysqli_query($this->conn,$query);
         return $result;
      }

      public function getAgentID(){
        $query = "SELECT agentID FROM agent WHERE agentID IS NOT NULL";
        $result = mysqli_query($this->conn,$query);
        return $result;
      }

      public function getProductID(){
        $query = "SELECT productID FROM stock WHERE productID IS NOT NULL";
        $result = mysqli_query($this->conn,$query);
         return  $result; 
      }

 }
   ?>