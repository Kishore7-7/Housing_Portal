<?php

require '../../entity/Apartment.php';

class BuildingService {

	function addNewBuilding($userId) {

		$newBuildingName = $_POST['new-building-name'];
	    $buildingsSubdivisionId = $_POST['subdivision-name'];
		$buildingId = '';
	    $buildingOccupancyStatus = 'empty';
	    $apartmentOccupancyStatus = 'empty';
	    $newBuildingService = new BuildingService();

	    $output = $newBuildingService->storeNewBuildingName($newBuildingName, $buildingOccupancyStatus, $buildingsSubdivisionId, $userId);

	    if ($output != 'Failed'){
	    	$buildingId = $output;
	    }
	    else {
	    	echo "Building Id not returned";
	    	exit;
	    }

	    $apartmentArray = [];
	    $apartmentIndex = "";

	    for ($i=1; $i<=4;$i=$i+1) {
	    	for ($j=1; $j<=4;$j=$j+1) {
	    		
	    		$apartmentIndex = "apt-num-f$i-a$j";
	    		// echo "^^apt-num-f$i-a$j~$_POST[$apartmentIndex]";
	    		// $apartment = new Apartment($_POST[$apartmentIndex], $apartmentOccupancyStatus, $buildingId, $buildingsSubdivisionId, $userId);
	    		$apartment = new Apartment();
	    		$apartment->apartment_number = $_POST[$apartmentIndex];
	    		$apartment->occupancy_status = $apartmentOccupancyStatus;
	    		$apartment->buildings_building_id = $buildingId;
	    		$apartment->subdivisions_subdivision_id	= $buildingsSubdivisionId;
	    		$apartment->users_user_id = $userId;

	    		array_push($apartmentArray, $apartment);
	    	}
	    }

	    // var_dump($apartmentArray);
	    return $newBuildingService->storeNewApartments($apartmentArray);

	}


	function storeNewBuildingName($newBuildingName, $buildingOccupancyStatus, $buildingsSubdivisionId, $userId){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "INSERT into `buildings` (`building_id`,`building_name`, `occupancy_status`, `subdivisions_subdivision_id`, `users_user_id`) values (NULL, :newBuildingName, :buildingOccupancyStatus, :buildingsSubdivisionId, :usersUserId)";

		$stmt = $dbConnection->prepare($sql);

		$stmt->bindValue(':newBuildingName', $newBuildingName, PDO::PARAM_STR);
		$stmt->bindValue(':buildingOccupancyStatus', $buildingOccupancyStatus, PDO::PARAM_STR);
		$stmt->bindValue(':buildingsSubdivisionId', $buildingsSubdivisionId, PDO::PARAM_INT);
		$stmt->bindValue(':usersUserId', $userId, PDO::PARAM_INT);

		if ($stmt->execute()){
			$newBuildingId = $dbConnection->lastInsertId();
			return $newBuildingId;
		} else{
			return 'Failed';
		}
	}
	

	function storeNewApartments($apartmentArray){

		$savingStatus = '';

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		foreach ($apartmentArray as $apartment) {

			$sql = "INSERT into `apartments` (`apartment_id`,`apartment_number`, `occupancy_status`, `buildings_building_id`, `subdivisions_subdivision_id`, `users_user_id`) values (NULL, :apartmentNumber, :apartmentOccupancyStatus, :buildingsBuildingId, :buildingsSubdivisionId, :usersUserId)";

			$stmt = $dbConnection->prepare($sql);

			$stmt->bindValue(':apartmentNumber', $apartment->apartment_number, PDO::PARAM_INT);
			$stmt->bindValue(':apartmentOccupancyStatus', $apartment->occupancy_status, PDO::PARAM_STR);
			$stmt->bindValue(':buildingsBuildingId', $apartment->buildings_building_id, PDO::PARAM_INT);
			$stmt->bindValue(':buildingsSubdivisionId', $apartment->subdivisions_subdivision_id, PDO::PARAM_INT);
			$stmt->bindValue(':usersUserId', $apartment->users_user_id, PDO::PARAM_INT);

			if ($stmt->execute()){
				$savingStatus = 'Success';
			} else {
				$savingStatus = 'Failed';
				echo "Some record failed to get stored";
				var_dump($apartment);
				// exit;
			}
		}

		return $savingStatus;

	}
	
	function getApartmentsUnderBm($userId) {
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT a.apartment_number, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime FROM `apartments` as a 
		JOIN users as u ON a.users_user_id = u.user_id
		JOIN buildings as b ON a.buildings_building_id=b.building_id
		WHERE b.users_user_id = $userId";

		$stmt = $dbConnection->prepare($sql);

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function getUtilityBillsByUserId($userId) {
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * FROM `apartment_utility_bills` as ub 
		LEFT JOIN `apartments` as a ON a.apartment_id = ub.apartments_apartment_id 
		LEFT JOIN buildings as b ON b.building_id = a.buildings_building_id
		 LEFT JOIN utilities as ut ON ut.utility_id = ub.`utilities_utility_id` 
		 WHERE b.users_user_id = $userId order by a.apartment_number";

		$stmt = $dbConnection->prepare($sql);

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function getMaintenanceRequestByUserId($userId) {
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * FROM `maintenance_requests` as mr 
		JOIN apartments as a ON mr.apartments_apartment_id=a.apartment_id 
		LEFT JOIN buildings as b ON b.building_id = a.buildings_building_id
		WHERE b.users_user_id = $userId";

		$stmt = $dbConnection->prepare($sql);

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function getCsbReportById($userId){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT a.apartment_number, SUM(acsb.community_service_monthly_bill_amount) as bill FROM `apartment_community_service_bills` as acsb 
		JOIN `apartments` as a ON a.apartment_id=acsb.apartments_apartment_id 
		LEFT JOIN buildings as b ON b.building_id = a.buildings_building_id 
		WHERE b.users_user_id = $userId GROUP BY a.apartment_number";

		$stmt = $dbConnection->prepare($sql);

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function getComplaintsByUserId($userId) {
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * FROM `complaints` as mr 
		JOIN apartments as a ON mr.apartments_apartment_id=a.apartment_id 
		LEFT JOIN buildings as b ON b.building_id = a.buildings_building_id
		WHERE b.users_user_id = $userId";

		$stmt = $dbConnection->prepare($sql);

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function getElectricityBillsByMonth($userId, $type){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();
		
		$sql = "SELECT SUM(ub.utility_monthly_bill_amount), a.apartment_number, ub.buildings_building_id, ub.users_user_id, b.users_user_id as bm_id, ub.month 
		FROM `apartment_utility_bills` as ub JOIN apartments as a ON a.apartment_id=ub.apartments_apartment_id 
		JOIN buildings as b ON b.building_id=ub.buildings_building_id WHERE b.users_user_id = $userId AND ub.utilities_utility_id = $type GROUP BY ub.month";

		$stmt = $dbConnection->prepare($sql);

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}

	}

}
