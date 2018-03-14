<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ftps extends CI_Model 
{
	function __construct()
	{
		parent::__construct();			
    }
    function get_subject_major($id=null)
    {
       if($id)
        {
            $this->db->where('id',$id);
            return $this->db->get('subject_major')->row();
        }
       else return $this->db->get('subject_major')->result();

    }
    function get_subject($id=null)
    {
        if($id)
        {
            $this->db->where('id',$id);
            return $this->db->get('subject_list')->row();
        }
       else return $this->db->get('subject_list')->result();

    }  

}