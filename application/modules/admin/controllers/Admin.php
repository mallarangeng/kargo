<?php if (!defined('BASEPATH')) exit('No Direct script access allowed');
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');	
		$this->m_admin->maintenance();		
		
	}
	function index(){
		$this->m_admin->sess_login();
		url_sess(base_url(MODULE));
		$data = array(
			'page_title'=>'Dashboard',
			'body'=>'dashboard/vw_home'
		);		
		$this->load->view('vw_header',$data);		
	}		
}
