<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * system_public model class
 *
 * This model represents user access mapping data. It can be used
 * for manipulation and retriving access previlages information.
 *
 * add on by thawat varachai
 *
 */
class apps extends  CI_Model 
{
			    /**
     * @var CI_Controller CI instance reference holder
     */
    private $CI;
	
	private $db;
    /**
     * @var String $_table_name store access_map_table name
     */
    private $_table_name='apps';
	
	private $app_alias=null;	
function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->CI=& get_instance();
		$dbconfig=$this->CI->config->item('db-rbac','ez_rbac');
		$this->app_alias=$this->CI->config->item('app_alias','ez_rbac');
        $this->db=$this->CI->load->database($dbconfig,TRUE); 

	}
	function getByAlias()
	{
		if(empty($this->app_alias)) return FALSE;
			$this->db->where('app_alias',$this->app_alias);
		return $this->db->get($this->_table_name)->row()->id;
	}
	function GetAppInfo()
	{
		if(empty($this->app_alias)) return FALSE;
			$this->db->where('app_alias',$this->app_alias);
		return $this->db->get($this->_table_name)->row();
	}
}

	