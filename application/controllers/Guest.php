<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('userinfo');
		$data['app_icon']=prep_url($this->config->item('uiux_path').'/web/vendors/ecs/images/app_icons/'.$this->config->item('uiux_app_icon'));	
		$data['app_name']=$this->config->item('app_info')['app_name'];
		$data['app_desc']=$this->config->item('app_info')['app_desc'];
		$data['app_version']=$this->config->item('app_info')['app_version'];
		$data['app_admin_department']=$this->config->item('app_info')['app_admin_department'];
		$data['app_admin_contact']=$this->config->item('app_info')['app_admin_contact'];
		$data['app_admin_email']=$this->config->item('app_info')['app_admin_email'];
		$data['app_admin_phone']=$this->config->item('app_info')['app_admin_phone'];
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
	
		
		
	//	$this->template->write_view('content','guest/cover');
		$this->template->write_view('content','guest/about');
		$this->template->render();

	}
}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */