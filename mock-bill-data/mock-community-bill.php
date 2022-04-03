<?php

require 'CommunityBillService.php';

$cbService = new CommunityBillService();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // var_dump($_POST);
    $cbService->saveCommunityBill();

}

?>
<!DOCTYPE html>
<html>
	<body>
		<h1>My First Heading</h1>
		<p>My first paragraph.</p>
		<form method="post">
			
			<div>
				<!-- <label for="fname"></label> -->
				<input type="text"  id="fname" name="aptId" value=""  placeholder= "aptId"> <br><br>
				<!-- <label for="lname"></label> -->
				<input type="text" id="lname" name="maintenanceFeeBill" value=""  placeholder= "maintenanceFeeBill"> <br><br>
				<!-- <label for="email"></label> -->
				<input type="text" id="w-bill"  name="poolBill" value=""  placeholder= "poolBill"> <br><br>
				<!-- <label for="password"></label> -->
				<input type="text" id="g-bill"  name="gymBill" value=""  placeholder= "gymBill"> <br><br>

				<input type="text" id="month"  name="month" value=""  placeholder= "month"> <br><br>

				<input type="text" id="year"  name="year" value=""  placeholder= "year"> <br><br>

				<input id="btnSubmit" type="submit" value="Submit">
				
			</div>
		</form>
	</body>
</html>