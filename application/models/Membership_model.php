<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Membership_model extends CI_Model 
{
	public function __construct() {
		parent::__construct();
		
	}

	function load_report_info($data,$category)
	{
		if($category=="plantilla")
		{

		}
		else
		{
			$limitview_count = $data['limitview_count'];
			$search_value = $data['search_value'];

			if($search_value=="")
			{
				$query = $this->db->query("select * from tbl_membership where (`ActiveStatus` ='0' or `ActiveStatus` = '1') 
					 order by Lastname limit $limitview_count  ");
			}
			else
			{			
				$query = $this->db->query("select * from tbl_membership where 
					(Lastname like '%".$search_value."%' 
					or Middlename like '%".$search_value."%'  or Firstname like '%".$search_value."%' ) 
					 order by Lastname limit $limitview_count  ");
			}
			return $query->result();
		}
	}
	
	function save_profile_info($data,$category)
	{
		
		if($category=="plantilla")
		{

		}
		else
		{
			
			foreach(array_keys($data) as $h) 
				$data[$h] = $this->db->escape($data[$h]);
			

			$str_cols = implode(', ', $data);

			$this->db->query("CALL sp_InsertMembership({$str_cols})");
		}

	}
	
}
?>