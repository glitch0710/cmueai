<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class filtering_process {

	function test_input($data) {
		//$data = preg_replace('/[^a-zA-Z0-9-_.@!=+$() ]/', '', $data);
		//$data = preg_replace('/[^a-zA-Z0-9-#@:_(),.!@"\/Ññ ]/', '', $data);
		$data = preg_replace('/[^a-zA-Z0-9-#@:_,.!@"\/Ññ ]/', '', $data);
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);	
	  	  
	  	return $data;
	}

	function allowed_input_email($data) {
		$data = preg_replace('/[^a-zA-Z0-9-_.@ ]/', '', $data);
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);	
	  	
	  	return $data;
	}

	function allowed_input_special($data) {

		$data = preg_replace('/[^a-zA-Z0-9-_.@!=+$()Ññ ]/', '', $data);
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);	
	  	
	  	return $data;
	}
	function allowed_input($data) {

		$data = preg_replace('/[^a-zA-Z0-9-Ññ. -]/', '', $data);
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);	
	  	
	  	return $data;
	}
	function allowed_input_contactno($data) {

		$data = preg_replace('/[^0-9+ ]/', '', $data);
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);	
	  	 
	  	return $data;
	}
	function allowed_input_username($data) {

		$data = preg_replace('/[^a-zA-Z0-9-_.]/', '', $data);
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  		
	  	return $data;
	}

	function allowed_input_date($data) {
	  	$data = trim($data);
	  	$tempDate = date("Y-m-d", strtotime($data));
	}

	function check_allowed_input($str) {
	    return !preg_match('/[^a-zA-Z0-9-_.@!=+$()Ññ]/', $str);
	}
	function check_allowed_contactno($str) {
	    return !preg_match('/[^0-9+ ]/', $str);
	}
	function check_allowed_input_text($str) {
	    return !preg_match('/[^a-zA-Z0-9Ññ. -]/', $str);
	}
	function check_allowed_username($str) {
	    return !preg_match('/[^a-zA-Z0-9-_.]/', $str);
	}

	function check_date($data)
	{
		$tempDate = explode('-',date("Y-m-d", strtotime($data)));
		return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);

	}
	function password($data)
	{
		$data = trim($data);
	  	
	  	$data = htmlspecialchars($data);	  
	  	return $data;
	}
	
}