<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('userinfo');
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));	
		$data['app_name']='FTPS Application';
		$data['app_desc']='ระบบสารสนเทศบริหารจัดการการศึกษาภาคสนามด้วยกระบวนการวางแผนการเดินทางอัตโนมัติ';
		$data['app_version']='Version 1.0';
		$data['app_admin_department']='ภาควิชาพัฒนาการเกษตร';
		$data['app_admin_contact']='สุดารา คล้ายมณี';
		$data['app_admin_email']='sudara.k@psu.ac.th';
		$data['app_admin_phone']='6122';
		$data['User_info']=$this->userinfo->get_active_sign_in();
		if($data['User_info']) redirect(base_url($data['User_info']->level));
		$this->template->write('title',$data['app_name'],TRUE);
		$this->template->write_view('app_info','guest/app_info',$data);
		$this->template->write_view('menu','top_menu',$data);
		$this->template->write_view('footer','guest/footer',$data);
		$this->template->add_css($this->load->view('guest/css/guest-syle.css',null,TRUE),'embed',TRUE);
	}
	public function index()
	{
	
		
		
		$this->template->write_view('content','guest/cover');
		$this->template->write_view('content','guest/about');
		$this->template->render();

	}
}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */