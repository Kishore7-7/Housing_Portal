<?php

class Database {

	public function getDatabaseConnection(){

		// $dbHost = "localhost";
		// $dbName = "city_view_db";
		// $dbUser = "root";
		// $dbPassword = "";

		// Amlan UTA cloud cred
		$dbHost = "localhost";
		$dbName = "axa5861_city_view";
		$dbUser = "axa5861_admin";
		$dbPassword = "cityview99";

		$dsn = 'mysql:host=' . $dbHost . ';dbname=' . $dbName . ';charset=utf8';

		try {

			$dbConnection = new PDO($dsn, $dbUser, $dbPassword);
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnection;

		} catch (PDOException $e) {
			echo $e->getMessage();
			// exit;
		}

		
	}
}