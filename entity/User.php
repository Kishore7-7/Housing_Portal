<?php

class User {

    public $user_id;
    public $first_name;
    public $last_name;
    public $email_id;
    public $password;
    public $area_code;
    public $phone_number;
    public $joining_datetime;
    public $roles_role_id;

    // function __construct(){

    // }

    /*
        This constructor created issue in admin page. Do not use this.
    */
    // function __construct($userId, $firstName, $lastName, $emailId, $password, $areaCode, $phoneNumber, $joiningDatetime, $rolesRoleId){
        
    //     $this->user_id = $userId;
    //     $this->first_name = $firstName;
    //     $this->last_name = $lastName;
    //     $this->email_id = $emailId;
    //     $this->password = $password;
    //     $this->area_code = $areaCode;
    //     $this->phone_number = $phoneNumber;
    //     $this->joining_datetime = $joiningDatetime;
    //     $this->roles_role_id = $rolesRoleId;

    // }


    function getId(){
        return $this->user_id;
    }

    function setName($name){
        $this->name = $name;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    function getLastName(){
        return $this->lastName;
    }

    function setLastName($lastName){
        $this->lastName = $lastName;
    }

    function getEmailId(){
        return $this->emailId;
    }

    function setEmailId($emailId){
        $this->emailId = $emailId;
    }

    function getPassword($password){
        return $this->password;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getAreaCode(){
        return $this->areaCode;
    }

    function setAreaCode($areaCode){
        $this->areaCode = $areaCode;
    }

    function getPhoneNumber(){
        return $this->phoneNumber;
    }

    function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber;
    }

    function getJoiningDatetime(){
        return $this->joiningDatetime;
    }

    function setJoiningDatetime($joiningDatetime){
        $this->joiningDatetime = $joiningDatetime;
    }

    function getRolesRoleId(){
        return $this->rolesRoleId;
    }

}