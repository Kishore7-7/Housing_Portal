
<?php

require '../../service/MRService.php';
require '../../service/ComplaintsService.php';
require '../../service/ApartmentService.php';
require '../../model/ApartmentDashboardData.php';

class ApartmentOwnerService {


	function checkFeature($userId){

		if (isset($_POST['maintenance-request-input-message'])){

			$mrMsg = $_POST['maintenance-request-input-message'];

			$mrService = new MRService();
			$mrService->saveMR($userId, $mrMsg);
			
		}
	}

	function getDashboardDataPerUtility($userId){

		$apartmentService = new ApartmentService();
		$apartmentRecord = $apartmentService->getApartmentRecordByUserId($userId);
		// var_dump($apartmentRecord);

		$apartmentId = $apartmentRecord->apartment_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		// $month = $date->format('m');
		$year = $date->format('Y');

		$maxMonth = 12;
		$utilityNameList = ['electricity', 'gas', 'water', 'internet'];

		$electricityMonthlyBillPerYearList = [];
		$gasMonthlyBillPerYearList = [];
		$waterMonthlyBillPerYearList = [];
		$internetMonthlyBillPerYearList = [];

		foreach($utilityNameList as $utilityName){
			for($i=1;$i<=$maxMonth;$i=$i+1){

				$month = $i;

				$utilityBillRecord = $apartmentService->getCurrentMonthUtilityBillsForApartmentForOneUtility($apartmentId, $month, $year, $utilityName);
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
				elseif ($utilityNameOfTotal == 'internet'){
					if ($monthTotal != NULL){
						// echo $monthTotal;
						array_push($internetMonthlyBillPerYearList, $monthTotal);
					}
					else{
						// echo "No";
						array_push($internetMonthlyBillPerYearList, 0);
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
		// echo "-----internet----";
		// var_dump($internetMonthlyBillPerYearList);

		$add = new ApartmentDashboardData();
		$add->monthNumbers = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
		$add->electricityMonthTotal = $electricityMonthlyBillPerYearList;
		$add->gasMonthTotal = $gasMonthlyBillPerYearList;
		$add->waterMonthTotal = $waterMonthlyBillPerYearList;
		$add->internetMonthTotal = $internetMonthlyBillPerYearList;
		return $add;

	}

	function communityServiceReportData($userId){

		$apartmentService = new ApartmentService();
		$apartmentRecord = $apartmentService->getApartmentRecordByUserId($userId);
		// var_dump($apartmentRecord);

		$apartmentId = $apartmentRecord->apartment_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $apartmentService->getLastMonthCommunityServiceBillForApartment($apartmentId, $month, $year);

	}

	function getCommunityServiceBillTotal($userId){

		$apartmentService = new ApartmentService();
		$apartmentRecord = $apartmentService->getApartmentRecordByUserId($userId);
		// var_dump($apartmentRecord);

		$apartmentId = $apartmentRecord->apartment_id;

		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $apartmentService->getCommunityServiceBillTotal($apartmentId, $month, $year);
	}

	function utilityReportData($userId){

		$apartmentService = new ApartmentService();
		$apartmentRecord = $apartmentService->getApartmentRecordByUserId($userId);
		// var_dump($apartmentRecord);

		$apartmentId = $apartmentRecord->apartment_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $apartmentService->getCurrentMonthUtilityBillOfApartment($apartmentId, $month, $year);

	}

	function getUtilityBillTotal($userId){
		$apartmentService = new ApartmentService();
		$apartmentRecord = $apartmentService->getApartmentRecordByUserId($userId);
		// var_dump($apartmentRecord);

		$apartmentId = $apartmentRecord->apartment_id;
		$date = new DateTime("last month", new DateTimeZone('America/Chicago') );
		$month = $date->format('m');
		$year = $date->format('Y');

		return $apartmentService->getUtilityBillTotal($apartmentId, $month, $year);
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

	function fetchAllMR($userId){
		// $apartmentService = new ApartmentService();
		// $apartmentRecord = $apartmentService->getApartmentRecordByUserId($userId);
		// // var_dump($apartmentRecord);

		// $apartmentId = $apartmentRecord->apartment_id;
		$mrService = new MRService();
		return $mrService->fetchAllMRByUserId($userId);
	}

	function checkComplaints($userId){

		if (isset($_POST['complaints-request-input-message'])){

			$cmMsg = $_POST['complaints-request-input-message'];

			$cmService = new ComplaintsService();
			$cmService->saveComplaints($userId, $cmMsg);
			
		}
	}

	function fetchAllComplaints($userId){
		$cmService = new ComplaintsService();
		return $cmService->fetchAllComplaintsByUserId($userId);
	}
}