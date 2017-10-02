<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_404 extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->template->set_template('error404');
		
	}

	public function index()
	{

		$this->template->render();
	}
}

/* End of file error_404.php */
/* Location: ./application/controllers/error_404.php */