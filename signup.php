<?php 
   include ('../dropship-project/backend/agentRegister.php');

   if(isset($_SESSION["agentID"])){
    header("Location:".SITEURL."/dropshiphome.php");
  }

   $register = new Register();

   if(isset($_POST["submit"])){
      $result  = $register->registration($_POST["agentID"], $_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);

      if($result == 1){
        echo "<script> 
        alert('Registration Successful');
        window.location.href = 'login.php';
        </script>"; 
      } else if ($result == 10){
        echo "<script> alert('Agent ID or Email Has Already Taken!'); </script>";
     
      }
   }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ceviche+One&family=Lobster&family=Open+Sans:wght@500&family=Pacifico&family=Poppins&family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/account.css">
    <title>Register page</title>
</head>

<body>

    <section class="login py-5 bg-light">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-5">
                    <img src="images/hijab1.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-lg-7 text-center py-5">
                    <h1 class="animate__animated animate__heartBeat animate__infinite"> Register </h1>
                    <form action="" method="POST">
                        <div class="form-row py-3 pt-5">
                            <div class="offset-1 col-lg-10">
                                <input type="text" name="agentID" class="inp px-3" placeholder="AgentID" required>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="">
                                <input type="text" name="firstname" class="inp-name px-3" placeholder="First Name" required>
                                <input type="text" name="lastname" class="inp-name px-3" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-row py-3 pt-5">
                            <div class="offset-1 col-lg-10">
                                <input type="email" name="email" class="inp px-3" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="offset-1 col-lg-10">
                                <input type="password" name="password" class="inp px-3" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="offset-1 col-lg-10">
                                <button type="submit" name="submit" class="btn2">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>