<?php

require '../utility/Database.php';
require '../entity/CommunityService.php';
require '../entity/Apartment.php';
require '../entity/ApartmentCommunityServiceBill.php';
require '../model/Response.php';

class CommunityBillService{

	function saveCommunityBill(){

		$aptId = $_POST['aptId'];
		$mfBill = $_POST['maintenanceFeeBill'];
		$pBill = $_POST['poolBill'];
		$gBill = $_POST['gymBill'];
		$month = $_POST['month'];
		$year = $_POST['year'];

		$cbs = new CommunityBillService();
		$aptDetails = $cbs->getApartmentDetails($aptId);
		// var_dump($aptDetails);

		$csList = $cbs->fetchAllCommunityServices();
		// var_dump($csList);

		$communityServiceBillList = [];

		foreach ($csList as $cs) {
			$apartmentCommunityServiceBill = new ApartmentCommunityServiceBill();


			$apartmentCommunityServiceBill->month = $month;
			$apartmentCommunityServiceBill->year = $year;
			
			$apartmentCommunityServiceBill->apartments_apartment_id = $aptDetails->apartment_id;
			$apartmentCommunityServiceBill->buildings_building_id = $aptDetails->buildings_building_id;
			$apartmentCommunityServiceBill->subdivisions_subdivision_id = $aptDetails->subdivisions_subdivision_id;
			$apartmentCommunityServiceBill->users_user_id = $aptDetails->users_user_id;

			if ($cs->community_service_name == 'maintenance fee'){
				$apartmentCommunityServiceBill->community_service_monthly_bill_amount = $mfBill;
				$apartmentCommunityServiceBill->community_service_id = $cs->community_service_id;
			} 
			elseif ($cs->community_service_name == 'pool'){
				$apartmentCommunityServiceBill->community_service_monthly_bill_amount = $pBill;
				$apartmentCommunityServiceBill->community_service_id = $cs->community_service_id;
			}
			if ($cs->community_service_name == 'gym'){
				$apartmentCommunityServiceBill->community_service_monthly_bill_amount = $gBill;
				$apartmentCommunityServiceBill->community_service_id = $cs->community_service_id;
			}


			array_push($communityServiceBillList, $apartmentCommunityServiceBill);
			
		}

		// var_dump($communityServiceBillList);

		$response = $cbs->storeCommunityServiceBill($communityServiceBillList);
		var_dump($response);

	}

	function storeCommunityServiceBill($communityServiceBillList){

		$savingStatus = '';
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		foreach ($communityServiceBillList as $csb){
			$sql = "INSERT into `apartment_community_service_bills` (`apartment_community_service_bill_id`, `month`,`year`,`community_service_monthly_bill_amount`, `community_service_id`, `apartments_apartment_id`, `buildings_building_id`, `subdivisions_subdivision_id`, `users_user_id`) VALUES (NULL, :month, :year, :communityServiceMonthlyBillAmount , :communityServiceId, :apartmentsApartmentId, :buildingsBuildingId, :subdivisionsSubdivisionId, :usersUserId)";

			$stmt = $dbConnection->prepare($sql);

			$stmt->bindValue(':month', $csb->month, PDO::PARAM_INT);
			$stmt->bindValue(':year', $csb->year, PDO::PARAM_INT);

			$stmt->bindValue(':communityServiceMonthlyBillAmount', $csb->community_service_monthly_bill_amount, PDO::PARAM_STR);
			$stmt->bindValue(':communityServiceId', $csb->community_service_id, PDO::PARAM_INT);

			$stmt->bindValue(':apartmentsApartmentId', $csb->apartments_apartment_id, PDO::PARAM_INT);
			$stmt->bindValue(':buildingsBuildingId', $csb->buildings_building_id, PDO::PARAM_INT);
			$stmt->bindValue(':subdivisionsSubdivisionId', $csb->subdivisions_subdivision_id, PDO::PARAM_INT);
			$stmt->bindValue(':usersUserId', $csb->users_user_id, PDO::PARAM_INT);

			if ($stmt->execute()){
				$savingStatus = 'Success';
			} else {
				$savingStatus = 'Failed';
				echo "Some record failed to get stored";
				var_dump($apartment);
				// exit;
			}

		}

		return new Response($savingStatus, '','service provider choices stored Successfully');
	}

	function getApartmentDetails($aptId){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from apartments where apartment_id = :aptId";

		$stmt = $dbConnection->prepare($sql);
		$stmt->bindValue(':aptId', $aptId, PDO::PARAM_INT);

		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Apartment');


		if ($stmt->execute()){
			return $stmt->fetch();
		} else{
			return 'Failed';
		}

	}


	function fetchAllCommunityServices(){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from community_services";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'CommunityService');


		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}
	}	

}