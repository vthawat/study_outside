<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userinfo extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
		
			
	}
	function get_all()
		{
			return $this->db->get('user_privilage')->result();
		}
	function get_active_sign_in()
	{
        $this->db->where('staff_id', $this->session->userdata('staff_id'));
        $this->db->where('active',1);
        $system_privilage=$this->db->get('user_privilage')->row();
        if($system_privilage)
        {
            $userinfo=array('level'=>$system_privilage->level,
                            'staff_id'=>$this->session->userdata('staff_id'),
                            'username'=>$this->session->userdata('username'),
                            'first_name'=>$this->session->userdata('first_name'),
                            'last_name'=>$this->session->userdata('last_name'));
            return (object) $userinfo;
        }
        else return FALSE;
    }
    function get_user_privilage($staff_id)
    {
        $this->db->where('staff_id', $staff_id);
        $this->db->where('active',1);
        return $this->db->get('user_privilage')->row();
    }

}