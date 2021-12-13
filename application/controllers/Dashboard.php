<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
		$this->data = array();

		$this->data['content'] = $this->load->view('pages/landingpage',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
	}
}
