<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
		$this->template->set_template('admin');
		$this->load->model('userinfo');
		$access_token=get_cookie('access_token');
		$userinfo=$this->userinfo->getOAuthUser($access_token);
		$data['User_info']=$userinfo;
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));	
		$data['app_name']='Application Name ชื่อแอพพลิเคชัน';
		$data['app_desc']='คำอธิบายสั้นๆ ของแอพพลิเคชั่น';
		$data['app_version']='Version dev-0.1';
		$data['app_admin_department']='ชื่อหน่วยงาน/ภาควิชา';
		$data['app_admin_contact']='ชื่อ นามสกุล';
		$data['app_admin_email']='email@eng.psu.ac.th';
		$data['app_admin_phone']='7489';
		$this->template->write('title',$data['app_name'],TRUE);
		$this->template->write('app_name',$data['app_name'],TRUE);
		$this->template->write_view('menu','guest/top_menu',$data);
		$this->template->write_view('footer','guest/footer',$data);
	}
	public function index()
	{

		$this->template->add_css($this->load->view('guest/css/guest-syle.css',null,TRUE),'embed',TRUE);
		$this->template->render();
		//$this->load->view('welcome_message');
	}
}