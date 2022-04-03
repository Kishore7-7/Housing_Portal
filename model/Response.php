<?php

class Response {

	public $message;
	public $errorMessage;
	public $comments;

	function __construct($message, $errorMessage, $comments){
		$this->message = $message;
		$this->errorMessage = $errorMessage;
		$this->comments = $comments;
	}
}