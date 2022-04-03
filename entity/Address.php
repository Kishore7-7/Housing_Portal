<?php

class Address {

	public $address_id;
	public $street_address;
	public $street_address_line_2;
	public $city;
	public $state;
	public $zip_code;
	public $country;
	public $users_user_id;

	function __construct($address_id, $street_address, $street_address_line_2, $city, $state, $zip_code, $country, $users_user_id){

		$this->street_address = $street_address;
		$this->street_address_line_2 = $street_address_line_2;
		$this->city = $city;
		$this->state = $state;
		$this->zip_code = $zip_code;
		$this->country = $country;
		$this->users_user_id = $users_user_id;
	}
}