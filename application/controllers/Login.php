<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	    if($this->session->userdata('logged_in')) redirect('home',301);
	    $this->load->model("user_model");
	}
	public function index()
	{
		$this->data = array();

			$this->data['content'] = $this->load->view('pages/landingpage',$this->data, true );
			
	    	$this->load->view('layouts/main', $this->data );
	}
	function verifyuser()
	{		
		if($this->session->userdata('logged_in')) redirect('home',301);
		$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
		if($session_log=="code_ajax_active") // session for ajax is active
		{
			$email = $this->filtering_process->test_input($this->input->post('email'));
			$password = $this->filtering_process->password($this->input->post('password'));
		    if($email=="")
		    {
		        echo json_encode("no email");
		        exit();
		    }
		    $result = $this->user_model->verify_user_credentials($email);

		    if(count($result)==1)
		    {    	
		    	foreach ($result as $key ) {
		    		if($password==$this->encryption->decrypt($key->Password))
		    		{
		    			$this->session->set_userdata(array(
				    		'logged_in'  => true,
				    		'systemUid'=> $key->UserID,
				    		'FirstName'=> $key->Firstname,
				    		'MiddleName'=>  $key->Middlename,
				    		'LastName'=> $key->Lastname,
				    		'AccessLevelID'=> $key->AccessLevelID,
				    	));
		    			echo json_encode("success");
		    			exit();
		    		}
		    		else
		    		{
		    			echo json_encode("invalid credentials");
		    			exit();
		    		}		    			
		    	}		    	
		    }
		    else
		    {
		    	echo json_encode("invalid credentials");
		    	exit();
		    }
		}
		else // session for ajax is inactive
		{
			$email = $this->filtering_process->test_input($this->input->post('email'));
		    if($email=="")
		    {
		        redirect('home',301);
		    }

		    $res=1;
		    if($res==1)
		    {
		    	$this->session->set_userdata(array(
		    		'logged_in'  => true,
		    	));
		    	//redirect('home',301);
		    }
		    else
		    {
		    	$this->session->set_flashdata('message',SiteHelpers::alert('error','Invalid email or password combination <br /> or your account is not active yet'));
		    	//redirect('home',301);
		    }
		}
	} 
}
