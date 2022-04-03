<?php

require '../service/LoginService.php';
$abc = 'abc';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // echo "abcederfadf";
    // var_dump($_POST);
    $abc = 'abc';
    $emailId = $_POST['email'];
    $password = md5($_POST['password']);
    // echo "email = $emailId";
    // echo "password = $password";

    $loginService = new LoginService();
    $loginService->loginUser($emailId, $password);

    
}


?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../static/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- <script src="login.js"></script> -->
    <div class="topnav">
        City View
        <a href="./login.php">Login</a>
        <a class="active" href="./sign-up.php">SignUp</a>
        <a href="./contact_us.php">Contact Us</a>
        <a href="/blog">Forum</a>
        <a href="./about.php">About Us</a>
        <a href="../index.php">Home</a>
    </div>
    <div class="container">
        <div class="contact_container">
            <h2 style="color:#4F4846;">Login</h2> <br>


            <div style="padding:100px 20px">

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="email"></label>
                    <input type="email" id="email" name="email" required placeholder="Email" > <br><br>
                    <label for="password"></label>
                    <input type="password" id="password" name="password" required placeholder="Password" > <br><br>
                    <div class="SignUpFormButtons" style="text-align: center;">
                        <button class="login-button">Login</button>
                    </div>

                </form>
                
            </div>

        </div>
    </div>
    <br><br><br><br>

    <script src="" async defer></script>
    <footer>
        <p align="center" class="footer">
            <span style="float: left;">All Rights Reserved</span>
            <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;
            <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
            <a href="https://youtube.com"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;
            <span style="float: right;">www.cityview.com</span>
        </p>
    </footer>
</body>

</html>