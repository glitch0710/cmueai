<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
	    parent::__construct();
	    if(!$this->session->userdata('logged_in')) redirect('home',301);    
	    $this->load->model("user_model");
	}

	public function index()
	{
		$this->data = array();
		$this->data['content'] = $this->load->view('pages/user_account/home',$this->data, true );			
    	$this->load->view('layouts/main-home', $this->data );
	}

	public function user_rights()
	{
		$this->data = array();
		$this->data['content'] = $this->load->view('pages/user_group',$this->data, true );			
    	$this->load->view('layouts/main-home', $this->data );
	}
	function deleteusers()
	{
		$username = $this->filtering_process->allowed_input_username($this->input->post('username'));
		if($username=="")
		{
			redirect('home',301);
		}
		else
		{
			$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
			if($session_log=="session-user-log") // session for ajax is active
			{		
				$data = $this->user_model->delete_user_credentials($username);
				$res = array('status' => "success" , "message" =>"success"  );
				echo json_encode($res);
			}
			else // session for ajax is not active
			{

			}
		}
	}
	function updateuser()
	{

		$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
		if($session_log=="session-user-log") // session for ajax is active
		{
			$email = $this->filtering_process->test_input($this->input->post('email'));
		    if($email=="")
		    {
		        $res = array('status' => "error" , "message" =>"no email" ,"data" =>"" ,);
		        echo json_encode($res);
		        exit();
		    }
		    $infodesc = $this->filtering_process->test_input($this->input->post('infodesc'));
		    if($infodesc=="")
		    {
		        $res = array('status' => "error" , "message" =>"" ,"data" =>"" ,);
		        echo json_encode($res);
		        exit();
		    }
		    
		    $is_pass = '';
		    $npwd = $this->filtering_process->password($this->input->post('password',true));
		    if($npwd !='') //password is inputted
		    {
		    	$rules = array(
			       
			        array('field'   => 'email', 'label'   => 'Email Address', 'rules'   => 'trim|required|valid_email', 'errors' => array('required' => "Email field must not leave a blank.",'valid_email' => "Invalid Email Format.",),),
			        array('field'   => 'firstname', 'label'   => 'Firstname', 'rules'   => 'required', 'errors' => array('required' => "Firstname field must not leave a blank.",),),
			        
			        array('field'   => 'lastname', 'label'   => 'Lastname', 'rules'   => 'required', 'errors' => array('required' => "Lastname field must not leave a blank.",),),
			        array('field'   => 'password','label'   => 'password','rules'   => 'required|min_length[9]', 'errors' => array('required' => "Password field must not leave a blank.",'min_length' => "Password Must Be 9 Characters and above.",),),
			    );
			    $is_pass = true;
		    }
		    else
		    {
		    	$rules = array(
			       
			        array('field'   => 'email', 'label'   => 'Email Address', 'rules'   => 'trim|required|valid_email', 'errors' => array('required' => "Email field must not leave a blank.",'valid_email' => "Invalid Email Format.",),),
			        array('field'   => 'firstname', 'label'   => 'Firstname', 'rules'   => 'required', 'errors' => array('required' => "Firstname field must not leave a blank.",),),
			        
			        array('field'   => 'lastname', 'label'   => 'Lastname', 'rules'   => 'required', 'errors' => array('required' => "Lastname field must not leave a blank.",),),
			    );
		    }

		    $this->form_validation->set_rules( $rules );
		    if( $this->form_validation->run() ){
		    	$obj = [];
		        $error_msg = "";       
		        $error_stat =""; 
		        $check_allowed_username = $this->filtering_process->check_allowed_username($this->input->post('uusername',true));
		        if($check_allowed_username !=true)
		        {
		            $error_stat =1;
		            $error_msg ='Username allowed only letters , numbers , underline (_) and periods (.). Spaces is not allowed.';
		            $data = array(
		                'field' =>'username', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }

		        $check_allowed_input_text = $this->filtering_process->check_allowed_input_text($this->input->post('firstname',true));
		        if($check_allowed_input_text !=true)
		        {
		            $error_stat =1;
		            $error_msg ='Firstname allowed only letters and numbers.';
		            $data = array(
		                'field' =>'firstname', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }

		        $check_allowed_input_text = $this->filtering_process->check_allowed_input_text($this->input->post('middlename',true));
		        if($check_allowed_input_text !=true)
		        {
		            $error_stat =1;
		            $error_msg ='<li>Middlename allowed only letters and numbers<li>';
		            $data = array(
		                'field' =>'middlename', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }

		        $check_allowed_input_text = $this->filtering_process->check_allowed_input_text($this->input->post('lastname',true));
		        if($check_allowed_input_text !=true)
		        {
		            $error_stat =1;
		            $error_msg ='<li>Lastname allowed only letters and numbers<li>';
		            $data = array(
		                'field' =>'lastname', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }


		        if($error_stat == 1){
		            $res = array('status' => "error" , "message" =>"error registration" ,"data" =>$obj, );
		            echo json_encode($res);
		            exit();
		        }

		        if($is_pass==true){
		        	$rules = array(
			            array('field'=>'password_confirmation','label'=>'password confirmation','rules'=>'required|matches[password]', 'errors' => array('matches' => "Password Does Not Match.",),),
			        );
			        $this->form_validation->set_rules( $rules );

			        if( $this->form_validation->run() ){
			        	$designation = $this->filtering_process->allowed_input($this->input->post('designation',true));
			        	$fname = $this->filtering_process->allowed_input($this->input->post('firstname',true));
			            $mname = $this->filtering_process->allowed_input($this->input->post('middlename',true));
			            $lname = $this->filtering_process->allowed_input($this->input->post('lastname',true));
			            $email = $this->filtering_process->allowed_input_email($this->input->post('email',true));
			            $username = $this->filtering_process->allowed_input_username($this->input->post('uusername',true));
			            $npwd = $this->filtering_process->password($this->input->post('password',true));
			            $authen = array(
			                'Firstname'  => $fname,
			                'Lastname'    => $lname,
			                'Middlename'    => $mname,
			                'Email'      => $email,
			                'Username'      => $username,
			                'designation'      => $designation,
			                'CreatedBy'      => $this->session->userdata('systemUid'),
			               
			                'Password'    =>  $this->encryption->encrypt($npwd),
			            );
			        }
			        else
			        {
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
		        else
		        {
		        	$designation = $this->filtering_process->allowed_input($this->input->post('designation',true));
		        	$fname = $this->filtering_process->allowed_input($this->input->post('firstname',true));
		            $mname = $this->filtering_process->allowed_input($this->input->post('middlename',true));
		            $lname = $this->filtering_process->allowed_input($this->input->post('lastname',true));
		            $email = $this->filtering_process->allowed_input_email($this->input->post('email',true));
		            $username = $this->filtering_process->allowed_input_username($this->input->post('uusername',true));
		            $authen = array(
		                'Firstname'  => $fname,
		                'Lastname'    => $lname,
		                'Middlename'    => $mname,
		                'Email'      => $email,
		                'Username'      => $username,
		                'designation'      => $designation,
		                'CreatedBy'      => $this->session->userdata('systemUid'),
		               
		            );
		        }
		        $this->user_model->update_user_info($authen,$infodesc);

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
		else
		{

		}
	}
	function showinfo()
	{
		$username = $this->filtering_process->allowed_input_username($this->input->post('username'));
		if($username=="")
		{
			redirect('home',301);
		}
		else
		{
			$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
			if($session_log=="session-user-log") // session for ajax is active
			{		
				$data = $this->user_model->showinfo_user_credentials($username);
				$info_report = "";
				
					if($data->status_info==1)
					{
						$status = "Active";
					}
					elseif($data->status_info==0)
					{
						$status = "Inactive";
					}
					else
					{
						$status = "";
					}
					$info_report = array(
						'Firstname' => $data->Firstname,
						'Lastname' => $data->Lastname,
						'Middlename' => $data->Middlename,
						'Designation' => $data->Designation,
						'Email' => $data->Email, 
						'ContactNo' => $data->ContactNo,
						'Username' => $data->Username,
						'status_info' => $status,
						'infodesc' => $data->UserID,
					);
				
				
				$res = array('status' => "success" , "message" =>"success" ,"data" =>$info_report );
				echo json_encode($res);
			}
			else // session for ajax is not active
			{

			}
		}
	}

	function saveuser()
	{
		$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
		if($session_log=="session-user-log") // session for ajax is active
		{
			$email = $this->filtering_process->test_input($this->input->post('email'));
		    if($email=="")
		    {
		        $res = array('status' => "error" , "message" =>"no email" ,"data" =>"" ,);
		        echo json_encode($res);
		        exit();
		    }
		    $rules = array(
		        array('field'   => 'username', 'label'   => 'Username', 'rules'   => 'trim|required|min_length[5]|max_length[20]|is_unique[tbl_useraccounts.username]',
		         'errors' => array('is_unique' => "Username already registered." ,'required' => "Username field must not leave a blank.", 'min_length' => "Minimum length of Characters for Username is 5 characters.",  'max_length' => "Maximum length of Characters for Username is limited to 20 characters.",   ),),
		        array('field'   => 'email', 'label'   => 'Email Address', 'rules'   => 'trim|required|valid_email|is_unique[tbl_useraccounts.email]', 'errors' => array('is_unique' => 'Email already registered.','required' => "Email field must not leave a blank.",'valid_email' => "Invalid Email Format.",),),
		        array('field'   => 'firstname', 'label'   => 'Firstname', 'rules'   => 'required', 'errors' => array('required' => "Firstname field must not leave a blank.",),),
		        
		        array('field'   => 'lastname', 'label'   => 'Lastname', 'rules'   => 'required', 'errors' => array('required' => "Lastname field must not leave a blank.",),),
		        array('field'   => 'password','label'   => 'password','rules'   => 'required|min_length[9]', 'errors' => array('required' => "Password field must not leave a blank.",'min_length' => "Password Must Be 9 Characters and above.",),),
		    );
		    $this->form_validation->set_rules( $rules );
		    if( $this->form_validation->run() ){
		    	$obj = [];
		        $error_msg = "";       
		        $error_stat =""; 
		        $check_allowed_username = $this->filtering_process->check_allowed_username($this->input->post('username',true));
		        if($check_allowed_username !=true)
		        {
		            $error_stat =1;
		            $error_msg ='Username allowed only letters , numbers , underline (_) and periods (.). Spaces is not allowed.';
		            $data = array(
		                'field' =>'username', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }

		        $check_allowed_input_text = $this->filtering_process->check_allowed_input_text($this->input->post('firstname',true));
		        if($check_allowed_input_text !=true)
		        {
		            $error_stat =1;
		            $error_msg ='Firstname allowed only letters and numbers.';
		            $data = array(
		                'field' =>'firstname', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }

		        $check_allowed_input_text = $this->filtering_process->check_allowed_input_text($this->input->post('middlename',true));
		        if($check_allowed_input_text !=true)
		        {
		            $error_stat =1;
		            $error_msg ='<li>Middlename allowed only letters and numbers<li>';
		            $data = array(
		                'field' =>'middlename', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }

		        $check_allowed_input_text = $this->filtering_process->check_allowed_input_text($this->input->post('lastname',true));
		        if($check_allowed_input_text !=true)
		        {
		            $error_stat =1;
		            $error_msg ='<li>Lastname allowed only letters and numbers<li>';
		            $data = array(
		                'field' =>'lastname', 
		                'msg' => $error_msg, 
		            );
		            array_push($obj,$data);
		        }


		        if($error_stat == 1){
		            $res = array('status' => "error" , "message" =>"error registration" ,"data" =>$obj, );
		            echo json_encode($res);
		            exit();
		        }

		        $rules = array(
		            array('field'=>'password_confirmation','label'=>'password confirmation','rules'=>'required|matches[password]', 'errors' => array('matches' => "Password Does Not Match.",),),
		        );
		        $this->form_validation->set_rules( $rules );
		        if( $this->form_validation->run() ){
		        	$designation = $this->filtering_process->allowed_input($this->input->post('designation',true));
		        	$fname = $this->filtering_process->allowed_input($this->input->post('firstname',true));
		            $mname = $this->filtering_process->allowed_input($this->input->post('middlename',true));
		            $lname = $this->filtering_process->allowed_input($this->input->post('lastname',true));
		            $email = $this->filtering_process->allowed_input_email($this->input->post('email',true));
		            $username = $this->filtering_process->allowed_input_username($this->input->post('username',true));
		            $npwd = $this->filtering_process->password($this->input->post('password',true));
		            $authen = array(
		                'Firstname'  => $fname,
		                'Lastname'    => $fname,
		                'Middlename'    => $fname,
		                'Email'      => $email,
		                'Username'      => $username,
		                'designation'      => $designation,
		                'CreatedBy'      => $this->session->userdata('systemUid'),
		                'Status'      => 1,
		                'AccessLevelID'    =>  default_accesslevel ,
		                'Password'    =>  $this->encryption->encrypt($npwd),
		                'CreatedOn'    => date("Y-m-d H:i:s"),
		            );
		            $this->user_model->save_user_credentials($authen);

		            $message = "Thanks for registering!";  
	                $res = array('status' => "success" , "message" =>$message ,"data" =>"confirmation", );
	                echo json_encode($res);
	                exit();
		        }
		        else
		        {
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
		else  // session for ajax is not active
		{

		}
	}

	function load_report_usersinfo()
	{
		$session_log = $this->filtering_process->test_input($this->encryption->decrypt($this->input->post('session_log')));
		if($session_log=="session-user-log") // session for ajax is active
		{
			$limitview_count =  $this->filtering_process->test_input($this->input->post('limitview_count'));
			$search_value =  $this->filtering_process->test_input($this->input->post('search_value'));
			if(!(is_numeric($this->input->post('limitview_count'))))
			{
				$limitview_count =5;
			}
			$data = array('limitview_count' => $limitview_count , 'search_value' => $search_value, );
			$result = $this->user_model->load_report_usersinfo($data);

			$output = array('message' => "success",'data_report' => $result );
			echo json_encode($output);
		}
		else
		{

		}
	}
}
