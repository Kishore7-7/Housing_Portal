<?php
require __DIR__.'../../entity/User.php';
include_once __DIR__.'../../utility/Database.php';

/*
Do not add DB connection in this file. It breaks the code.
*/

class UserService {

	function getUserByEmailIdAndPassword($dbConnection, $emailId, $password){

		$sql_query_to_fetch_user_via_email_id = "SELECT * FROM users where email_id = :emailId and password = :password";

		$stmt = $dbConnection->prepare($sql_query_to_fetch_user_via_email_id);
		$stmt->bindValue(':emailId', $emailId, PDO::PARAM_STR);
		$stmt->bindValue(':password', $password, PDO::PARAM_STR);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

		if ($stmt->execute()){
			return $stmt->fetch();
		}
		// else{
		// 	echo "Did not work";
		// }
	}

	function getuserById($id){
		
		$sql_query_to_fetch_user_via_email_id = "SELECT * FROM users where user_id = :userId";

		$dbObject = new Database();
    $dbConnection = $dbObject->getDatabaseConnection();

		$stmt = $dbConnection->prepare($sql_query_to_fetch_user_via_email_id);
		$stmt->bindValue(':userId', $id, PDO::PARAM_STR);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

		if ($stmt->execute()){
			return $stmt->fetch();
		}
	}

}