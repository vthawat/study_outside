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
    function post_subject_major()
    {
        return $this->db->insert('subject_major',$this->input->post());
    }
    function post_subject()
    {
        return $this->db->insert('subject_list',$this->input->post());
    }
    function put_subject_major($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('subject_major',$this->input->post());
    }
    function put_subject($id)
    {
        $this->db->where('id',$id);
        return $this->db->update('subject_list',$this->input->post());
    }
    function delete_subject_major($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('subject_major');
    }
    function delete_subject($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('subject_list');
    }

}