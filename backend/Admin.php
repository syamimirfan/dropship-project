<?php 
    include ('function.php');

    class Admin extends Connection {
     
        //in Stock class
        var $productID;
        var $productName;
        var $price;
        var $totalStock;
        var $description;
        var $image;
        
         
        public function getAgentInDashboard() {
             
            $agent = "SELECT * FROM agent";
            $result = $this->conn->query($agent);
            if($result->num_rows >0){
                return  $result;
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


        public function deleteAgent($agentId){
            $sql = mysqli_query($this->conn,"DELETE FROM agent WHERE agentID = '$agentId'");
  
            if($sql) {
                return true;
            }
            else{
                return false;
            }
        }
        
        // $productID, $productName,$price, $totalStock, $description, $image
    public function createStock(){
   
        $tempname = $_FILES['image']['tmp_name'];
        $originalname = $_FILES['image']['name'];
        $size = ($_FILES['image']['size'] / 5242888) . "MB<br>";
        $type = $_FILES['image']['type'];

        // Specify the destination folder path
        $destinationFolder = "../dropship-project/stock/"; // Modify this path as needed

        move_uploaded_file($tempname, $destinationFolder . $this->image);
    


        $query = "INSERT INTO stock (productID,productName,price,totalStock,description,imageStock) VALUES ('$this->productID', '$this->productName', 
                 '$this->price', '$this->totalStock', '$this->description','$this->image')";

        if(mysqli_query($this->conn,$query)) {
            echo "<script> 
            alert('Create Stock Successful');
            setTimeout(function() {
                window.location.href = '" . SITEURL . "/adminhome.php';
            }); 
          </script>";
      
        }
        
    } 

    public function updateStock(){
           $query = "UPDATE stock SET totalStock = '$this->totalStock' WHERE productID = '$this->productID'";
           
           if(mysqli_query($this->conn,$query)){
         
             header('Location:'.SITEURL.'adminproduct.php');
             echo "<script> alert('Update Stock Successful'); </script>";
           }
    }
public function deleteStock($productID)
{
    // Get the image filename from the database
    $query = "SELECT imageStock FROM stock WHERE productID = '$productID' LIMIT 1";
    $result = mysqli_query($this->conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imageFilename = $row['imageStock'];

        // Delete the image file from the folder
        $imagePath = "../dropship-project/stock/" . $imageFilename;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the stock record from the database
    $deleteQuery = "DELETE FROM stock WHERE productID = '$productID' LIMIT 1";

    if (mysqli_query($this->conn, $deleteQuery)) {
        return true;
    } else {
        return false;
    }
}

    public function getStock(){
        $query = "SELECT * FROM stock";
        $result = mysqli_query($this->conn,$query);
         return  $result; 
    }

    public function getStockInformation($productID){
        $query = "SELECT * FROM stock WHERE productID = '$productID'";
        $result = mysqli_query($this->conn,$query);
         return  $result; 
    }


  public function getRequest(){
      $query = "SELECT requestID, CONCAT(firstname,' ',lastname) AS name, email,phoneNumber, address, stockRequest FROM request r, agent a
                WHERE  r.agentID = a.agentID";
      $result = mysqli_query($this->conn,$query);
      return  $result;
  }

  public function deleteRequest($requestID){
      $query = "DELETE FROM request WHERE requestID = '$requestID'";
      
      if(mysqli_query($this->conn,$query)){
        return true;
    }else {
        return false;
    }
  }

   public function getAdminPasswords($password){
       $password = "admin123";
       return $password;
   }
    
}  

?>