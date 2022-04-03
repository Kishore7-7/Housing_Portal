<?php 

require '../service/SignUpService.php';

$signUpService = new SignUpService();

$selectedRole = '';


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // var_dump($_POST);
    $result = $signUpService->storeSignUpInfo();
    if($result->message == 'Failed'){
        echo "Failed";
        var_dump($result);
    }
    else{

        ini_set('display_errors',1);
        error_reporting(E_ALL);
        $from = 'cityview@gmail.com';
        $to = $_POST['email'];
         
        $subject = 'Account Creation Confirmation from City View! (Confidential)';
         
        $fname = $_POST['first-name'];
        $lname = $_POST['last-name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $phnumber = $_POST['phone-number'];
        $rname = $_POST['rname'];
        $raddress1 = $_POST['raddress'];
        $rcountry = $_POST['rcountry'];
        $rphno = $_POST['rphno'];
         
        $message ='First-Name:'.$fname."\n".'Last-Name:'.$lname."\n".'Email:'.$email."\n".'Password: '.$password."\n".'Address:'.$address1."\n".''.$address2."\n".'City:'.$city."\n".'State:'.$state."\n".'Phone-Number:'.$phnumber."\n".'Responsible-Contact-Name:'.$rname."\n".'Responsible-Contact-Address:'.$raddress1."\n".'Responsible-Contact_country:'.$rcountry."\n".'Responsible-Contact-Phone-Number:'.$rphno."\n";
         
        $headers = 'From:'.$from;
        mail($to,$subject,$message,$headers);
        // echo 'sent successfully';

        header("Location: ../pages/login.php");
        // echo $result->message;
    }

}

$rolesList = $signUpService->fetchAllRoles();
$buildingsList = $signUpService->fetchAllBuildings();
$subdivisionsList = $signUpService->fetchAllSubdivisions();
$apartmentsList = $signUpService->fetchAllApartments();
// var_dump($rolesList);
// var_dump($buildingsList);
// var_dump($subdivisionsList);

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../static/style.css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    </head>
    <body>
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
            <h2 class="sign" align="center" style="color:#4F4846;">Sign up</h2> <br>
            <div >
                <!-- <form  class="ContactUsForm" action="mailto:user@yahoomail.com" method="POST"> -->
                <form  class="ContactUsForm" method="POST">    
                    <div>
                        <div>
                            <label for="fname"></label>
                            <input type="text"  id="fname" name="first-name" value=""  required placeholder= "First Name"> &nbsp
                            <label for="lname"></label>
                            <input type="text" id="lname" name="last-name" value=""  required placeholder= "Last Name"> <br><br>
                            <label for="email"></label>
                            <input type="email" id="email"  name="email" value=""  required placeholder= "Email"> <br><br>
                            <label for="password"></label>
                            <input type="password" id="password" name="password"  pattern="[A-Za-z0-9]{8,12}"  title="Password should be within 8-12 charaters" value="" required placeholder= "Password"> <br><br>
                            <label for="repassword"></label>
                            <input type="password" id="repassword" name="repassword"  pattern="[A-Za-z0-9]{8,12}"  title="Password should be within 8-12 charaters" value="" required placeholder= "Retype Password"> <br><br>
                        </div>
                        <div>
                            <label for="address1" style="color:#4F4846;">User's Address:</label> <br>
                            <input type="text" id="address1" name="address1"  value="" required placeholder= "Street 1"><br><br>
                            <label for="address2"></label>
                            <input type="text" id="address2" name="address2" value="" placeholder= "Street 2"><br><br>
                            <label for="city"></label>
                            <input type="text" id="city" name="city"  value="" required placeholder= "City"><br><br>
                            <label for="state"></label>
                            <input type="text" id="state" name="state"  value="" required placeholder= "State"> <br><br>
                            <label for="zip"> </label>
                            <input type="text" id="zip" name="zip"  value="" required placeholder= "Zip Code"> <br><br>
                            <label for="phno"> </label>
                            <label for="country"></label>
                            <input type="text" id="country" name="country"  required value="" placeholder= "Country"><br><br>
                            <input type="tel" id="phno" name="phone-number"  required value="" pattern="[0-9]{7,10}" title="Phone number must be between 7-10 numbers" placeholder= "Phone Number"><br><br>
                        </div>
                    </div>
                    
                    <div>

                        <label for="rname">Responsible Contact Details</label>
                        <input type="text" id="rname" name="rname" value=""  required placeholder= "Name"> <br><br>

                        <label for="raddress"></label> <br>
                        <input type="text" id="raddress" name="raddress" value=""  required placeholder= "Address"><br><br>
                        
                        <label for="rcity"></label>
                        <input type="text" id="rcity" name="rcity" value=""  required placeholder= "City"><br><br>
                        <label for="rcountry"></label>
                        <input type="text" id="rcountry" name="rcountry" value=""  required placeholder= "Country"><br><br>
                        
                        <label for="rzip"> </label>
                        <input type="text" id="rzip" name="rzip" value=""  required placeholder= "Zip Code"> <br><br>
                        <label for="rphno"> </label>
                        <input type="tel" id="rphno" name="rphno" value=""  required pattern="[0-9]{7,10}" title="Phone number must be between 7-10 numbers" placeholder= "Phone Number"> <br><br>
                    </div>
                    <div>
                        <!-- <label for="selection_type">What do you want to sign up for:</label>
                        <select name="selection_type"  id="selection_type">
                            <option value="1">Subdivision</option>
                            <option value="2">Building</option>
                            <option value="3">Apartment</option>
                            <option value="4">Services</option>
                            <option value="5">Self-Service Apartment</option>
                        </select><br><br> -->

                        <label for="role">Role:</label>
                        <select name="role"  id="role" onchange="getRoleDropdownValue()">
                            <?php foreach ($rolesList as $role): ?>
                                <option value="<?= htmlspecialchars($role->role_name); ?>"><?= htmlspecialchars($role->role_name); ?></option>
                            <?php endforeach; ?>    
                            
                        </select><br><br>

                        <label for="subdivision">Choose Subdivision:</label>
                        <select name="subdivision" id="subdivision" onchange="getSubdivisionDropdownValue()" onclick="getSubdivisionDropdownValue()">
                            <?php foreach ($subdivisionsList as $subdivision): ?>
                                <option value="<?= htmlspecialchars($subdivision->subdivision_id); ?>"><?= htmlspecialchars($subdivision->subdivision_name); ?></option>
                            <?php endforeach; ?>

                        </select>
                        <br><br>


                        <div id="building-dropdown" class="building-dropdown-list">
                            <label for="building">Choose Building:</label>
                            <select name="building" id="building" onchange="getBuildingDropdownValue()" onclick="getBuildingDropdownValue()">
                                <?php foreach ($buildingsList as $building): ?>

                                    <div>

                                        <option class="building-dropdown-option building-subdivision-<?= htmlspecialchars($building->subdivisions_subdivision_id); ?>" value="<?= htmlspecialchars($building->building_id); ?>"><?= htmlspecialchars($building->building_name); ?></option>
                                    </div>
                                    
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div id="apartment-dropdown" class="apartment-dropdown-list">
                            <label for="apartment">Choose Apartment:</label>

                            <select name="apartment" id="apartment">
                                <?php foreach ($apartmentsList as $apartment): ?>
                                    <div>
                                        <option class="apartment-dropdown-option apartment-building-<?= htmlspecialchars($apartment->buildings_building_id); ?>" value="<?= htmlspecialchars($apartment->apartment_id); ?>"><?= htmlspecialchars($apartment->apartment_number); ?></option>
                                    </div>
                                <?php endforeach; ?>
                            </select>
                            <br><br>

                            <p>Choose Service Provider for Utilities:</p><br>
                            <p>Electricity</p>
                            <input type="radio" name="electricity" value="subdivision services">
                            <label for="">Subdivision Services</label><br>
                            <input type="radio" name="electricity" value="self-service">
                            <label for="">Self-Service</label>

                            <br><br>

                            <p>Gas</p>
                            <input type="radio" name="gas" value="subdivision services">
                            <label for="">Subdivision Services</label><br>
                            <input type="radio" name="gas" value="self-service">
                            <label for="">Self-Service</label>

                            <br><br>

                            <p>Water</p>
                            <input type="radio" name="water" value="subdivision services">
                            <label for="">Subdivision Services</label><br>
                            <input type="radio" name="water" value="self-service">
                            <label for="">Self-Service</label>

                            <br><br>

                            <p>Internet is mandatory self-service </p>
                            <input type="radio" name="internet" value="self-service">
                            <label for="">Self-Service</label>

                        </div>
                        <br>
                        <br>


                        


                    </div>
                    <div class="SignUpFormButtons" style="text-align: center;">
                        <input id="btnSubmit" type="submit" value="Submit"> &nbsp;&nbsp;
                        <input type="reset">
                    </div>
                    
                </form>
            </div>
        </div>
        <footer>
            <p align="center" class="footer">
                <span style="float: left;">All Rights Reserved</span>
                <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a> &nbsp;&nbsp;
                <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>&nbsp;&nbsp;
                <a href="https://youtube.com"><i class="fab fa-youtube"></i></a>&nbsp;&nbsp;
                <span style="float: right;">www.cityview.com</span>
            </p>
        </footer>

        <script src="sign-up.js"></script>
    </body>
</html>