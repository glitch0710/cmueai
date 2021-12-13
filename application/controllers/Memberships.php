<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memberships extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	    if(!$this->session->userdata('logged_in')) redirect('home',301);    
	  	$this->load->model("membership_model");
	}
	
	public function index()
	{
		redirect('memberships/members',301);
	}

	public function members($action=null)
	{
		$this->data = array();
		$this->data['content'] = $this->load->view('pages/memberships/members/home',$this->data, true );			
    	$this->load->view('layouts/main-home', $this->data );
	}

	public function load_report($category=null)
	{
		if($category=="plantilla")
		{

		}
		else
		{
			$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
			if($session_log=="session-member-log") // session for ajax is active
			{
				$limitview_count =  $this->filtering_process->test_input($this->input->post('limitview_count'));
				$search_value =  $this->filtering_process->test_input($this->input->post('search_value'));
				if(!(is_numeric($this->input->post('limitview_count'))))
				{
					$limitview_count =5;
				}
				$data = array('limitview_count' => $limitview_count , 'search_value' => $search_value, );
				$result = $this->membership_model->load_report_info($data,'');

				$output = array('message' => "success",'data_report' => $result );
				echo json_encode($output);			}
			else
			{

			}
		}
	}

	public function saveinfo($category=null)
	{
		if($category=="plantilla")
		{

		}
		else
		{
			$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
			if($session_log=="session-member-log") // session for ajax is active
			{
				$rules = array(
					array('field'   => 'empno', 'label'   => 'Employee ID', 'rules'   => 'required', 'errors' => array('required' => "Employee ID field must not leave a blank.",),),
			        array('field'   => 'fname', 'label'   => 'Firstname', 'rules'   => 'required', 'errors' => array('required' => "Firstname field must not leave a blank.",),),
			        array('field'   => 'mname', 'label'   => 'Middlename', 'rules'   => 'required', 'errors' => array('required' => "Middlename field must not leave a blank.",),),
			        array('field'   => 'lname', 'label'   => 'Lastname', 'rules'   => 'required', 'errors' => array('required' => "Lastname field must not leave a blank.",),),

			        array('field'   => 'bday', 'label'   => 'Birthday', 'rules'   => 'required', 'errors' => array('required' => "Birthday field must not leave a blank.",),),
			        array('field'   => 'gender', 'label'   => 'Gender', 'rules'   => 'required', 'errors' => array('required' => "Gender field must not leave a blank.",),),
			        array('field'   => 'position', 'label'   => 'Position', 'rules'   => 'required', 'errors' => array('required' => "Position field must not leave a blank.",),),

			        array('field'   => 'officeassigned', 'label'   => 'Office Assigned', 'rules'   => 'required', 'errors' => array('required' => "Office Assigned field must not leave a blank.",),),
			        array('field'   => 'address', 'label'   => 'Address', 'rules'   => 'required', 'errors' => array('required' => "Address field must not leave a blank.",),),
			        array('field'   => 'spousen', 'label'   => 'Spouse Name', 'rules'   => 'required', 'errors' => array('required' => "Spouse Name field must not leave a blank.",),),
			    );
			    $this->form_validation->set_rules( $rules );
			    if( $this->form_validation->run() ){
			    	$obj = [];
			        $error_msg = "";       
			        $error_stat =""; 

			        $empno = $this->filtering_process->check_allowed_input_text($this->input->post('empno',true));
			        if($empno !=true)
			        {
			            $error_stat =1;
			            $error_msg ='Employee ID allowed only letters and numbers.';
			            $data = array(
			                'field' =>'empno', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$empno = $this->filtering_process->allowed_input($this->input->post('empno',true));
			        }

			        $fname = $this->filtering_process->check_allowed_input_text($this->input->post('fname',true));
			        if($fname !=true)
			        {
			            $error_stat =1;
			            $error_msg ='Firstname allowed only letters and numbers.';
			            $data = array(
			                'field' =>'firstname', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$fname = $this->filtering_process->allowed_input($this->input->post('fname',true));
			        }

			        $mname = $this->filtering_process->check_allowed_input_text($this->input->post('mname',true));
			        if($mname !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Middlename allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'middlename', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$mname = $this->filtering_process->allowed_input($this->input->post('mname',true));
			        }


			        $lname = $this->filtering_process->check_allowed_input_text($this->input->post('lname',true));
			        if($lname !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Lastname allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'lastname', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$lname = $this->filtering_process->allowed_input($this->input->post('lname',true));
			        }

			        $NameExt = $this->filtering_process->check_allowed_input_text($this->input->post('NameExt',true));
			        if($NameExt !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Name Extension Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'lastname', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$NameExt = $this->filtering_process->allowed_input($this->input->post('NameExt',true));
			        }

			        $bday = $this->filtering_process->check_date($this->input->post('bday',true));
			        if($bday !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Invalid Birthday Format<li>';
			            $data = array(
			                'field' =>'bday', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$bday = $this->input->post('bday',true);
			        }

			        $gender = $this->filtering_process->check_allowed_input_text($this->input->post('gender',true));
			        if($gender !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Gender Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'gender', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$gender = $this->filtering_process->allowed_input($this->input->post('gender',true));
			        }

			        $civil_status = $this->filtering_process->check_allowed_input_text($this->input->post('civil_status',true));
			        if($civil_status !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Gender Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'gender', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$civil_status = $this->filtering_process->allowed_input($this->input->post('civil_status',true));
			        }

			        $position = $this->filtering_process->check_allowed_input_text($this->input->post('position',true));
			        if($position !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Position allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'position', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$position = $this->filtering_process->allowed_input($this->input->post('position',true));
			        }

			        $officeassigned = $this->filtering_process->check_allowed_input_text($this->input->post('officeassigned',true));
			        if($officeassigned !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Position allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'officeassigned', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$officeassigned = $this->filtering_process->allowed_input($this->input->post('officeassigned',true));
			        }

			        $address = $this->filtering_process->check_allowed_input_text($this->input->post('address',true));
			        if($address !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Address allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'address', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$address = $this->filtering_process->allowed_input($this->input->post('address',true));
			        }

			        $address = $this->filtering_process->check_allowed_input_text($this->input->post('address',true));
			        if($address !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Address allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'address', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$address = $this->filtering_process->allowed_input($this->input->post('address',true));
			        }

			        $spbday = $this->filtering_process->check_date($this->input->post('spbday',true));
			        if($spbday !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Invalid Birthday Format in Spouse Birthday<li>';
			            $data = array(
			                'field' =>'spbday', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$spbday = $this->input->post('spbday',true);
			        }


			        $spposition = $this->filtering_process->check_allowed_input_text($this->input->post('spposition',true));
			        if($spposition !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Spouse Assigned allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'spposition', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$spposition = $this->filtering_process->allowed_input($this->input->post('spposition',true));
			        }

			        $spousen = $this->filtering_process->check_allowed_input_text($this->input->post('spousen',true));
			        if($spousen !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Spouse Assigned allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'spousen', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$spousen = $this->filtering_process->allowed_input($this->input->post('spousen',true));
			        }

			        $checkspouseemp = $this->filtering_process->check_allowed_input_text($this->input->post('checkspouseemp',true));
			        if($checkspouseemp !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Spouse Assigned allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'checkspouseemp', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$checkspouseemp = $this->filtering_process->allowed_input($this->input->post('checkspouseemp',true));
			        	if($checkspouseemp=="yes")
			        	{
			        		$checkspouseemp = 1;
			        	}
			        	else
			        	{
			        		$checkspouseemp = 0;
			        	}
			        }

			        $fdatestart = $this->filtering_process->check_date($this->input->post('fdatestart',true));
			        if($fdatestart !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Invalid Date Format in Date of Work Started<li>';
			            $data = array(
			                'field' =>'fdatestart', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$fdatestart = $this->input->post('fdatestart',true);
			        }

			        $gsisnum = $this->filtering_process->check_allowed_input_text($this->input->post('gsisnum',true));
			        if($gsisnum !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>GSIS Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'gsisnum', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$gsisnum = $this->filtering_process->allowed_input($this->input->post('gsisnum',true));
			        }

			        $phnum = $this->filtering_process->check_allowed_input_text($this->input->post('phnum',true));
			        if($phnum !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>PhilHealth Number Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'phnum', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$phnum = $this->filtering_process->allowed_input($this->input->post('phnum',true));
			        }

			        $sssnum = $this->filtering_process->check_allowed_input_text($this->input->post('sssnum',true));
			        if($sssnum !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>SSS Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'sssnum', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$sssnum = $this->filtering_process->allowed_input($this->input->post('sssnum',true));
			        }

			        $tinnum = $this->filtering_process->check_allowed_input_text($this->input->post('tinnum',true));
			        if($tinnum !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>TIN Field allowed only letters and numbers<li>';
			            $data = array(
			                'field' =>'tinnum', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$tinnum = $this->filtering_process->allowed_input($this->input->post('tinnum',true));
			        }

			        $cnum = $this->filtering_process->check_allowed_contactno($this->input->post('cnum',true));
			        if($cnum !=true)
			        {
			            $error_stat =1;
			            $error_msg ='<li>Contact No Field allowed only numbers<li>';
			            $data = array(
			                'field' =>'cnum', 
			                'msg' => $error_msg, 
			            );
			            array_push($obj,$data);
			        }
			        else
			        {
			        	$tinnum = $this->filtering_process->allowed_input($this->input->post('tinnum',true));
			        }

			        if($error_stat == 1){
			            $res = array('status' => "error" , "message" =>"error registration" ,"data" =>$obj, );
			            echo json_encode($res);
			            exit();
			        }

			        $data = array(
			        	'Firstname' => $fname ,
			        	'Lastname' => $mname ,
			        	'MiddleName' => $lname ,
			        	'NameExt' => $NameExt,
			        	'Gender' => $gender,
			        	'Position' => $position,
			        	'OfficeAssigned' =>$officeassigned ,
			        	'Address' => $address ,
			        	'Birthdate' => $bday,
			        	'CivilStatus' => $civil_status,
			        	'SpouseName' => $spousen,
			        	'isSpouseCMUEmp' =>$checkspouseemp,
			        	'SpouseAssignment' => $spposition,
			        	'SpouseBirthdate' => $spbday ,
			        	'EmpIDNo' => $empno,
			        	'FirstDayOfService' => $fdatestart,
			        	'GSIS' =>$gsisnum,
			        	'SSS' => $sssnum,
			        	'PhilHealth' =>$phnum ,
			        	'ActiveStatus' =>1 ,
			        	'TIN' => $tinnum,
			        	'ContactNo' => $cnum,
			        	'CreatedBy' => $this->session->userdata('systemUid') ,
			        	 );
			        $this->membership_model->save_profile_info($data,"");
			      	$message = "Thanks for registering!";  
	                $res = array('status' => "success" , "message" =>$message ,"data" =>"confirmation", );
	                echo json_encode($res);
	                exit();
			    }
			    else
			    {
			    	$obj = [];
			        foreach ($this->form_validation->error_array()as $key =>$value ) {
			            $data = array(
			                'field' => $key, 
			                'msg' => $value, 
			            );
			            array_push($obj,$data);
			        }
			        $res = array('status' => "error" , "message" =>"error registration" ,"data" =>$obj, );
			        echo json_encode($res);
			        exit();
			    }
			}
			else // session for ajax is inactive
			{

			}
		}
	}
}
