<?php 
 
 include('../dropship-project/backend/agentLogin.php');


  if(isset($_SESSION["agentID"])){
    header("Location:".SITEURL."dropshiphome.php");
  }

 $login = new Login();

 if(isset($_POST["submit"])){
    $result = $login->login($_POST["email"],$_POST["password"]);
   
    //get input captcha from user
    $confirmCaptcha = $_POST["confirmCaptcha"];

    //if captcha is not same with entered captcha
    if($_SESSION['CODE'] == $confirmCaptcha ) {
        if($_POST["email"] != "" && $_POST["password"] != "") {
            if($result == 1 ){
                $_SESSION["login"] = true;
                $_SESSION["agentID"] = $login->agentID();
                header("Location:".SITEURL."/dropshiphome.php");    
            }else if($result == 10) {
                echo "<script> alert('Wrong Email or Password!'); </script>";
            } else if($result == 100){
                echo "<script> alert('User Not Registered!'); </script>";
            }     
        }else {
            echo "<script> alert('Please enter email and password!'); </script>";
        }
    } else {
        echo "<script> alert('Incorrect Captcha!'); </script>";
    }
 }

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/account.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ceviche+One&family=Lobster&family=Open+Sans:wght@500&family=Pacifico&family=Poppins&family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Login page</title>
</head>

<body>

    <section class="login py-5 bg-light">
        <div class="container">
            <div class="row g-10">
                <div class="col-lg-5">
                    <img src="images/hijab1.jpg" alt="" class="img-fluid" style="height: 100%;">
                </div>
                <div class="col-lg-7 text-center py-3">
                    <h1 class="animate__animated animate__heartBeat animate__infinite"> Welcome Back </h1>
                    <form action="" method="POST">
                        <div class="form-row py-3 pt-5">
                            <div class="offset-1 col-lg-10">
                                <input type="text" name="email" class="inp px-3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="offset-1 col-lg-10">
                                <input type="password" name="password" class="inp px-3" placeholder="Password" >
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="offset-1 col-lg-10">
                            <img id="captchaImage" src="captcha.php" alt="captcha.jpeg" style="border-radius: 0;">                 

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="d-flex justify-content-center align-items-center m-3">
                              <p class="fw-bold fs-5">Type the word above</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="d-flex justify-content-center align-items-start">
                            <input type="text" name="confirmCaptcha" class="inp px-3 inp-captcha" style="height: 50px; width: 50%;" placeholder="Captcha" > 
                            <button id="reloadButton" onclick="reloadCaptcha();" type="button" class="border-0 bg-white px-3"><i class="bi bi-arrow-clockwise fs-1" style="color: rgb(190, 47, 47);"></i></button>     
                            </div>                                                                    
                        </div>
                        <div class="form-row">
                            <div class="offset-1 col-lg-10">
                                <button type="submit" name="submit" class="btn1">Sign In</button>
                            </div>
                        </div>
                    </form>

                    <p class="para">Don't have account? Click <a href="signup.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- to make the captcha reload -->
    <script>
        function reloadCaptcha() {
        var captchaImage = document.getElementById("captchaImage");
        captchaImage.src = "captcha.php?" + new Date().getTime();
     }
</script>

</body>

</html>