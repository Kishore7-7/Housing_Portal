<?php

class User {

    // public $userId;
    // public $firstName;
    // public $lastName;
    // public $emailId;
    // public $password;
    // public $areaCode;
    // public $phoneNumber;
    // public $joiningDatetime;
    // public $rolesRoleId;
    public $user_id;
    public $first_name;
    public $last_name;
    public $email_id;
    public $password;
    public $area_code;
    public $phone_number;
    public $joining_datetime;
    public $roles_role_id;

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