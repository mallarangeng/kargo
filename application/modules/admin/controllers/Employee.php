<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Employee extends CI_Controller{
	var $class;
	var $table;
	var $datenow;
	var $addby;
	var $access_code;
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->class = strtolower(__CLASS__);
		$this->table = 'tb_employee';
		$this->datenow = date('Y-m-d H:i:s');
		$this->addby = $this->session->userdata('first_name');
		$this->access_code = 'EMPL';
		$this->m_admin->maintenance();
	}	
	function index(){
		$this->m_admin->sess_login();
		$priv = $this->m_admin->get_priv($this->access_code,'view');
		$body= (empty($priv)) ? $this->class.'/vw_employee' : $priv['error'];
		$data['notif']= (empty($priv)) ? '' : $priv['notif'];
		links(MODULE.'/'.$this->class);
		url_sess(base_url(MODULE.'/'.$this->class));//link for menu active
		$data['page_title'] = 'Data '.__CLASS__;
		$data['body'] = $body;
		$data['class'] = $this->class;		
		$this->load->view('vw_header',$data);
	}
	function column(){
		$field_array = array(
			0 => 'A.date_add',			
			1 => 'A.first_name',
			2 => 'A.email',
			3 => 'B.name_group',
			4 => 'A.phone',			
			5 => 'A.add_by',
			6 => 'A.date_add',
			7 => 'A.active'
				
		);
		return $field_array;
	}
	
	function get_records(){
		$output = array();		
		//load datatable
		$this->m_admin->datatable();
		$total = count($this->m_admin->get_employee());
		$output['draw'] = $_REQUEST['draw'];
		$output['csrf_token'] = csrf_token()['hash'];//reload hash token diferent
		$output['recordsTotal']= $output['recordsFiltered'] = $total;	
		//date filter value already set index row column
		$date_from = $_REQUEST['columns'][0]['search']['value'];
		$date_to = $_REQUEST['columns'][7]['search']['value'];
		$this->m_admin->range_date($this->column(),$date_from,$date_to);
		$query = $this->m_admin->get_employee('',$this->column());
		$this->m_admin->range_date($this->column(),$date_from,$date_to);
		$total = count($this->m_admin->get_employee());
		$output['recordsFiltered'] = $total;		
		$output['data'] = array();
		$no = $_REQUEST['start'] + 1;
		foreach ($query as $row){
			$actions='';
			$disabled = 'disabled';
			//jika login bukan sebagai superadmin, maka action pada superadmin tidak ditampilkan
			if ($row->code_group != 'SA'){
				$actions = '<a class="btn btn-xs btn-info" href="'.base_url(MODULE.'/'.$this->class.'/form/'.$row->id_employee).'" title="Edit" data-rel="tooltip" data-placement="top">'.icon_action('edit').'</a>
							<a class="btn btn-xs btn-danger" onclick="DeleteConfirm(\''.base_url(MODULE.'/'.$this->class.'/delete').'\',\''.$row->id_employee.'\')" title="Delete" data-rel="tooltip" data-placement="top">'.icon_action('delete').'</a>';
				$disabled = '';
			}
			//jika login sebagai superadmin action ditampilkan semua
			if ($this->session->userdata('code_dep') == 'SA'){
				$actions = '<a class="btn btn-xs btn-info" href="'.base_url(MODULE.'/'.$this->class.'/form/'.$row->id_employee).'" title="Edit" data-rel="tooltip" data-placement="top">'.icon_action('edit').'</a>
							<a class="btn btn-xs btn-danger" onclick="DeleteConfirm(\''.base_url(MODULE.'/'.$this->class.'/delete').'\',\''.$row->id_employee.'\')" title="Delete" data-rel="tooltip" data-placement="top">'.icon_action('delete').'</a>';
				$disabled = '';
			}
			$check = ($row->active == 1) ? 'checked' : '';
			$active = '<label>
							<input class="ace ace-switch ace-switch-2" '.$disabled.' '.$check.' type="checkbox" onchange="ajaxcheck(\''.base_url(MODULE.'/'.$this->class.'/active').'\',\''.$row->id_employee.'\',this)">
							<span class="lbl"></span>
						</label>';
			$output['data'][] = array(
					$no,					
					$row->first_name.' '.$row->last_name,
					$row->email,
					$row->name_group,
					$row->phone,					
					$row->add_by,
					long_date_time($row->date_add),
					$active,
					$actions
			);
			$no++;
		}
		echo json_encode($output);
	}
	function form($id=""){
		$this->m_admin->sess_login();
		if (!empty($id)){
			links(MODULE.'/'.$this->class.'/form/'.$id);
			$action = 'edit';
			$data['page_title'] = 'Edit '.__CLASS__;
			$sql = $this->m_admin->get_table($this->table,'*',array('id_employee'=>$id));			
			foreach ($sql as $row)
				foreach ($row as $key=>$val){
				$data[$key] = $val;
			}
		}else{
			links(MODULE.'/'.$this->class.'/form/');
			$data['page_title'] = 'Add New '.__CLASS__;
			$action = 'add';
		}
		$priv = $this->m_admin->get_priv($this->access_code,$action);
		$body= (empty($priv)) ? $this->class.'/vw_crud' : $priv['error'];
		$data['body'] = $body;
		$data['class'] = $this->class; 		
		$data['notif']= (empty($priv)) ? '' : $priv['notif'];
		if ($this->session->userdata('code_dep') != 'SA'){
			//jika login bukan sebagai superadmin maka group superadmin tidak ditampilkan
			$this->db->where('code_group <>','SA');
		}
		$data['group'] = $this->m_admin->get_table('tb_group','*',array('deleted'=>0));		
		$this->load->view('vw_header',$data);
	}
	function proses(){
		$this->db->trans_start();	
		$id_employee = $this->input->post('id_employee',true);		
		$post['code_group']=$this->input->post('group',true);
		$post['first_name']=$this->input->post('firstname',true);
		$post['last_name']=$this->input->post('lastname',true);
		$email = $this->input->post('email',true);
		$post['email']=$email;
		$password = $this->input->post('password',true);
		$post['active']= (empty($this->input->post('active',true))) ? 0 : 1;
		$post['phone']=$this->input->post('phone',true);	
		$photo=$_FILES['photo']['name'];	
		$post['update_by']=$this->addby;		
		$post['date_update']=$this->datenow;
		if ($photo != ""){
			$set['upload_path'] = './assets/images/avatars/';
			$set['file_name'] = $photo;
			$set['var_name']='photo';
			$this->m_admin->upload_image($set);
			$post['photo'] = $photo;
		}
		if (!empty($id_employee)){
			//edit
			if ($password != ""){
				$post['password'] = hash_password($password);
			}
			$res = $this->m_admin->editdata($this->table,$post,array('id_employee'=>$id_employee));
			$alert = 'Edit data '.__CLASS__.' successfull';
		}else{
			//addnew
			$post['password']= hash_password($password);
			$post['date_add']=$this->datenow;
			$post['add_by']=$this->addby;
			if ($this->cek_email($email) == false){
				$res = $this->m_admin->insertdata($this->table,$post);
				$alert = 'Add new data '.__CLASS__.' successfull';
			}else{
				$alert = 'Email already exist,please use other email';
				$res = 0;
			}
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_complete();
			if ($res > 0){				
				$this->session->set_flashdata('success',$alert);
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$alert,'type'=>'save','redirect'=>base_url($this->session->userdata('links'))));
			}else{
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$alert,'type'=>'error'));
			}
		}
		
	}
	function active(){
		$id = $this->input->post('value',true);
		$check = $this->input->post('check',true);
		$priv = $this->m_admin->get_priv($this->access_code,'edit');
		if (empty($priv)){
			$res = $this->m_admin->editdata($this->table,array('active'=>$check),array('id_employee'=>$id));
			if ($res){
				$msg = ($check == 1) ? 'Edit status '.__CLASS__.' to be active successfull' : 'Edit status '.__CLASS__.' to be not active succesfull';
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$msg));
			}
		}else{			
			echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$priv['notif']));
		}		
	}
	function cek_email($email){
		$qr = $this->m_admin->get_table($this->table,'email',array('email'=>$email,'deleted'=>0));
		if (count($qr) > 0){
			return true;
		}else{
			return false;
		}		
	}
	function delete(){
		$priv = $this->m_admin->get_priv($this->access_code,'delete');
		if (empty($priv)){
			$id = $this->input->post('value',true);
			$res = $this->m_admin->editdata($this->table,array('deleted'=>1),array('id_employee'=>$id));
			if ($res > 0){
				$msg = 'Delete data '.__CLASS__.' successfull';
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$msg,'table'=>'dt'));
			}
		}else{
			echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$priv['notif']));
		}
	}
}
