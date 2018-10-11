<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Study_trip extends CI_Model 
{
	var $table='study_period_trip';
	var $desc='่กำหนดการเดินทางศึกษาดูงาน';
	function __construct()
	{
		parent::__construct();
			
	}
	function get_all()
	{
		return $this->db->get($this->table)->result();
	}
	function post_trip()
	{
		$data=$this->input->post();
		$data['subject_major_selected']=json_encode($data['subject_major_selected']);
		$data['knowledge_selected']=json_encode($data['knowledge_selected']);
		$data['status']='อยู่ระหว่างการดำเนินการ'; // set init status
		// change format date dd/mm/yyyy to yyyy-mm-dd
		$start_date=explode('/',$data['start_date']);
		$end_date=explode('/',$data['end_date']);
		$data['start_date']=$start_date[2].'-'.$start_date[1].'-'.$start_date[0];
		$data['end_date']=$end_date[2].'-'.$end_date[1].'-'.$end_date[0];
		if($this->db->insert($this->table,$data)) return TRUE;
		else return FALSE;
	}
	
	

}

/* End of file template.php */
/* Location: ./application/models/Study_trip.php */
