<?php
 
 include ('function.php');

  class Register extends Connection {
 
        public function registration($agentID, $firstname, $lastname, $email,$password){
            $duplicate = mysqli_query($this->conn,"SELECT  * FROM agent WHERE agentID = '$agentID' OR email = '$email'");

            //agentID or email has already been taken
            if(mysqli_num_rows($duplicate) > 0) {
                return 10;
            } else {
                //registration successful

                //to encrypt the password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $commision = 0.00;

                $query = "INSERT INTO agent VALUES('$agentID','$firstname','$lastname','$email','$hashedPassword', '$commision')";
                mysqli_query($this->conn,$query);
                return 1;
            }
        }
  }

?>