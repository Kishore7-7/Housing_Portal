<?php

class ResponsibleContact {

	public $responsible_contact_id;
	public $name;
	public $address;
	public $city;
	public $zip_code;
	public $country;
	public $phone_number;
	public $users_user_id;

	function __construct($responsible_contact_id, $name, $address, $city, $zip_code, $country, $phone_number, $users_user_id){

		$this->responsible_contact_id = $responsible_contact_id;
		$this->name = $name;
		$this->address = $address;
		$this->city = $city;
		$this->zip_code = $zip_code;
		$this->country = $country;
		$this->phone_number = $phone_number;
		$this->users_user_id = $users_user_id;
	}
}