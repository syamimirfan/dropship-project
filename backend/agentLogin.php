<?php 
   
   include('function.php');

   class Login extends Connection {
    var $agentID; // Define the property
    

    public function login($email, $password) {
        $result = mysqli_query($this->conn, "SELECT * FROM agent WHERE email = '$email'");
        $row = mysqli_fetch_assoc($result);
        
        if(mysqli_num_rows($result) > 0) {
            //compare the with encryption password
            if ($row && password_verify($password, $row['password'])) {
               // Login successful
                $this->agentID = $row["agentID"]; // Assign the value directly to $agentID
                return 1;
            } else {
                return 10; // Wrong password
            }
        } else {
            return 100; // Agent not registered
        }
    }

    public function agentID() {
        return $this->agentID;
    }
      
      
   }
   

?>