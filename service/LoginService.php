<?php

require '../utility/Database.php';
require '../service/UserService.php';
require '../service/RoleService.php';

class LoginService {

	function loginUser($emailId, $password){
		session_start();
		$dbObject = new Database();
	    $dbConnection = $dbObject->getDatabaseConnection();

	    // $loginService = new LoginService();
	    $userService = new UserService();
	    $user = $userService->getUserByEmailIdAndPassword($dbConnection, $emailId, $password);
		$_SESSION['CURRENT_USER'] = $user;
	    // var_dump($user);

	    $user_id = $user->user_id;
	    $role_id = $user->roles_role_id;
	    $role_name = '';

	    if (empty($role_id)){
	        echo "Role Id = [$role_id] is empty. Error.";
	        exit;
	    }
	    else{
	    	$roleService = new RoleService();
	        $roleRecord = $roleService->getRoleNameByRoleId($dbConnection, $role_id);

	        // var_dump($roleRecord);

	        $role_name = $roleRecord->role_name;
	    }

	    if ($role_name == "admin"){
            // echo "You are ADMIN";
            header("Location: ../YouareonDefault/admin/admin.php?user_id=$user_id");
            // echo "     testing";
            exit;
        } elseif ($role_name == "subdivision manager"){
            // echo "You are SUBDIVISION MANAGER";
            header("Location: ../YouareonDefault/subdivision-manager/subdivision-manager.php?user_id=$user_id");
            exit;
        } elseif (strtolower($role_name) == "building manager"){
            
            // echo "You are BUILDING MANAGER";
            header("Location: ../YouareonDefault/building-manager/building-manager.php?user_id=$user_id");
            exit;
        } elseif ($role_name == "apartment owner"){
            // echo "You are APARTMENT OWNER";
            header("Location: ../YouareonDefault/apartment-owner/apartment-owner.php?user_id=$user_id");
            exit;
        } else {
            echo "Role does not match any preset ones. Error";
            
        }

	}

	// function getUserByEmailIdAndPassword($dbConnection, $emailId, $password){

	// 	$sql_query_to_fetch_user_via_email_id = "SELECT * FROM users where email_id = :emailId and password = :password";

	// 	$stmt = $dbConnection->prepare($sql_query_to_fetch_user_via_email_id);
	// 	$stmt->bindValue(':emailId', $emailId, PDO::PARAM_STR);
	// 	$stmt->bindValue(':password', $password, PDO::PARAM_STR);
	// 	$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

	// 	if ($stmt->execute()){
	// 		return $stmt->fetch();
	// 	}
	// 	// else{
	// 	// 	echo "Did not work";
	// 	// }
	// }

	// function getRoleNameByRoleId($dbConnection, $roleId){

	// 	$sql_query_to_fetch_role_record_via_role_id = "SELECT * FROM roles where role_id = :roleId";

	// 	$stmt = $dbConnection->prepare($sql_query_to_fetch_role_record_via_role_id);
	// 	$stmt->bindValue(':roleId', $roleId, PDO::PARAM_INT);
	// 	$stmt->setFetchMode(PDO::FETCH_CLASS, 'Role');

	// 	if ($stmt->execute()){
	// 		return $stmt->fetch();
	// 	}
	// }


}