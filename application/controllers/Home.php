<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->data = array();

			$this->data['content'] = $this->load->view('pages/dashboard',$this->data, true );
	    	$this->load->view('layouts/main-home', $this->data );
		}
		else
		{		

			$this->data = array();
			$this->data['content'] = $this->load->view('pages/landingpage',$this->data, true );			
	    	$this->load->view('layouts/main', $this->data );
		}
	}
}
