<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
		$this->template->set_template('admin');
		$data['User_info']=null;
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));
		$data['app_name']='STDO Application';
		$data['app_desc']='ระบบสารสนเทศบริหารจัดการการศึกษาภาคสนามด้วยกระบวนการวางแผนการเดินทางอัตโนมัติ';
		$data['app_version']='Version 1.0';
		$data['app_admin_department']='ภาควิชาพัฒนาการเกษตร';
		$data['app_admin_contact']='สุดารา คล้ายมณี';
		$data['app_admin_email']='sudara.k@psu.ac.th';
		$data['app_admin_phone']='6122';
		$this->template->write('title',$data['app_name'],TRUE);
		$this->template->write('app_name',$data['app_name'],TRUE);
		$this->template->write_view('menu','guest/top_menu',$data);
		$this->template->write_view('footer','guest/footer',$data);
		$this->template->add_css($this->load->view('css/admin-style.css',null,TRUE),'embed',TRUE);
		$this->template->add_css($this->load->view('guest/css/guest-syle.css',null,TRUE),'embed',TRUE);
		$this->template->write_view('sidebar','sidebar');
	}
	public function index()
	{

		
		$this->template->render();
		//$this->load->view('welcome_message');
	}
}