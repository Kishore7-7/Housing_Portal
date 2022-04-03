<?php

include __DIR__ . '../../../service/UserService.php';
include __DIR__ . '../../../service/BuildingService.php';
include_once __DIR__ . '../../../utility/Database.php';


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userId = $_GET['user_id'];
    $dbObject = new Database();
    $dbConn = $dbObject->getDatabaseConnection();
    $userService = new UserService();
    $user = $userService->getuserById($userId);
    $buildingService = new BuildingService();
    $apartments = $buildingService->getApartmentsUnderBm($userId);
}

?>


<!DOCTYPE html>
<title> YouareonDefault </title>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <script src="https://kit.fontawesome.com/ece9692bda.js" crossorigin="anonymous"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <style>
        .logo-and-menu{
            display: flex;
        }
    </style>
</head>

<body>

    <script src="./building-manager-page.js"></script>

    <div>
        <div class="left-panel">

            <div class="logo-and-menu">
                <div class="menu-bar">
                    <a href="javascript:void(0);" id="menu-icon" onclick="menuFunction()">
                        <div class="menu-icon">
                            <i class="menu-size fas fa-bars"></i>
                        </div>
                    </a>
                </div>
                <div id="logo" class="logo">
                    <h1>&nbsp; &nbsp; City View <?php $userId ?></h1>
                </div>
               
            </div>

            <div id="sidebar" class="sidebar">
                <button class="sidebar-menu-option sidebar-option text-left opacity active" onclick="myFunction(event, 'personal-details')">Personal Details</button>

                <button class="sidebar-menu-option sidebar-option text-left opacity" onclick="openMenu(event, 'apartment-dashboard-menu')">Dashboard<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
                <div id="apartment-dashboard-menu" class="apartment-dashboard-menu">
                    <!-- <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-home')">Home</button> -->
                    <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-electricity-bill')">Electricity Bill</button>
                    <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-water-bill')">Water Bill</button>
                    <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-gas-bill')">Gas Bill</button>
                    <!-- <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-maintenance-requests')">Maintenance Requests</button>
                    <button class="sidebar-option text-left opacity" onclick="myFunction(event, 'dashboard-complaints')">Complaints</button> -->
                </div>

                <a href="#apartment-details"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-details')">Apartment Details</button></a>

                <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'building-report-menu')">Reports<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
                <div id="building-report-menu" class="building-report-menu">
                    <a href="#utility-bill-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'utility-bill-report')">Utility Bill Report</button></a>
                    <a href="#community-service-bill-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'community-service-bill-report')">Community Service Bill Report</button></a>
                    <a href="#maintenance-request-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'maintenance-request-report')">Maintenance Request Report</button></a>
                    <a href="#complaint-report"><button class="sidebar-option text-left opacity" onclick="myFunction(event, 'complaint-report')">Complaint Report</button></a>
                </div>

                <button class="sidebar-menu-option text-left opacity" onclick="openMenu(event, 'building-manager-chat-menu')">Chat<div class="dropdown-icon"><i class="fas fa-caret-down"></i></div></button>
                <div id="building-manager-chat-menu" class="building-manager-chat-menu">
                    <a href="#apartment-owner-chat"><button class="building-manager-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'apartment-owner-chat')">Apartment Owner</button></a>
                    <a href="#subdivision-manager-chat"><button class="building-manager-chat-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'subdivision-manager-chat')">Subdivision Manager</button></a>
                </div>

                <a href="#manage-maintenance-requests"><button class="apartment-maintenance-request-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'manage-maintenance-requests')">View Maintenance Requests</button></a>

                <a href="#manage-complaints"><button class="sidebar-menu-option sidebar-option text-left opacity" onclick="myFunction(event, 'manage-complaints')">View Complaints</button></a>

                <a href="../../index.php">
                    <button class="admin-option text-left opacity" onclick="myFunction(event, 'sign-out')">Sign out</button>
                </a>
            </div>
        </div>


        <div class="main-content">

            <div class="page-heading">
                <h1>Building Manager</h1>
            </div>

            <div id="personal-details" class="show-initial section-content">
                <div class="section-heading">
                    <h1>Personal Details</h1>
                </div>

                <div class="apartment-personal-details-table-position">
                    <div class="apartment-personal-details-table">
                        <table>

                            <tr>
                                <td>User ID</td>
                                <td><?php echo $user->id  ?></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td><?php echo $user->first_name  ?></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td><?php echo $user->last_name  ?></td>
                            </tr>
                            <tr>
                                <td>Email Id</td>
                                <td><?php echo $user->email_id  ?></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><?php echo $user->phone_number  ?></td>
                            </tr>
                            <tr>
                                <td>Joining Date</td>
                                <td><?php echo $user->joining_datetime  ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="edit-button-position">
                    <button class="edit-button">Edit</button>
                </div>
            </div>

            <div id="utility-bill-report" class="section-content">
                <div class="section-heading">
                    <h1>Utility Bill Report</h1>
                </div>

                <div>
                    <h2></h2>
                </div>

                <div class="apartment-owner-bill-table-position total-bill">
                    <div class="apartment-owner-bill-table">
                        <table>
                            <tr>
                                <th>Apartment Number</th>
                                <th>Utility Name</th>
                                <th>Cost</th>
                                <th>Service Provider</th>
                            </tr>
                            <?php $utils = $buildingService->getUtilityBillsByUserId($userId);
                            foreach ($utils as $u) {
                            ?>
                                <tr>
                                    <td><?= $u['apartment_number'] ?></td>
                                    <td><?= $u['utility_name'] ?></td>
                                    <td><?= $u["utility_monthly_bill_amount"] ?></td>
                                    <td><?= $u["service_provider_type"] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

            <div id="community-service-bill-report" class="section-content">
                <div class="section-heading">
                    <h1>Community Service Bill Report</h1>
                </div>

                <div>
                    <h2></h2>
                </div>

                <div class="apartment-owner-bill-table-position total-bill">
                    <div class="apartment-owner-bill-table">
                        <table>
                            <tr>
                                <th>Apartment Number</th>
                                <th>Maintenance Fee</th>
                            </tr>
                            <?php $csbReport = $buildingService->getCsbReportById($userId);
                            foreach ($csbReport as $csb) {
                            ?>
                                <tr>
                                    <td><?= $csb['apartment_number'] ?></td>
                                    <td><?= $csb['bill'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

            <div id="maintenance-request-report" class="section-content">
                <div class="section-heading">
                    <h1>Community Service Bill Report</h1>
                </div>

                <?php

                $mr = $buildingService->getMaintenanceRequestByUserId($userId);
                ?>
                <div>
                    <h2></h2>
                </div>
                <div class="building-manager-request-table-position">
                    <div class="apartment-owner-bill-table">
                        <table>
                            <tr>
                                <th>Maintenance Request ID</th>
                                <th>Apartment Number</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($mr as $m) { ?>
                                <tr>
                                    <td><?= $m['maintenance_request_id'] ?></td>
                                    <td><?= $m['apartment_number'] ?></td>
                                    <td><?= $m['message_datetime'] ?></td>
                                    <td><?= $m['status'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

            <div id="complaint-report" class="section-content">
                <div class="section-heading">
                    <h1>Complaint Report</h1>
                </div>

                <div>
                    <h2></h2>
                </div>

                <div class="building-manager-request-table-position">
                    <div class="apartment-owner-bill-table">
                        <table>
                            <?php $complaints = $buildingService->getComplaintsByUserId($userId); ?>
                            <tr>
                                <th>Complaint ID</th>
                                <th>Apartment Number</th>
                                <th>Date</th>
                                <th>Complaint</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($complaints as $m) { ?>
                                <tr>
                                    <td><?= $m['complaint_id'] ?></td>
                                    <td><?= $m['apartment_number'] ?></td>
                                    <td><?= $m['message_datetime'] ?></td>
                                    <td><?= $m['message'] ?></td>
                                    <td><?= $m['status'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Building Manager Subdivision Manager Chat -->

            <div id="subdivision-manager-chat" class="section-content">
                <div class="section-heading">
                    <h1>Chat</h1>
                </div>
                <h3>Subdivision Manager</h3>

                <div class="chat-frame">

                    <div class="chat-display-box">

                    </div>

                    <div class="chat-input-bar">
                        <div class="chat-input">
                            <label for="send"></label>
                            <input type="text" id="subdivision-manager-send" name="send" class="chat-input-box" placeholder="Enter Message">
                        </div>
                        <div>
                            <button class="send-button" onclick="inputSubdivisionManagerChat()">Send</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Building Manager Apartment Owner Chat -->

            <div id="apartment-owner-chat" class="section-content">
                <div class="section-heading">
                    <h1>Chat</h1>
                </div>

                <div class="chat-with-list">

                    <div class="chat-list">

                        <div>
                            <h3>Apartment Owners</h3>
                        </div>

                        <div class="chat-name-list">
                            <a href="#apartment-owner-1">
                                <button class="apartment-owner-chat-tile" onclick="viewApartmentOwnerChatMenu(event, 'apartment-owner-1')">
                                    Amlan <br />
                                    Apartment Number: 101 <br />
                                </button>
                            </a>
                            <a href="#apartment-owner-2">
                                <button class="apartment-owner-chat-tile" onclick="viewApartmentOwnerChatMenu(event, 'apartment-owner-2')">
                                    Kishore <br />
                                    Apartment Number: 102 <br />
                                </button>
                            </a>
                            <a href="#apartment-owner-3">
                                <button class="apartment-owner-chat-tile" onclick="viewApartmentOwnerChatMenu(event, 'apartment-owner-3')">
                                    Rakshita <br />
                                    Apartment Number: 103 <br />
                                </button>
                            </a>
                            <a href="#apartment-owner-4">
                                <button class="apartment-owner-chat-tile" onclick="viewApartmentOwnerChatMenu(event, 'apartment-owner-4')">
                                    Alok <br />
                                    Apartment Number: 104 <br />
                                </button>
                            </a>
                        </div>

                    </div>

                    <div class="small-chat-frame">

                        <div class="chat-name-display">
                            <div id="apartment-owner-1" class="display-chat-name">
                                <h3>Apartment Number: 101, Amlan</h3>
                                <div class="small-chat-display-box">

                                </div>

                                <div class="chat-input-bar">
                                    <div class="chat-input">
                                        <label for="send"></label>
                                        <input type="text" id="apartment-owner-send" name="send" class="chat-input-box" placeholder="Enter Message">
                                    </div>
                                    <div>
                                        <button class="send-button" onclick="inputApartmentOwnerChat()">Send</button>
                                    </div>
                                </div>
                            </div>
                            <div id="apartment-owner-2" class="display-chat-name">
                                <h3>Apartment Number: 102, Kishore</h3>
                                <div class="small-chat-display-box">

                                </div>

                                <div class="chat-input-bar">
                                    <div class="chat-input">
                                        <label for="send"></label>
                                        <input type="text" id="apartment-owner-send" name="send" class="chat-input-box" placeholder="Enter Message">
                                    </div>
                                    <div>
                                        <button class="send-button" onclick="inputApartmentOwnerChat()">Send</button>
                                    </div>
                                </div>
                            </div>
                            <div id="apartment-owner-3" class="display-chat-name">
                                <h3>Apartment Number: 103, Rakshita</h3>
                                <div class="small-chat-display-box">

                                </div>

                                <div class="chat-input-bar">
                                    <div class="chat-input">
                                        <label for="send"></label>
                                        <input type="text" id="apartment-owner-send" name="send" class="chat-input-box" placeholder="Enter Message">
                                    </div>
                                    <div>
                                        <button class="send-button" onclick="inputApartmentOwnerChat()">Send</button>
                                    </div>
                                </div>
                            </div>
                            <div id="apartment-owner-4" class="display-chat-name">
                                <h3>Apartment Number: 104, Alok</h3>
                                <div class="small-chat-display-box">

                                </div>

                                <div class="chat-input-bar">
                                    <div class="chat-input">
                                        <label for="send"></label>
                                        <input type="text" id="apartment-owner-send" name="send" class="chat-input-box" placeholder="Enter Message">
                                    </div>
                                    <div>
                                        <button class="send-button" onclick="inputApartmentOwnerChat()">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <!-- Building Manager Apartment Details -->

            <div id="apartment-details" class="section-content">
                <div class="section-heading">
                    <h1>Apartment Details</h1>
                </div>
                <h3>Apartment List</h3>
                <div>

                    <div class="view-data-list">
                        <?php foreach ($apartments as $apt) { ?>
                            <a href="#apartment-owner-detail-1">
                                <?php

                                $json = json_encode($apt); ?>
                                <button class="apartment-owner-detail-tile" onclick='viewApartmentDetails(event,"apartment-owner-detail-1" , JSON.stringify(<?php echo $json ?>))'>
                                    Apartment Number: <?php echo $apt['apartment_number'] ?> <br />
                                </button>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="view-data">
                        <div id="apartment-owner-detail-1" class="apartment-owner-detail">
                            <div class="apartment-personal-details-table">
                                <table>
                                    <tr>
                                        <td>Apartment Number</td>
                                        <td id="aptNum"></td>
                                    </tr>
                                    <tr>
                                        <td>First Name</td>
                                        <td id="firstName"></td>
                                    </tr>
                                    <tr>
                                        <td>Last Name</td>
                                        <td id="lastName"></td>
                                    </tr>
                                    <tr>
                                        <td>Email Id</td>
                                        <td id="emailId"></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td id="phoneNum"></td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td id="joinDate"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Building Manager View Maintenance Requests -->

            <div id="manage-maintenance-requests" class="section-content">
                <div class="section-heading">
                    <h1>Maintenance Request</h1>
                </div>
                <h3>View Maintenance Request</h3>
                <div>

                    <div class="maintenance-request-list">
                        <?php $mr = $buildingService->getMaintenanceRequestByUserId($userId);
                        foreach ($mr as $m) { ?>
                            <a href='#mr-3'>
                                <button class="maintenance-request" onclick="viewMaintenanceDetails(event, 'mr-3')">
                                    Maintenance Request ID: <?= $m['maintenance_request_id'] ?> <br />
                                </button>
                            </a>
                            <!-- </div> -->
                            <div class="display-maintenance-request">
                                <div id="mr-3" class="maintenance-request-details">
                                    <h3>Datetime</h3>
                                    <p><?= $m['message_datetime'] ?></p>
                                    <h3>Message</h3>
                                    <p><?= $m['message'] ?></p>
                                    <h3>Status</h3>
                                    <p><?=  $m['status']?></p>
                                    <div class="status-change-button-position">
                                        <button class="status-change-button">In-progress</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- <div class="display-maintenance-request">
                        <div id="mr-1" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>01/27/2021 04:05:06</p>
                            <h3>Message</h3>
                            <p>Pipe needs maintenance.</p>
                            <h3>Status</h3>
                            <p>In-progress</p>

                            <div class="status-change-button-position">
                                <button class="status-change-button">Completed</button>
                            </div>
                        </div>

                        <div id="mr-2" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>02/09/2021 04:05:06</p>
                            <h3>Message</h3>
                            <p>Electric maintenance required.</p>
                            <h3>Status</h3>
                            <p>Completed</p>
                        </div>

                        <div id="mr-3" class="maintenance-request-details">
                            <h3>Datetime</h3>
                            <p>01/27/2021 04:05:06</p>
                            <h3>Message</h3>
                            <p>Pipe needs maintenance.</p>
                            <h3>Status</h3>
                            <p>Open</p>

                            <div class="status-change-button-position">
                                <button class="status-change-button">In-progress</button>
                            </div>
                        </div>
                    </div> -->
                </div>

            </div>

            <!-- Building Manager View Complaints -->

            <div id="manage-complaints" class="section-content">
                <div class="section-heading">
                    <h1>View Complaints</h1>
                </div>
                <h3>View Complaints</h3>
                <div>

                <div class="maintenance-request-list">
                        <?php $mr = $buildingService->getComplaintsByUserId($userId);
                        foreach ($mr as $m) { ?>
                            <a href='#co-3'>
                                <button class="maintenance-request" onclick="viewMaintenanceDetails(event, 'co-3')">
                                    Complaint ID: <?= $m['complaint_id'] ?> <br />
                                </button>
                            </a>
                            <div class="display-maintenance-request">
                                <div id="co-3" class="maintenance-request-details">
                                    <h3>Datetime</h3>
                                    <p><?= $m['message_datetime'] ?></p>
                                    <h3>Message</h3>
                                    <p><?= $m['message'] ?></p>
                                    <h3>Status</h3>
                                    <p><?=  $m['status']?></p>
                                    <div class="status-change-button-position">
                                        <button class="status-change-button">In-progress</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div id="dashboard-electricity-bill" class="section-content">
                <div class="section-heading"><h1>Electricity Dashboard</h1></div>

                <div>
                    <canvas id="electricity-chart"></canvas>
                </div>
                <?php
                    $electricityByMonth = $buildingService->getElectricityBillsByMonth($userId, 1);
                    $electricity = array();
                    $bill = array();
                    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                    foreach($electricityByMonth as $em){
                        array_push($electricity, $months[$em['month']- 1]);
                        array_push($bill, $em['SUM(ub.utility_monthly_bill_amount)']);
                    }
                    $eJson = json_encode($electricity);
                    array_push($bill, 0);
                    $billJson = json_encode($bill);
                ?>
                <script>
                    let eChart = document.getElementById('electricity-chart').getContext('2d');
                    
                    
                    let eDashboard = new Chart(eChart, {
                        type:'bar',
                        data:{
                            labels: <?php echo $eJson ?>,
                            datasets:[{
                                label:'Total Electricty Bill of Buildings/Month',
                                data: <?php echo $billJson ?>,
                                backgroundColor:'#bbb'
                            }]
                        }
                    });
                </script>
                
            </div>


            <div id="dashboard-gas-bill" class="section-content">
                <div class="section-heading"><h1>Gas Dashboard</h1></div>

                <div>
                    <canvas id="gas-chart"></canvas>
                </div>
                <?php
                    $gasByMonth = $buildingService->getElectricityBillsByMonth($userId, 2);
                    $gas = array();
                    $bill = array();
                    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                    foreach($gasByMonth as $em){
                        array_push($gas, $months[$em['month']- 1]);
                        array_push($bill, $em['SUM(ub.utility_monthly_bill_amount)']);
                    }
                    $eJson = json_encode($gas);
                    array_push($bill, 0);
                    $billJson = json_encode($bill);
                ?>
                <script>
                    let gasChart = document.getElementById('gas-chart').getContext('2d');
                    // let polo = JSON.stringify(<?php $ebilljson ?>);

                    let gasDashboard = new Chart(gasChart, {
                        type:'bar',
                        data:{
                            labels: <?php echo $eJson ?>,
                            datasets:[{
                                label:'Total Gas Bill of Subdivision/Month',
                                data: <?php echo $billJson ?>,
                                backgroundColor:'red'
                            }]
                        }
                    });
                </script>
                
            </div>

            <div id="dashboard-water-bill" class="section-content">
                <div class="section-heading"><h1>Water Dashboard</h1></div>

                <div>
                    <canvas id="water-chart"></canvas>
                </div>
                <?php
                    $waterByMonth = $buildingService->getElectricityBillsByMonth($userId, 3);
                    $water = array();
                    $bill = array();
                    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                    foreach($waterByMonth as $em){
                        array_push($water, $months[$em['month']- 1]);
                        array_push($bill, $em['SUM(ub.utility_monthly_bill_amount)']);
                    }
                    $eJson = json_encode($water);
                    array_push($bill, 0);
                    $billJson = json_encode($bill);
                ?>
                <script>
                    let waterChart = document.getElementById('water-chart').getContext('2d');
                    // let polo = JSON.stringify(<?php $ebilljson ?>);

                    let waterDashboard = new Chart(waterChart, {
                        type:'bar',
                        data:{
                            labels: <?php echo $eJson ?>,
                            datasets:[{
                                label:'Total Gas Bill of Subdivision/Month',
                                data: <?php echo $billJson ?>,
                                backgroundColor:'blue'
                            }]
                        }
                    });
                </script>
                
            </div>

        </div>

    </div>

</body>

</html>