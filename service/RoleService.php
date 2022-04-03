<?php

require '../entity/Role.php';

/*
Do not add DB connection in this file. It breaks the code.
*/
class RoleService {

	function getRoleNameByRoleId($dbConnection, $roleId){

		$sql_query_to_fetch_role_record_via_role_id = "SELECT * FROM roles where role_id = :roleId";

		$stmt = $dbConnection->prepare($sql_query_to_fetch_role_record_via_role_id);
		$stmt->bindValue(':roleId', $roleId, PDO::PARAM_INT);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Role');

		if ($stmt->execute()){
			return $stmt->fetch();
		}
	}
}