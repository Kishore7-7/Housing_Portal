<?php

require '../utility/Database.php';
require '../entity/ApartmentUtilityServiceProviderType.php';
require '../entity/ApartmentUtilityBill.php';
require '../entity/Utility.php';
require '../model/Response.php';

class UtilityBillService {

	function saveUtilityBill(){

		$aptId = $_POST['aptId'];
		$eBill = $_POST['electricityBill'];
		$gBill = $_POST['gasBill'];
		$wBill = $_POST['waterBill'];
		$iBill = $_POST['internetBill'];
		$month = $_POST['month'];
		$year = $_POST['year'];

		$ubs = new UtilityBillService();
		$aptServiceUtitlityList = $ubs->getServiceChoicePerUtiltity($aptId);
		// var_dump($aptServiceUtitlityList);

		$utilityList = $ubs->fetchAllUtilities();

		
		$aubList = [];
		$date = new DateTime("now", new DateTimeZone('America/Chicago') );

		foreach ($aptServiceUtitlityList as $asu){

			$aub = new ApartmentUtilityBill();


			$aub->month = $month;
			$aub->year = $year;

			$aub->apartments_apartment_id = $asu->apartments_apartment_id;
			$aub->buildings_building_id = $asu->buildings_building_id;
			$aub->subdivisions_subdivision_id = $asu->subdivisions_subdivision_id;
			$aub->users_user_id = $asu->users_user_id;

			foreach ($utilityList as $utility){
				if ($utility->utility_name == 'electricity' && $utility->utility_id ==$asu->utilities_utility_id){
					$aub->utilities_utility_id = $asu->utilities_utility_id;
					$aub->service_provider_type = $asu->service_provider_type;
					$aub->utility_monthly_bill_amount = $eBill;
				}
				elseif ($utility->utility_name == 'gas' && $utility->utility_id ==$asu->utilities_utility_id){
					$aub->utilities_utility_id = $asu->utilities_utility_id;
					$aub->service_provider_type = $asu->service_provider_type;
					$aub->utility_monthly_bill_amount = $gBill;
				}
				elseif ($utility->utility_name == 'water' && $utility->utility_id ==$asu->utilities_utility_id){
					$aub->utilities_utility_id = $asu->utilities_utility_id;
					$aub->service_provider_type = $asu->service_provider_type;
					$aub->utility_monthly_bill_amount = $wBill;
				}	
				elseif ($utility->utility_name == 'internet' && $utility->utility_id ==$asu->utilities_utility_id){
					$aub->utilities_utility_id = $asu->utilities_utility_id;
					$aub->service_provider_type = $asu->service_provider_type;
					$aub->utility_monthly_bill_amount = $iBill;
				}

			}

			array_push($aubList, $aub);
			
		}
		$response = $ubs->storeUtilityBill($aubList);
		var_dump($response);
	}

	function storeUtilityBill($aubList){

		$savingStatus = '';
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		foreach ($aubList as $aub){
			$sql = "INSERT into `apartment_utility_bills` (`apartment_utlity_bill_id`, `month`,`year`,`utility_monthly_bill_amount`,`service_provider_type`, `utilities_utility_id`, `apartments_apartment_id`, `buildings_building_id`, `subdivisions_subdivision_id`, `users_user_id`) VALUES (NULL, :month, :year, :utilityMonthlyBillAmount ,:serviceProviderType, :utilitiesUtilityId, :apartmentsApartmentId, :buildingsBuildingId, :subdivisionsSubdivisionId, :usersUserId)";

			$stmt = $dbConnection->prepare($sql);

			$stmt->bindValue(':month', $aub->month, PDO::PARAM_INT);
			$stmt->bindValue(':year', $aub->year, PDO::PARAM_INT);
			$stmt->bindValue(':utilityMonthlyBillAmount', $aub->utility_monthly_bill_amount, PDO::PARAM_STR);
			$stmt->bindValue(':serviceProviderType', $aub->service_provider_type, PDO::PARAM_STR);
			$stmt->bindValue(':utilitiesUtilityId', $aub->utilities_utility_id, PDO::PARAM_INT);
			$stmt->bindValue(':apartmentsApartmentId', $aub->apartments_apartment_id, PDO::PARAM_INT);
			$stmt->bindValue(':buildingsBuildingId', $aub->buildings_building_id, PDO::PARAM_INT);
			$stmt->bindValue(':subdivisionsSubdivisionId', $aub->subdivisions_subdivision_id, PDO::PARAM_INT);
			$stmt->bindValue(':usersUserId', $aub->users_user_id, PDO::PARAM_INT);

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

	function getServiceChoicePerUtiltity($aptId){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from apartment_utility_service_provider_type where apartments_apartment_id = :aptId";

		$stmt = $dbConnection->prepare($sql);
		$stmt->bindValue(':aptId', $aptId, PDO::PARAM_INT);

		$stmt->setFetchMode(PDO::FETCH_CLASS, 'ApartmentUtilityServiceProviderType');


		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}

	}


	function fetchAllUtilities(){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from utilities";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Utility');


		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}
	}


}