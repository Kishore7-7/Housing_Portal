<?php

// require '../utility/Database.php';

class ResetPasswordService {

	function resetPassword($userId, $newPassword){
		
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "UPDATE users SET password = :newPassword WHERE user_id = :userId";

		$stmt = $dbConnection->prepare($sql);
		
		$stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
		$stmt->bindValue(':newPassword', $newPassword, PDO::PARAM_STR);
		
		try{
			if ($stmt->execute()){
				return 'Password changed Successfully';
			} else{
				echo "Failed";
				return 'Failed';
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			// exit;
		}
		
	}
}