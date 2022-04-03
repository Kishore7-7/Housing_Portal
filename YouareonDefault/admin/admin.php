<?php 

require '../../service/AdminService.php';

// var_dump($_GET);

$userId = $_GET['user_id'];
// echo "userId = $userId";

$adminService = new AdminService();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // var_dump($_POST);
    $adminService->checkFeature($userId);

}

$subdivisionList = $adminService->fetchAllSubdivisions();
$subdivisionManagerRecordList = $adminService->fetchAllSubdivisionManagerRecords();
$buildingManagerRecordList = $adminService->fetchAllBuildingManagerRecords();
$apartmentOwnerRecordList = $adminService->fetchAllApartmentOwnerRecords();

$itrList = $adminService->fetchAllITRequests();
// var_dump($itrList);
// echo "POLO--------";
// var_dump($apartmentOwnerRecordList);
// var_dump($buildingManagerRecordList);
// var_dump($subdivisionList);

// foreach ($subdivisionList as $subdivision) {
//     echo "$subdivision->subdivision_id - $subdivision->subdivision_name";
// }

?>


<!DOCTYPE html>
<title> YouareonDefault </title>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <script src="https://kit.fontawesome.com/ece9692bda.js" crossorigin="anonymous"></script>
</head>

<body>

    <script src="admin.js"></script>

    <div>
        <div class="left-panel">

            <div class="logo-and-menu">
                <div id="logo" class="logo">
                    <h1>City View</h1>
                </div>

                <div class="menu-bar">
                    <a href="javascript:void(0);" id="menu-icon" onclick="menuFunction()">
                        <div class="menu-icon">
                            <i class="menu-size fas fa-bars"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div id="sidebar" class="sidebar">
                <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'add-subdivision')">Add Subdivision</button>
                <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'add-building')">Add Building</button>
                <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'reset-credentials')">Reset Credentials</button>

                <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'master-record-menu')">Master Record<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
                <div id="master-record-menu" class="master-record-menu">
                    <a href="#subdivision-manager-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'subdivision-manager-details')">Subdivision Manager Details</button></a>
                    <a href="#building-manager-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'building-manager-details')">Building Manager Details</button></a>
                    <a href="#apartment-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-details')">Apartment Owners Details</button></a>
                </div>

                <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'manage-it-requests')">IT
                    Requests</button>

                <!-- <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'contact-us-messages')">Contact Us Messages</button> -->

                <a href="../../index.php">
                    <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'sign-out')">Sign
                        out</button>
                </a>
                
            </div>
        </div>


        <div class="main-content">

            <div class="page-heading">
                <h1>Admin </h1>
            </div>
            
            <div id="reset-credentials" class="section-content">
                <div class="section-heading"><h1>Reset Credentials</h1></div>

                <div class="input-box">

                    <form method="post">
                        <table>
                            <tr>
                                <td><label for="user-id">User Id:</label></td>
                                <td><input type="text" id="user-id" name="user-id" class="" placeholder=""></td>
                            </tr>
                            <tr>
                                <td><label for="new-password">New Password:</label></td>
                                <td><input type="password" id="new-password" name="new-password" class="" placeholder=""></td>
                            </tr>
                            <tr>
                                <td><label for="confirm-password">Comfirm Password:</label></td>
                                <td><input type="password" id="confirm-password" name="confirm-password" class="" placeholder=""></td>
                            </tr>
                            
                        </table>
                        <button class="submit-button">Submit</button>

                    </form>
                    
                        
                       
                    
                </div>
            </div>

            <div id="add-subdivision" class="section-content">
                <div class="section-heading"><h1>Add Subdivision</h1></div>

                <div class="input-box">
                    <form method="POST">
                        <table>
                        <tr>
                            <td><label for="new-subdivision-name">New Subdivision Name:</label></td>
                            <td><input type="text" id="new-subdivision-name" name="new-subdivision-name" class="" placeholder=""></td>
                        </tr>
                        
                        </table>
                        <button class="submit-button">Submit</button>

                    </form>
                    
                </div>
            </div>

            <div id="add-building" class="section-content">
                <div class="section-heading"><h1>Add Building</h1></div>

                <div class="input-box">

                    <form method="post">
                        <table>
                        <tr>
                            <td><label for="subdivision-name">Select Subdivision Name:</label></td>
                            <td><select id="subdivision-name" name="subdivision-name" class="">
                                <optgroup label="Subdivision Names">
                                    <?php ?>
                                    <?php foreach ($subdivisionList as $subdivision): ?>
                                        <option value="<?= $subdivision->subdivision_id?>">
                                        <?= $subdivision->subdivision_name; ?> 
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="new-building-name">New Building Name:</label></td>
                            <td><input type="text" id="new-building-name" name="new-building-name" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="new-building-name">Enter Apartment Numbers:</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f1-a1">Floor 1 - Apartment 1:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f1-a1" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f1-a2">Floor 1 - Apartment 2:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f1-a2" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f1-a3">Floor 1 - Apartment 3:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f1-a3" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f1-a4">Floor 1 - Apartment 4:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f1-a4" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f2-a1">Floor 2 - Apartment 1:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f2-a1" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f2-a2">Floor 2 - Apartment 2:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f2-a2" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f2-a3">Floor 2 - Apartment 3:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f2-a3" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f2-a4">Floor 2 - Apartment 4:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f2-a4" class="" placeholder=""></td>
                        </tr>

                        <tr>
                            <td><label for="apt-num-f3-a1">Floor 3 - Apartment 1:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f3-a1" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f3-a2">Floor 3 - Apartment 2:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f3-a2" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f3-a3">Floor 3 - Apartment 3:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f3-a3" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f3-a4">Floor 3 - Apartment 4:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f3-a4" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f4-a1">Floor 4 - Apartment 1:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f4-a1" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f4-a2">Floor 4 - Apartment 2:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f4-a2" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f4-a3">Floor 4 - Apartment 3:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f4-a3" class="" placeholder=""></td>
                        </tr>
                        <tr>
                            <td><label for="apt-num-f4-a4">Floor 4 - Apartment 4:</label></td>
                            <td><input type="text" id="apartment-number" name="apt-num-f4-a4" class="" placeholder=""></td>
                        </tr>
                        
                    </table>
                    <button class="submit-button">Submit</button>
                    </form>
                    
                    
                </div>
            </div>

            <!-- Admin Apartment Owner Details -->

            <div id="apartment-details" class="section-content">
                <div class="section-heading"><h1>Apartment Details</h1></div>
                <h3>Apartment Owner List</h3>
                <div>

                    <div class="view-data-list">
                        <?php foreach($apartmentOwnerRecordList as $key => $value): ?>
                            <a href="#apartment-owner-detail-<?= htmlspecialchars($key); ?>">
                                <button class="apartment-owner-detail-tile" onclick="viewApartmentDetails(event, 'apartment-owner-detail-<?= htmlspecialchars($key); ?>')">
                                    Apartment Number: <?= $value->apartment_number; ?> <br />
                                    Building Name: <?= $value->building_name; ?>
                                </button>
                            </a>
                        <?php endforeach; ?> 
        
                    </div>

                    <div class="view-data">
                        <?php foreach($apartmentOwnerRecordList as $key => $value): ?>
                            <div id="apartment-owner-detail-<?= htmlspecialchars($key); ?>" class="apartment-owner-detail">
                                <div class="apartment-personal-details-table">
                                    <table>
                                        <tr><td>Building Name</td><td><?= $value->building_name; ?></td></tr>
                                        <tr><td>Apartment Number</td><td><?= $value->apartment_number; ?></td></tr>
                                        <tr><td>First Name</td><td><?= $value->first_name; ?></td></tr>
                                        <tr><td>Last Name</td><td><?= $value->last_name; ?></td></tr>
                                        <tr><td>Email Id</td><td><?= $value->email_id; ?></td></tr>
                                        <tr><td>Phone Number</td><td><?= $value->phone_number; ?></td></tr>
                                        <tr><td>Joining Date</td><td><?= $value->joining_datetime; ?></td></tr>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?> 

                    </div>
                </div>
            </div>

            <!-- Admin Building Manager Details -->

            <div id="building-manager-details" class="section-content">
                <div class="section-heading"><h1>Building Manager Details</h1></div>
                <h3>Building Manager List</h3>
                <div>

                    <div class="view-data-list">
                        <?php foreach($buildingManagerRecordList as $key => $value): ?>
                            <a href="#building-manager-detail-<?= htmlspecialchars($key); ?>">
                                <button class="apartment-owner-detail-tile" onclick="viewApartmentDetails(event, 'building-manager-detail-<?= htmlspecialchars($key); ?>')">
                                    <?= $value->first_name; ?> <br />
                                    Building Name: <?= $value->building_name; ?>
                                </button>
                            </a>
                        <?php endforeach; ?> 
        
                    </div>

                    <div class="view-data">
                        <?php foreach($buildingManagerRecordList as $key => $value): ?>
                            <div id="building-manager-detail-<?= htmlspecialchars($key); ?>" class="apartment-owner-detail">
                                <div class="apartment-personal-details-table">
                                    <table>
                                        <tr><td>Building Name</td><td><?= $value->building_name; ?></td></tr>
                                        <tr><td>First Name</td><td><?= $value->first_name; ?></td></tr>
                                        <tr><td>Last Name</td><td><?= $value->last_name; ?></td></tr>
                                        <tr><td>Email Id</td><td><?= $value->email_id; ?></td></tr>
                                        <tr><td>Phone Number</td><td><?= $value->phone_number; ?></td></tr>
                                        <tr><td>Joining Date</td><td><?= $value->joining_datetime; ?></td></tr>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <!-- Admin Subdivision Manager Details -->

            <div id="subdivision-manager-details" class="section-content">
                <div class="section-heading"><h1>Subdivision Manager Details</h1></div>
                <h3>Subdivision Manager List</h3>
                <div>

                    <div class="view-data-list">

                        <?php foreach($subdivisionManagerRecordList as $key => $value): ?>
                            <a href="#subdivision-manager-detail-<?= htmlspecialchars($key); ?>">
                                <button class="subdivision-manager-detail-tile" onclick="viewSubdivisionDetails(event, 'subdivision-manager-detail-<?= htmlspecialchars($key); ?>')">
                                    <?= $value->first_name; ?><br />
                                    Subdivision Name: <?= $value->subdivision_name; ?>
                                </button>
                            </a>
                        <?php endforeach; ?> 
                        
        
                    </div>

                    <div class="view-data">

                        <?php foreach($subdivisionManagerRecordList as $key => $value): ?>
                            <div id="subdivision-manager-detail-<?= htmlspecialchars($key); ?>" class="subdivision-manager-detail">
                            <div class="apartment-personal-details-table">
                                <table>
                                    <tr><td>Subdivision Name</td><td><?= $value->subdivision_name; ?></td></tr>
                                    <tr><td>First Name</td><td><?= $value->first_name; ?></td></tr>
                                    <tr><td>Last Name</td><td><?= $value->last_name; ?></td></tr>
                                    <tr><td>Email Id</td><td><?= $value->email_id; ?></td></tr>
                                    <tr><td>Phone Number</td><td><?= $value->phone_number; ?></td></tr>
                                    <tr><td>Joining Date</td><td><?= $value->joining_datetime; ?></td></tr>
                                </table>
                            </div>
                        </div>
                        <?php endforeach; ?> 

                    </div>
                </div>
            </div>

            <!-- Subdivision Manager View IT Requests -->

            <div id="manage-it-requests" class="section-content">
                <div class="section-heading">
                    <h1>IT Request</h1>
                </div>
                <h3>Manage IT Request</h3>
                <div>

                    <div class="it-request-list">
                        <?php foreach ($itrList as $key => $value): ?>
                            <a href='#it-<?= htmlspecialchars($key); ?>'>
                                <button class="it-request" onclick="viewItDetails(event, 'it-<?= htmlspecialchars($key); ?>')">
                                    IT Request ID: <?= $value->it_request_id; ?> <br />
                                    Date: <?= $value->message_datetime; ?> <br />
                                    Status: <?= $value->status; ?>
                                </button>
                            </a>
                        <?php endforeach ?>
                    </div>

                    <div class="display-it-request">

                        <?php foreach ($itrList as $key => $value): ?>
                            <div id="it-<?= htmlspecialchars($key); ?>" class="it-request-details">
                                <h3>Datetime</h3>
                                <p><?= $value->message_datetime; ?></p>
                                <h3>Message</h3>
                                <p><?= $value->message; ?></p>
                                <h3>Status</h3>
                                <p><?= $value->status; ?></p>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>

            </div>

            <!-- Contact Us Messages -->

            <div id="contact-us-messages" class="section-content">
                <div class="section-heading">
                    <h1>Contact Us Messages</h1>
                </div>
                <h3>View Contact Us Messages</h3>
                <div>

                    <div class="it-request-list">
                        <a href='#contact-us-message-1'>
                            <button class="contact-us" onclick="viewContactUsDetails(event, 'contact-us-message-1')">
                                Contact Us Message ID: 1 <br />
                                Date: 01/27/2021 
                            </button>
                        </a>
                        <a href='#contact-us-message-2'>
                            <button class="contact-us" onclick="viewContactUsDetails(event, 'contact-us-message-2')">
                                Contact Us Message ID: 2 <br />
                                Date: 02/09/2021 
                            </button>
                        </a>
                        <a href='#contact-us-message-3'>
                            <button class="contact-us" onclick="viewContactUsDetails(event, 'contact-us-message-3')">
                                Contact Us Message ID: 1 <br />
                                Date: 01/27/2021 
                            </button>
                        </a>
                    </div>

                    <div class="display-it-request">
                        <div id="contact-us-message-1" class="contact-us-details">
                            <table>
                                <tr><td>First Name:</td><td>Amlan</td></tr>
                                <tr><td>Last Name:</td><td>Alok</td></tr>
                                <tr><td>Email:</td><td>amlanalok@gmail.com</td></tr>
                                <tr><td>Phone Number:</td><td>1231231234</td></tr>
                                <tr><td>Message:</td><td>Can I get price details</td></tr>
                            </table>
                        </div>

                        <div id="contact-us-message-2" class="contact-us-details">
                            <table>
                                <tr><td>First Name:</td><td>Kishore</td></tr>
                                <tr><td>Last Name:</td><td>Vadla</td></tr>
                                <tr><td>Email:</td><td>kishore@gmail.com</td></tr>
                                <tr><td>Phone Number:</td><td>1231231234</td></tr>
                                <tr><td>Message:</td><td>Can I get price details</td></tr>
                            </table>
                        </div>

                        <div id="contact-us-message-3" class="contact-us-details">
                            <table>
                                <tr><td>First Name:</td><td>Rakshita</td></tr>
                                <tr><td>Last Name:</td><td>Khadabadi</td></tr>
                                <tr><td>Email:</td><td>rakshita@gmail.com</td></tr>
                                <tr><td>Phone Number:</td><td>1231231234</td></tr>
                                <tr><td>Message:</td><td>Can I get price details</td></tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>