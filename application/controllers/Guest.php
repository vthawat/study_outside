<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {

public function __construct()
	{
		parent::__construct();

		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));	
		$data['app_name']='STDO System';
		$data['app_desc']='ระบบสารสนเทศบริหารจัดการการศึกษาภาคสนามด้วยกระบวนการวางแผนการเดินทางอัตโนมัติ';
		$data['app_version']='Version dev-0.1';
		$data['app_admin_department']='ชื่อหน่วยงาน/ภาควิชา';
		$data['app_admin_contact']='ชื่อ นามสกุล';
		$data['app_admin_email']='email@eng.psu.ac.th';
		$data['app_admin_phone']='7489';
		//$data['User_info']=$userinfo;

		$this->template->write('title',$data['app_name'],TRUE);
		$this->template->write_view('app_info','guest/app_info',$data);
		$this->template->write_view('menu','guest/top_menu',$data);
		$this->template->write_view('footer','guest/footer',$data);
	}
	public function index()
	{
	
		
		$this->template->add_css($this->load->view('guest/css/guest-syle.css',null,TRUE),'embed',TRUE);
		$this->template->write_view('content','guest/cover');
		$this->template->write_view('content','guest/about');
		$this->template->render();

	}
}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */