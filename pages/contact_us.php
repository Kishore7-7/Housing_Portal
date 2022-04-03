<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    $from = 'cityview@gmail.com';
    $to = $_POST['email'];
    $subject = 'Greetings from City View';
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $phnumber = $_POST['phone'];
    $query= $_POST['message'];
    $message ='First-Name:'.$fname."\n".'Last-Name:'.$lname."\n".'Email:'.$email."\n".'Phone-No:'.$phnumber."\n".'Your-Query was:'.$query."\n";
    $headers = 'From:'.$from;
    mail($to,$subject,$message,$headers);
    // echo 'We received your Query, We will contact you soon!';
}

?>


<!DOCTYPE html>
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
    <div class="topnav">
        City View
        <a href="./login.php">Login</a>
        <a class="active" href="./sign-up.php">SignUp</a>
        <a href="#">Contact Us</a>
        <a href="/blog">Forum</a>
        <a href="./about.php">About Us</a>
        <a href="../index.php">Home</a>
    </div>
    <div class="container">
        <div id="parent">
            <!-- Google Maps intergration - Google Maps Doc -->
            <div id="wide"><iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3221.3877854202906!2d-86.76808318472808!3d36.157117080086095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88646643d5762eaf%3A0x4b548ca08c2b8333!2sCity%20View!5e0!3m2!1sen!2sus!4v1615056070873!5m2!1sen!2sus"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
            <div id="narrow">
                <div style="color: 4F4846;"> <br>
                    <span>500 Rolling Mill Hill Rd<br>Nashville, TN 37210 </span><br><br>
                    <span class="normal" id="ole_phone_number">
                        <a href="tel: (833) 759-2754" class="click_to_call_href sclick_to_call_href_contactus">
                            <span class="click_to_call" style="color: 4F4846;">
                                +1 (833) 759-2754
                            </span> <br><br>
                            <span style="color: 4F4846;">cityviewatnashville@gmail.com</span>
                        </a>
                    </span> <br> <br>
                    <dl class="dl-horizontal" id="ole_office_hours">
                        <dt>Monday</dt>
                        <dd>8:30AM-5PM</dd>
                        <dt>Tuesday</dt>
                        <dd>8:30AM-5PM</dd>
                        <dt>Wednesday</dt>
                        <dd>8:30AM-5PM</dd>
                        <dt>Thursday</dt>
                        <dd>8:30AM-5PM</dd>
                        <dt>Friday</dt>
                        <dd>8:30AM-5PM</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="contact_container">
            <h2>Contact Us</h2> <br>
            <form style="background-color: #f2f2f2;" class="ContactUsForm" method="POST">
                <label for="fname"></label>
                <input type="text" class="contact-us" id="fname" name="firstname" required placeholder="First Name">

                <label for="lname"></label>
                <input type="text" class="contact-us" id="lname" name="lastname" required placeholder="Last Name">

                <label for="email"></label>
                <input type="email" id="email" name="email" value="" required placeholder="Email"> <br><br>

                <label for="phone"></label>
                <input type="text" class="contact-us" id="phone" name="phone" required placeholder="Phone Number">

                <label for="message"></label>
                <textarea id="message" class="contact-us" name="message" required
                    placeholder="Enter your message/query here" style="height:200px"></textarea>
                <div class="SignUpFormButtons" style="text-align: center;">
                    <button id="btnSubmit" class="login-button" value="Submit" onclick="showAlert()">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <script>
    </script>
    <footer>
        <p align="center" class="footer">
            <span style="float: left;">All Rights Reserved</span>
            <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;
            <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
            <a href="https://youtube.com"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;
            <span style="float: right;">www.cityview.com</span>
        </p>
    </footer>
    <script src="contact-us.js"></script>
</body>

</html>