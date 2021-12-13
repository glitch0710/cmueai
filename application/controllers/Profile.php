<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	    if(!$this->session->userdata('logged_in')) redirect('home',301);    
	}

	public function index()
	{
		redirect('home',301);	
	}

	public function logout()
	{
		$this->session->set_userdata(array(
			'logged_in'  => '',
			'systemUid'=> '',
    		'FirstName'=>'',
    		'MiddleName'=> '',
    		'LastName'=> '',
    		'AccessLevelID'=> '',
		));
		redirect('home',301);	
	}
}
