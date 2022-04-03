<?php

require '../../utility/Database.php';
require '../../entity/Apartment.php';
require '../../entity/MR.php';

class MRService {

	function saveMR($userId, $mrMsg) {
		$mrService = new MRService();

		$apartment = $mrService->fetchApartmentViaUserId($userId);

		// var_dump($apartment);
		$mr = new MR();
		$mr->message = $mrMsg;
		$mr->status = 'open';

		$date = new DateTime("now", new DateTimeZone('America/Chicago') );
		$mr->message_datetime = $date->format('Y-m-d H:i:s');
		$mr->month = $date->format('m');
		$mr->year = $date->format('Y');
		$mr->apartments_apartment_id = $apartment->apartment_id;
		$mr->buildings_building_id = $apartment->buildings_building_id;
		$mr->subdivisions_subdivision_id = $apartment->subdivisions_subdivision_id;
		$mr->users_user_id = $apartment->users_user_id;

		// echo "datetime = $mr->message_datetime";
		// echo "month = $mr->month";

		$mrService->storeMR($mr);

	}

	function storeMR($mr){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "INSERT into `maintenance_requests` (`maintenance_request_id`,`message`, `status`, `message_datetime`, `month`, `year`, `apartments_apartment_id`, `buildings_building_id`, `subdivisions_subdivision_id`, `users_user_id`) values (NULL, :message, :status, :message_datetime, :month, :year, :apartmentId, :buildingId, :subdivisionId, :usersUserId)";

		$stmt = $dbConnection->prepare($sql);

		$stmt->bindValue(':message', $mr->message, PDO::PARAM_STR);
		$stmt->bindValue(':status', $mr->status, PDO::PARAM_STR);
		$stmt->bindValue(':message_datetime', $mr->message_datetime, PDO::PARAM_STR);
		$stmt->bindValue(':month', $mr->month, PDO::PARAM_INT);
		$stmt->bindValue(':year', $mr->year, PDO::PARAM_INT);
		$stmt->bindValue(':apartmentId', $mr->apartments_apartment_id, PDO::PARAM_INT);
		$stmt->bindValue(':buildingId', $mr->buildings_building_id, PDO::PARAM_INT);
		$stmt->bindValue(':subdivisionId', $mr->subdivisions_subdivision_id, PDO::PARAM_INT);		
		$stmt->bindValue(':usersUserId', $mr->users_user_id, PDO::PARAM_INT);

		if ($stmt->execute()){
			return 'Success';
		} else{
			return 'Failed';
		}
	}

	function fetchApartmentViaUserId($userId){
		// echo "inside fetch = ";
		// var_dump($userId);
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();
		$sql = "SELECT * from apartments WHERE users_user_id = :userId";
		$stmt = $dbConnection->prepare($sql);
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Apartment');

		// echo "here";
		if ($stmt->execute()){
			// echo "success";
			return $stmt->fetch();
		} else{
			echo "Failed";
			return 'Failed';
		}
	}

	function fetchAllMR(){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from maintenance_requests";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'MR');


		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}
	}



	function fetchAllMRByUserId($userId){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from maintenance_requests where users_user_id = :userId";

		$stmt = $dbConnection->prepare($sql);
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'MR');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}
	}













}