<?php

require '../../model/BuildingManagerRecord.php';
require '../../model/SubdivisionManagerRecord.php';
require '../../model/ApartmentOwnerRecord.php';

class MasterRecordService {

	function fetchAllSubdivisionManagerRecords(){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT s.subdivision_name, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime from users as u
		inner join subdivisions as s on u.user_id = s.users_user_id 
		inner join roles as r on u.roles_role_id=r.role_id
		where r.role_name = 'subdivision manager'";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'SubdivisionManagerRecord');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function fetchAllBuildingManagerRecords(){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT b.building_name, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime from users as u
		inner join buildings as b on u.user_id = b.users_user_id 
		inner join roles as r on u.roles_role_id=r.role_id
		where r.role_name = 'building manager'";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'BuildingManagerRecord');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function fetchAllApartmentOwnerRecords(){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT b.building_name, a.apartment_number, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime from users as u
		inner join apartments as a on u.user_id = a.users_user_id 
		inner join roles as r on u.roles_role_id=r.role_id
		inner join buildings as b on b.building_id=a.buildings_building_id
		where r.role_name = 'apartment owner'
		order by b.building_name";

		$stmt = $dbConnection->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'ApartmentOwnerRecord');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}


	function fetchAllApartmentOwnerRecordsOfASubdivision($subdivisionId){

		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT b.building_name, a.apartment_number, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime from users as u
		inner join apartments as a on u.user_id = a.users_user_id 
		inner join roles as r on u.roles_role_id=r.role_id
		inner join buildings as b on b.building_id=a.buildings_building_id
		where r.role_name = 'apartment owner'
		and a.subdivisions_subdivision_id = :subdivisionId
		order by b.building_name";

		$stmt = $dbConnection->prepare($sql);

		$stmt->bindValue(':subdivisionId', $subdivisionId, PDO::PARAM_INT);

		$stmt->setFetchMode(PDO::FETCH_CLASS, 'ApartmentOwnerRecord');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}

	function fetchAllBuildingManagerRecordsOfASubdivision($subdivisionId){
		$dbObject = new Database();
		$dbConnection = $dbObject->getDatabaseConnection();

		$sql = "SELECT b.building_name, u.first_name, u.last_name, u.email_id, u.phone_number, u.joining_datetime from users as u
		inner join buildings as b on u.user_id = b.users_user_id 
		inner join roles as r on u.roles_role_id=r.role_id
		where r.role_name = 'building manager'
		and b.subdivisions_subdivision_id = :subdivisionId
		order by b.building_name";

		$stmt = $dbConnection->prepare($sql);

		$stmt->bindValue(':subdivisionId', $subdivisionId, PDO::PARAM_INT);
			
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'BuildingManagerRecord');

		if ($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return 'Failed';
		}
	}




}