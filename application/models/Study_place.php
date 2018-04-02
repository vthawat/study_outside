<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Study_place extends CI_Model 
{
	var $table='study_place';
	var $desc='สถานที่ศึกษาดูงาน';
	function __construct()
	{
		parent::__construct();
		
			
	}
	function get_all()
	{
		return $this->db->get($this->table)->result();
	}

}

/* End of file template.php */
/* Location: ./application/models/amphur.php */
