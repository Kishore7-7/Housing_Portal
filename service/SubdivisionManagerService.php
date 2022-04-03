<?php

require 'MasterRecordService.php';
require 'SubdivisionService.php';
// require '../model/SubdivisionUtilityBillRecord.php';
require 'UserService.php';
require '../../service/ITRequestService.php';
require '../../model/SubdivisionDashboardData.php';

class SubdivisionManagerService {


	function checkFeature($userId){
		
		if (isset($_POST['it-request-input-message'])){
	        
	        $itrMsg = $_POST['it-request-input-message'];

			$itrService = new ITRequestService();
			$itrService->saveITR($userId, $itrMsg);
	    }	
	 
	    else {
	    	echo "Nothing Matched";
	    }
	}

	function getDashboardDataPerUtility($userId){
		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);
		$subdivisionId = $subdivisionRecord->subdivision_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		// $month = $date->format('m');
		$year = $date->format('Y');

		$maxMonth = 12;
		$utilityNameList = ['electricity', 'gas', 'water'];

		$electricityMonthlyBillPerYearList = [];
		$gasMonthlyBillPerYearList = [];
		$waterMonthlyBillPerYearList = [];

		foreach($utilityNameList as $utilityName){
			for($i=1;$i<=$maxMonth;$i=$i+1){

				$month = $i;

				$utilityBillRecord = $subdivisionService->getCurrentMonthUtilityBillsAllApartmentsForOneUtility($subdivisionId, $month, $year, $utilityName);
				// echo "-------		echo "-----1----";-------";
				// var_dump($utilityBillRecord);
				$monthTotal = $utilityBillRecord['SUM(aub.utility_monthly_bill_amount)'];
				$utilityNameOfTotal = $utilityBillRecord['utility_name'];

				if ($utilityNameOfTotal == 'electricity'){
					if ($monthTotal != NULL){
						// echo $monthTotal;
						array_push($electricityMonthlyBillPerYearList, $monthTotal);
					}
					else{
						// echo "No";
						array_push($electricityMonthlyBillPerYearList, 0);
					}
				}
				elseif ($utilityNameOfTotal == 'gas'){
					if ($monthTotal != NULL){
						// echo $monthTotal;
						array_push($gasMonthlyBillPerYearList, $monthTotal);
					}
					else{
						// echo "No";
						array_push($gasMonthlyBillPerYearList, 0);
					}
				}
				elseif ($utilityNameOfTotal == 'water'){
					if ($monthTotal != NULL){
						// echo $monthTotal;
						array_push($waterMonthlyBillPerYearList, $monthTotal);
					}
					else{
						// echo "No";
						array_push($waterMonthlyBillPerYearList, 0);
					}
				}
				
			}
		}
		// echo "-----elec----";
		// var_dump($electricityMonthlyBillPerYearList);
		// echo "-----gas----";
		// var_dump($gasMonthlyBillPerYearList);
		// echo "-----water----";
		// var_dump($waterMonthlyBillPerYearList);

		
		// $monthData = ['Jan','Feb','Mar','Apr','May',];
		// $billTotal = [10,20,30];

		$sdd = new SubdivisionDashboardData();
		$sdd->monthNumbers = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
		$sdd->electricityMonthTotal = $electricityMonthlyBillPerYearList;
		$sdd->gasMonthTotal = $gasMonthlyBillPerYearList;
		$sdd->waterMonthTotal = $waterMonthlyBillPerYearList;
		return $sdd;

	}

	function communityServiceReportData($userId){

		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $subdivisionService->getCurrentMonthCommunityServiceBillsAllApartments($subdivisionId, $month, $year);

	}

	function utilityReportData($userId){

		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $subdivisionService->getCurrentMonthUtilityBillsAllApartments($subdivisionId, $month, $year);

	}

	function getApartmentCount($userId){
		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;

		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $subdivisionService->getApartmentCount($subdivisionId, $month, $year);
	}

	function getUtilityBillTotal($userId){

		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;

		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $subdivisionService->getUtilityBillTotal($subdivisionId, $month, $year);
	}

	function getPreviousMonth(){
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		return $month;
	}

	function getPreviousMonthYear(){
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );

		return  $date->format('Y');
	}

	function getPersonalDetails($userId){
		$userService = new UserService();
    	return $userService->getuserById($userId);
	}

	function getCommunityServiceApartmentCount($userId){
		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;

		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $subdivisionService->getCommunityServiceApartmentCount($subdivisionId, $month, $year);
	}

	function getCommunityServiceBillTotal($userId){

		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;

		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $subdivisionService->getCommunityServiceBillTotal($subdivisionId, $month, $year);
	}

	function fetchAllITRequests($userId){
		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;
		
		$itrService = new ITRequestService();
		return $itrService->fetchAllITRequestBySubdivisionId($subdivisionId);
	}

	function fetchAllApartmentOwnerRecords($userId){

		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;

		$masterRecordService = new MasterRecordService();
		$apartmentOwnerRecordList = $masterRecordService->fetchAllApartmentOwnerRecordsOfASubdivision($subdivisionId);
		return $apartmentOwnerRecordList;
	}

	function fetchAllBuildingManagerRecords($userId){
		$subdivisionService = new SubdivisionService();
		$subdivisionRecord = $subdivisionService->getSubdivisionRecordByUserId($userId);
		// var_dump($subdivisionRecord);

		$subdivisionId = $subdivisionRecord->subdivision_id;

		$masterRecordService = new MasterRecordService();
		$buildingManagerRecordList = $masterRecordService->fetchAllBuildingManagerRecordsOfASubdivision($subdivisionId);
		return $buildingManagerRecordList;
	}
}