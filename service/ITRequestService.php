<?php

// require '../../utility/Database.php';
// require '../../entity/Subdivision.php';
require '../../entity/ITRequest.php';

class ITRequestService {

	function saveITR($userId, $itrMsg) {

		$itrService = new ITRequestService();

		$subdivision = $itrService->fetchSubdivisionViaUserId($userId);

		// var_dump($subdivision);

		$itRequest = new ITRequest();

		$itRequest->message = $itrMsg;
		$itRequest->status = 'open';

		$date = new DateTime("now", new DateTimeZone('America/Chicago') );
		$itRequest->message_datetime= $date->format('Y-m-d H:i:s');
		$itRequest->subdivisions_subdivision_id = $subdivision->subdivision_id;

		$itrService->storeITRequest($itRequest);

	}

	function storeITRequest($itRequest){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "INSERT into `it_requests` (`it_request_id`,`message`, `status`, `message_datetime`, `subdivisions_subdivision_id`) values (NULL, :message, :status, :message_datetime, :subdivisionId)";

		$stmt = $dbConnection->prepare($sql);

		$stmt->bindValue(':message', $itRequest->message, PDO::PARAM_STR);
		$stmt->bindValue(':status', $itRequest->status, PDO::PARAM_STR);
		$stmt->bindValue(':message_datetime', $itRequest->message_datetime, PDO::PARAM_STR);
		$stmt->bindValue(':subdivisionId', $itRequest->subdivisions_subdivision_id, PDO::PARAM_INT);		

		if ($stmt->execute()){
			return 'Success';
		} else{
			return 'Failed';
		}
	}

	function fetchSubdivisionViaUserId($userId){
		// echo "inside fetch = ";
		// var_dump($userId);
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();
		$sql = "SELECT * from subdivisions WHERE users_user_id = :userId";
		$stmt = $dbConnection->prepare($sql);
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Subdivision');

		// echo "here";
		if ($stmt->execute()){
			// echo "success";
			return $stmt->fetch();
		} else{
			echo "Failed";
			return 'Failed';
		}
	}

	function fetchAllITRequest(){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from it_requests";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'ITRequest');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}
	}

	function fetchAllITRequestBySubdivisionId($subdivisionId){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT * from it_requests where subdivisions_subdivision_id = :subdivisionId";

		$stmt = $dbConnection->prepare($sql);
		$stmt->bindValue(':subdivisionId', $subdivisionId, PDO::PARAM_INT);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'ITRequest');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else{
			return 'Failed';
		}
	}


}