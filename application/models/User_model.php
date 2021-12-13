<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model 
{
	public function __construct() {
		parent::__construct();
		
	}
	function verify_user_credentials($email)
	{
		$query = $this->db->query("select * from tbl_useraccounts where email='$email' or UserName='$email'");
		return $query->result();
	}

	function save_user_credentials($data)
	{
		$this->db->insert('tbl_useraccounts',$data);
	}

	function delete_user_credentials($data)
	{
		$this->db->query("UPDATE `cmueai`.`tbl_useraccounts` SET `Status` = NULL WHERE `Username` = '$data'");
	}

	function showinfo_user_credentials($username)
	{
		return $this->db->query("select *, tbl_useraccounts.`Status` as status_info from tbl_useraccounts where Username='$username'")->row();
	}
	function update_user_info($array,$tempid)
	{
		$tempid= "'".$tempid."'";
		$i=0;
		$str = '';
		foreach ($array as $key => $value) {
			if($value !='')
			{
				$i++;
				if($i>1)
				{
					$str .= ", ".$key ." ='". $value. "'";
				}
				else
				{
					$str .= $key ." ='". $value. "'";
				}   					
			}
		}
			//return	$tempid;
		$this->db->query('call sp_DynamicUpdate("tbl_useraccounts","'.$str.'","UserID = '.$tempid.'")');
		
	}
	function load_report_usersinfo($data)
	{
		$limitview_count = $data['limitview_count'];
		$search_value = $data['search_value'];

		if($search_value=="")
		{
			$query = $this->db->query("select * from tbl_useraccounts where (`Status` ='0' or `Status` = '1') 
				 order by Lastname limit $limitview_count  ");
		}
		else
		{			
			$query = $this->db->query("select * from tbl_useraccounts where 
				(Username like '%".$search_value."%' or Lastname like '%".$search_value."%' 
				or Middlename like '%".$search_value."%'  or Firstname like '%".$search_value."%' ) 
				 order by Lastname limit $limitview_count  ");
		}
		return $query->result();
	}
}
?>