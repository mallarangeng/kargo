<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Airlines extends CI_Controller{
	var $class;
	var $table;
	var $datenow;
	var $addby;
	var $access_code;
	public function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->class = strtolower(__CLASS__);
		$this->table = 'tb_airline';
		$this->datenow = date('Y-m-d H:i:s');
		$this->addby = $this->session->userdata('first_name');
		$this->access_code = 'AIRLN';
		$this->m_admin->maintenance();
	}	
	function index(){
		$this->m_admin->sess_login();
		$priv = $this->m_admin->get_priv($this->access_code,'view');
		$body= (empty($priv)) ? $this->class.'/vw_airlines' : $priv['error'];
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
			0 => 'date_add',
			1 => 'id_airline',				
			2 => 'airline_name',
			3 => 'call_sign',					
			4 => 'add_by',
			5 => 'date_add',					
		);
		return $field_array;
	}
	
	function get_records(){
		$output = array();		
		//load datatable
		$this->m_admin->datatable();
		$total = count($this->m_admin->get_table_dt($this->table));
		$output['draw'] = $_REQUEST['draw'];
		$output['csrf_token'] = csrf_token()['hash'];//reload hash token diferent
		$output['recordsTotal']= $output['recordsFiltered'] = $total;	
		//date filter value already set index row column
		$date_from = $_REQUEST['columns'][0]['search']['value'];
		$date_to = $_REQUEST['columns'][5]['search']['value'];
		$this->m_admin->range_date($this->column(),$date_from,$date_to);
		$query = $this->m_admin->get_table_dt($this->table,'','',$this->column());
		$this->m_admin->range_date($this->column(),$date_from,$date_to);
		$total = count($this->m_admin->get_table_dt($this->table));
		$output['recordsFiltered'] = $total;		
		$output['data'] = array();
		$no = $_REQUEST['start'] + 1;
		foreach ($query as $row){
			$actions = '<a class="btn btn-xs btn-info" href="'.base_url(MODULE.'/'.$this->class.'/form/'.$row->id_airline).'" title="Edit" data-rel="tooltip" data-placement="top">'.icon_action('edit').'</a>
						<a class="btn btn-xs btn-danger" onclick="DeleteConfirm(\''.base_url(MODULE.'/'.$this->class.'/delete').'\',\''.$row->id_airline.'\')" title="Delete" data-rel="tooltip" data-placement="top">'.icon_action('delete').'</a>';		
			$islogo = ($row->logo != '') ? $row->logo : 'no-image.jpg';
			$logo = '<img src="'.base_url('assets/images/airline_logo/'.$islogo).'" style="width:100px">';
			$output['data'][] = array(
					$no,					
					$row->id_airline,
					$logo.' '.$row->airline_name,
					$row->call_sign,										
					$row->add_by,
					long_date_time($row->date_add),					
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
			$sql = $this->m_admin->get_table($this->table,'*',array('id_airline'=>$id));			
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
		$id_airline = $this->input->post('id_airline',true);		
		$post['airline_name']=$this->input->post('name',true);
		$post['call_sign']=$this->input->post('callsign',true);		
		$logo=$_FILES['logo']['name'];	
		$post['update_by']=$this->addby;		
		$post['date_update']=$this->datenow;
		if ($logo != ""){
			$set['upload_path'] = './assets/images/airline_logo/';
			$set['file_name'] = $logo;
			$set['var_name']='logo';
			$this->m_admin->upload_image($set);
			$post['logo'] = $logo;
		}
		if (!empty($id_airline)){
			//editc			
			$res = $this->m_admin->editdata($this->table,$post,array('id_airline'=>$id_airline));
			$alert = 'Edit data '.__CLASS__.' successfull';
		}else{
			//addnew
			$id = $this->input->post('id',true);	
			$post['id_airline']= $id;
			$post['date_add']=$this->datenow;
			$post['add_by']=$this->addby;
			if ($this->cek_id($id) == false){
				$res = $this->m_admin->insertdata($this->table,$post);
				$alert = 'Add new data '.__CLASS__.' successfull';
			}else{
				$alert = 'ID Airline already exist,please use other id';
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
			$res = $this->m_admin->editdata($this->table,array('active'=>$check),array('id_airline'=>$id));
			if ($res){
				$msg = ($check == 1) ? 'Edit status '.__CLASS__.' to be active successfull' : 'Edit status '.__CLASS__.' to be not active succesfull';
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$msg));
			}
		}else{			
			echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$priv['notif']));
		}		
	}
	function cek_id($id){
		$qr = $this->m_admin->get_table($this->table,'id_airline',array('id_airline'=>$id,'deleted'=>0));
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
			$res = $this->m_admin->editdata($this->table,array('deleted'=>1),array('id_airline'=>$id));
			if ($res > 0){
				$msg = 'Delete data '.__CLASS__.' successfull';
				echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>0,'msg'=>$msg,'table'=>'dt'));
			}
		}else{
			echo json_encode(array('csrf_token'=>csrf_token()['hash'],'error'=>1,'msg'=>$priv['notif']));
		}
	}
}
