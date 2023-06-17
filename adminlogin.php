<?php 
   include ('../dropship-project/backend/Admin.php');
   
   $login = new Admin();

   if(isset($_POST["submit"])){
           $password = $login->getAdminPasswords($_POST["password"]);
            //get input captcha from user
            $confirmCaptcha = $_POST["confirmCaptcha"];

            if($_SESSION['CODE'] == $confirmCaptcha )  {
                
                if($_POST["password"] != ""){

                 if($_POST["password"] == "admin123"){
                     $_SESSION["password"] = "admin123";
                     header('Location: http://localhost/dropship-project/adminhome.php');
                     exit();
                 } else {
                     $msg = "Wrong Password!";
                     echo "<script type='text/javascript'>alert('$msg');</script>"; 
                 }
             }else {
                 $msg = "Please fill all information!";
                  echo "<script type='text/javascript'>alert('$msg');</script>"; 
             }

            }else {
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ceviche+One&family=Lobster&family=Open+Sans:wght@500&family=Pacifico&family=Poppins&family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/account.css">
    <title>Login page</title>
</head>

<body>

    <section class="login py-5 bg-light">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-5">
                    <img src="images/hijab1.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-lg-7 text-center py-5">
                    <h1 class="animate__animated animate__heartBeat animate__infinite"> Welcome Dear,Admin </h1>
                    <form action="" method="POST">
                        <br>
                        <br>
                        <br><br>
                        <div class="form-row">
                            <div class="offset-1 col-lg-10">
                                <input type="password" name="password" class="inp px-3" placeholder="Password">
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