<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_admin extends CI_Model{
		var $draw;
		var $column;		
		var $sort;	
		var $length;
		var $start;
		var $keyword;
		var $date_from;
		var $date_to;
		var $req;
		var $code_dep;
		var $id_employee;
		var $datenow;
		var $addby;
	public function __construct(){
		parent::__construct();
		$this->datenow = date('Y-m-d H:i:s');
		$this->addby = $this->session->userdata('first_name');
		$this->code_dep = $this->session->userdata('code_dep');			
		//load session company
		$this->create_session($this->get_company());		
		$this->id_employee = $this->session->userdata('id_employee');	
		$this->get_shift();		
		//mendapatkan qty maximum pada tb_cost_label
		$this->session->set_userdata('qty_max_cost',$this->get_max_qtycost());
		$this->session->set_userdata('shiftmax_timefrom',$this->get_maxshift_timefrom());
	}
	
	function insertdata($table,$post){
		$res = $this->db->insert($table,$post);
		return $res;
	}
	function editdata($table,$data,$where=''){
		(!empty($where)) ? $this->db->where($where) : '';
		$res = $this->db->update($table,$data);
		return $res;
	}
	function deletedata($table,$where=''){
		(!empty($where)) ? $this->db->where($where) : '';
		$res = $this->db->delete($table);
		return $res;
	}
	function sess_login(){
		if ($this->session->userdata('admin_login') == false){
			redirect(base_url('admin/login'));
		}
	}
	function time_array(){
		for ($i=0; $i <= 23;$i++){
			$t[] = $i;
		}
		return $t;
	}
	function cek_login($where){				
		$shift = shift_array()[date('H')];
		$this->db->select('A.*,B.name_group,B.code_group,
						   D.id_shift,D.shift_name,D.time_from,D.time_to');
		$this->db->from('tb_employee as A');
		$this->db->join('tb_group as B','A.code_group = B.code_group','left');
		$this->db->join('tb_group_shift as C','B.code_group = C.code_group','left');
		$this->db->join('tb_shift as D','C.id_shift = D.id_shift','left');
		$this->db->where('D.id_shift',$shift);	
		$this->db->where('D.active',1);
		$this->db->where('D.deleted',0);
		$this->db->where('A.active',1);
		$this->db->where('A.deleted',0);
		$this->db->where($where);
		$sql = $this->db->get()->result();
		return $sql;
	}
	function get_table($table="",$field="",$where=""){
		$fields = (!empty($field) ? $field : '*');
		$this->db->select($fields);
		$this->db->from($table);
		(!empty($where)) ? $this->db->where($where) : '';
		return $this->db->get()->result();
	}
	function datatable(){
		$this->start = $_REQUEST['start'];
		$this->length = $_REQUEST['length'];
		$this->keyword = $_REQUEST['search']['value'];
		$this->draw = $_REQUEST['draw'];
		$this->sort = $_REQUEST['order'][0]['dir'];
		$this->column = $_REQUEST['order'][0]['column'];	
		$this->req = $_REQUEST;	
	}
	
	function range_date($columns,$date_from='',$date_to=''){
		$output = array();
		$column_count = count($columns);
		for($c=0; $c < $column_count; $c++){
			//value sesuai data yang diinput keyword
			$value_search = $this->req['columns'][$c]['search']['value'];//value
			$index_col = $this->req['columns'][$c]['search'];//index value
			//jika melakukan filter
			if (!empty($value_search)){
				if (empty($date_from) && empty($date_to)){
					//jika tidak melakukan filter tanggal
					$this->db->like($columns[$c],$value_search);
				}elseif (!empty($date_from) && empty($date_to)){
					//jika hanya filter tanggal from
					$this->db->like($columns[$c],$value_search);
				}elseif (!empty($date_from) && !empty($date_to)){
					//jika melakukan filter tanggal from dan to
					$this->db->where('DATE_FORMAT('.$columns[$c].',"%Y-%m-%d") >=',$date_from);
					$this->db->where('DATE_FORMAT('.$columns[$c].',"%Y-%m-%d") <=',$date_to);
				}
			}					
		}		
	}
	function get_sidebar($where){	
		$this->db->select('A.*,B.*,C.name_group,C.code_group');
		$this->db->from('tb_modul as A');
		$this->db->join('tb_priv as B','A.modul_code = B.modul_code','left');
		$this->db->join('tb_group as C','B.code_group = C.code_group','left');
		$this->db->where('A.active',1);
		$this->db->where('A.deleted',0);
		//$this->db->where('B.view',1);
		$this->db->where('B.active',1);
		$this->db->where('B.code_group',$this->code_dep);
		$this->db->where($where);
		$this->db->order_by('A.position','ASC');
		return $this->db->get()->result_array();
	}
	function get_priv($ac,$action){
		$notif='';
		$alias_array  = array('view'=>'View Page','add'=>'Add New',
							  'edit'=>'Edit Data','delete'=>'Delete Data','active'=>'Access Modul');	
		$this->db->select('A.*,B.name');
		$this->db->from('tb_priv as A');
		$this->db->join('tb_modul as B','A.modul_code = B.modul_code','left');
		$this->db->where('A.code_group',$this->code_dep);
		$this->db->where('A.modul_code',$ac);
		$sql = $this->db->get();
		foreach ($sql->result() as $row){
			//jika action false
			if ($row->$action == 0 || $row->active == 0){
				$data['notif'] = 'You do not have permission to '.$alias_array[$action].' '.$row->name;
				$data['error'] = 'vw_access_denied';
				return $data;
			}
		}
	}
	function upload_image($setting)
	{
		$config['upload_path'] = $setting['upload_path'];
		//echo $config['upload_path'];die;
		$config['allowed_types'] = "jpg|png|jpeg|gif|mp4|wmv|zip|pdf";
		$config['max_size']	= '150020';
		$config['max_width']  = '15020';
		$config['max_height']  = '15020';
		$config['file_name'] = str_replace(' ', '_', $setting['file_name']);
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($setting['var_name']))
		{
			//menampilkan error upload
			$res = array('error'=>true,'msg'=> $this->upload->display_errors());
			return $res;
		}
		else
		{
			$zdata = array('upload_data'=>$this->upload->data());
			$zfile = $zdata['upload_data']['full_path'];
			chmod($zfile, 0777);
		}	
	}
	function get_employee($where='',$column=''){		
		$this->db->select('A.*,B.name_group,B.code_group');
		$this->db->from('tb_employee as A');
		$this->db->join('tb_group as B','A.code_group = B.code_group','left');		
		$this->db->where('A.deleted',0);
		($where !='') ? $this->db->where($where) : '';		
		if ($column != ''){
			$columns = $column[$this->column];
			/*where digunakan untuk get by field*/			
			$this->db->limit($this->length,$this->start);
			$this->db->order_by($columns,$this->sort);
		}
		$sql =  $this->db->get()->result();
		return $sql;
	}
	
	
	function get_table_dt($table="",$field="",$where='',$column=''){
		$fields = (!empty($field) ? $field : '*');
		$this->db->select($fields);
		$this->db->from($table);
		$this->db->where('deleted',0);
		($where !='') ? $this->db->where($where) : '';
		if ($column != ''){
			$columns = $column[$this->column];
			/*where digunakan untuk get by field*/
			$this->db->limit($this->length,$this->start);
			$this->db->order_by($columns,$this->sort);
		}
		$sql =  $this->db->get()->result();
		return $sql;
	}
	function upload_image_rowmultiple($config,$files,$i){
		$_FILES[$config['name_file']]['name']= $files['name'][$i];
		$_FILES[$config['name_file']]['type']= $files['type'][$i];
		$_FILES[$config['name_file']]['tmp_name']= $files['tmp_name'][$i];
		$_FILES[$config['name_file']]['error']= $files['error'][$i];
		$_FILES[$config['name_file']]['size']= $files['size'][$i];
	
		$config['upload_path'] = $config['upload_path'];
		$config['allowed_types'] = "jpg|png|jpeg|gif";
		$config['max_size']	= '6020';
		$config['max_width']  = '5020';
		$config['max_height']  = '5020';
		$config['overwrite'] = TRUE;
		$config['file_name'] = str_replace(' ', '_', $files['name'][$i]);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
	
		//uploading proses
		if ($this->upload->do_upload($config['name_file'])) {
			$this->upload->data();
		} else {
			echo  $this->upload->display_errors();die;
		}
	}
	function upload_multiple($count,$set,$files){		
		for($i=0; $i < $count; $i++){
			$_FILES[$set['name_file']]['name']= $files['name'][$i];
			$_FILES[$set['name_file']]['type']= $files['type'][$i];
			$_FILES[$set['name_file']]['tmp_name']= $files['tmp_name'][$i];
			$_FILES[$set['name_file']]['error']= $files['error'][$i];
			$_FILES[$set['name_file']]['size']= $files['size'][$i];
			
			$config['upload_path'] = $set['upload_path'];
			$config['allowed_types'] = "jpg|png|jpeg|gif";
			$config['max_size']	= '6020';
			$config['max_width']  = '5020';
			$config['max_height']  = '5020';
			$config['overwrite'] = TRUE;
			$config['file_name'] = str_replace(' ', '_', $files['name'][$i]);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			//uploading proses
			if ($this->upload->do_upload($set['name_file'])) {
				$this->upload->data();
			}
		}
	}
	
	
	
	
	
	function get_modul($where=''){
		$this->db->select('A.id_modul,A.id_modul_parent,A.name,A.icon,B.*,C.name_group');
		$this->db->from('tb_modul as A');
		$this->db->join('tb_priv as B','A.modul_code = B.modul_code','inner');
		$this->db->join('tb_group as C','C.code_group = B.code_group','inner');
		$this->db->where('A.deleted',0);
		($where !='') ? $this->db->where($where) : '';
		$this->db->order_by('A.position','asc');
		$sql =  $this->db->get()->result();
		return $sql;
	}
	function total_modul($where){
		$this->db->select('count(id_priv) as total');
		$this->db->from('tb_priv');
		$this->db->where($where);
		$this->db->where('deleted',0);
		$sql = $this->db->get()->result();
		return $sql[0]->total;	
	}
	
	function get_rand_id($pref){
		$rand = mt_rand(1, 1000000);
		$code = $pref.$rand;
		return $code;
	}
	
	function get_group($where='',$column=''){
		$this->db->select('*');
		$this->db->from('tb_group');
		$this->db->where('deleted',0);
		($where !='') ? $this->db->where($where) : '';
		if ($column != ''){
			$columns = $column[$this->column];
			/*where digunakan untuk get by field*/
			$this->db->limit($this->length,$this->start);
			$this->db->order_by($columns,$this->sort);
		}
		$sql =  $this->db->get()->result();
		return $sql;
	}
	
	function ref_increament($init)
	{
		$getmaxnum = $init['sql'];
		//jika nilai true make increament number
		if (count($getmaxnum) > 0)
		{
			//get max for increment
			$number = $getmaxnum[0]->ref;
				
		}else{
			//set default 0 + 1 if change year
			$number = 0;
		}
		$number++;//num + 1		
		$prefix = $init['pref'].$init['mid'];
		$unique = str_pad($number, 5, "0", STR_PAD_LEFT);
		$ref_number = $prefix.$unique;
		return $ref_number;
	}
	
	function maintenance(){
		if (MAINTENANCE == true){
			redirect(MODULE.'/maintenance/index');
		}
	}
	
	function get_company(){
		$this->db->select('id_company,company_name,address_company,
							homephone_company,mobilephone_company,email_company,
							logo_company,station_code');
		$this->db->from('tb_company');
		$this->db->where('deleted',0);
		$sql = $this->db->get()->result();
		return $sql;
	}
	function create_session($sql){
		foreach ($sql as $row)
			foreach ($row as $key=>$val){
			$this->session->set_userdata($key,$val);
		}
	}
	function get_group_shift($code){
		$this->db->select('A.shift_name,A.time_from,A.time_to,B.*');
		$this->db->from('tb_shift as A');
		$this->db->join('tb_group_shift as B','A.id_shift = B.id_shift','left');
		$this->db->where('B.code_group',$code);
		$this->db->where('A.deleted',0);
		return $this->db->get()->result();
	}
	
	function get_shift(){
		//jika user sedang online
		if ($this->session->admin_login == true){
			$id_shift = shift_array()[date('H')];		
			$where = array('A.email'=>$this->session->userdata('email'),'D.id_shift'=>$id_shift);
			$sql = $this->cek_login($where);
			if (count($sql)){
				$sess_data = array('shift_name'=>$sql[0]->shift_name,
						'time_from'=>$sql[0]->time_from,
						'time_to'=>$sql[0]->time_to,
						'id_shift'=>$sql[0]->id_shift);
				$this->session->set_userdata($sess_data);
			}else{
				//auto logout
				$this->destroy_sess();
				redirect('admin');
			}
		}
		
	}
	function destroy_sess(){
		$sess_data = array(
				'admin_login'=>false,
				'id_employee'=>'',
				'first_name'=>'',
				'last_name'=>'',
				'email'=>'',
				'group'=>'',
				'code_dep'=>'',
				'photo'=>'',
				'shift_name'=>'',
				'time_from'=>'',
				'time_to'=>'',
				'id_shift'=>''
		);
		$this->session->set_userdata($sess_data);
		$this->session->sess_destroy();		
	}
	function get_cost_label($qty){		
		$this->db->select('*');
		$this->db->from('tb_cost_label');
		$this->db->where('qty_first <=',$qty);
		$this->db->where('qty_last >=',$qty);
		$this->db->where('deleted',0);
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	function id_order($pref)
	{
		$getmaxnum = $this->getMaxId_order();
		//jika nilai true make increament number
		if (count($getmaxnum) > 0)
		{
			//get max for increment
			$number = $getmaxnum[0]->id_order;
	
		}else{
			//set default 0 + 1 if change year
			$number = 0;
		}
		$number++;//num + 1
		$datenow = date('ymd');
		$prefix = $pref.$datenow;
		$unique = str_pad($number, 5, "0", STR_PAD_LEFT);
		$ref_order = $prefix.$unique;
		return $ref_order;
	}
	public function getMaxId_order()
	{
		//11 = mengambil nilai yang ke 11
		//5 = panjang perhitungan 5 digit
	
		//mendapatkan id_order maks berdasarkan tahun sekarang
		$yearnow = date('Y');
		$sql = $this->db->query('SELECT MAX(substring(id_order,11,5))AS id_order FROM tb_order
								WHERE DATE_FORMAT(date_add,"%Y")="'.$yearnow.'" and deleted=0');
		return $sql->result();
	}
	function get_sum_order($where=''){
		$this->db->select('sum(hawb_pcs) as total_koli');
		$this->db->select('sum(qty_print) as total_qty');
		$this->db->select('sum(subtotal_price) as subtotal_price');
		$this->db->select('sum(subtotal_price_tax) as subtotal_price_tax');
		$this->db->select('sum(amount_tax) as total_amount_tax');
		$this->db->from('tb_order_detail');		
		$this->db->where('active',1);
		$this->db->group_by('id_order');		
		($where !='') ? $this->db->where($where) : '';
		$sql =  $this->db->get()->result();
		return $sql;
	}
	function get_label_print($where=''){
		$this->db->select('A.*,B.id_airline,B.airline_name,B.call_sign,B.logo');
		$this->db->select('C.*');
		$this->db->from('tb_order_detail as A');
		$this->db->join('tb_airline as B','A.id_airline = B.id_airline','left');
		$this->db->join('tb_label_barcode as C','A.id_order_detail = C.id_order_detail','left');
		($where !='') ? $this->db->where($where) : '';						
		return $this->db->get()->result();
	}
	function get_label_print_trial($where=''){
		$this->db->select('A.*,B.id_airline,B.airline_name,B.call_sign,B.logo');
		$this->db->select('C.*');
		$this->db->from('tb_order_detail_trial as A');
		$this->db->join('tb_airline as B','A.id_airline = B.id_airline','left');
		$this->db->join('tb_label_barcode_trial as C','A.id_order_detail_trial = C.id_order_detail_trial','left');
		($where !='') ? $this->db->where($where) : '';
		return $this->db->get()->result();
	}
	function get_order_detail($where=''){
		$this->db->select('A.*,B.id_airline,B.airline_name,B.call_sign,B.logo,C.label_dest_name');	
		$this->db->from('tb_order_detail as A');
		$this->db->join('tb_airline as B','A.id_airline = B.id_airline','left');		
		$this->db->join('tb_label_dest as C','A.id_label_dest = C.id_label_dest','left');
		(!empty($where)) ? $this->db->where($where) : '';	
		return $this->db->get()->result();
	}
	function get_order($where='',$column=''){
		$this->db->select('A.*,B.complete_name,C.shift_name');
		$this->db->from('tb_order as A');
		$this->db->join('tb_customer as B','A.id_customer = B.id_customer','left');
		$this->db->join('tb_shift as C','A.id_shift = C.id_shift','left');
		$this->db->where('A.deleted',0);
		($where !='') ? $this->db->where($where) : '';
		if ($column != ''){
			$columns = $column[$this->column];
			/*where digunakan untuk get by field*/
			$this->db->limit($this->length,$this->start);
			$this->db->order_by($columns,$this->sort);
		}
		$sql =  $this->db->get()->result();
		return $sql;
	}
	function get_rekap_order(){				
		$this->db->select('SUM(A.total_qty) as total_qty');
		$this->db->select('SUM(A.total_price) as total_price');
		$this->db->select('SUM(A.total_amount_tax) as total_amount_tax');
		$this->db->select('SUM(A.total_price_tax) as total_price_tax');		
		$this->db->select('DATE_FORMAT(A.date_add,"%Y-%m-%d") as date_add');	
		$this->db->select('A.id_shift');
		$this->db->select('B.shift_name,B.time_from,B.time_to');
		$this->db->from('tb_order as A');
		$this->db->join('tb_shift as B','A.id_shift = B.id_shift','left');
		$this->db->where('A.active',1);
		return $this->db->get()->result();
	}
	function rekap_filter($shift,$from,$to){		
		$this->db->where_in('A.id_shift',$shift);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d") >=',$from);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d") <=',$to);
		$this->db->group_by('DATE_FORMAT(A.date_add,"%Y-%m-%d")');		
		$this->db->order_by('A.date_add','asc');
		$sql =  $this->get_rekap_order();	
		return $sql;
	}
	function rekap_filter_detail($date,$shift){		
		$this->db->where_in('A.id_shift',$shift);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d")',$date);		
		$this->db->group_by('DATE_FORMAT(A.date_add,"%Y-%m-%d")');
		$this->db->group_by('A.id_shift');
		$this->db->order_by('A.id_shift','asc');
		$sql =  $this->get_rekap_order();
		
		return $sql;
	}
	function rekap_summary_all($from,$to,$byshift=false){
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d") >=',$from);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d") <=',$to);		
		if ($byshift){
			$this->db->group_by('A.id_shift');
			$this->db->order_by('A.id_shift','asc');
		}
		$sql =  $this->get_rekap_order();
		return $sql;
	}
	function report_filter($shift,$from){
		$this->db->where_in('A.id_shift',$shift);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d")',$from);		
		$this->db->group_by('DATE_FORMAT(A.date_add,"%Y-%m-%d")');
		$this->db->order_by('A.date_add','asc');
		$sql =  $this->get_rekap_order();		
		return $sql;
	}
	function report_filter_detail($date,$shift){
		$this->db->where_in('A.id_shift',$shift);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d")',$date);		
		$this->db->group_by('A.id_shift');
		$this->db->order_by('A.id_shift','asc');
		$sql =  $this->get_rekap_order();
		return $sql;
	}
	function report_id_order($date,$shift){
		//$this->db->where_in('A.id_shift',$shift);
		$this->db->select('id_order');
		$this->db->from('tb_order');
		$this->db->where('active',1);
		$this->db->where('DATE_FORMAT(date_add,"%Y-%m-%d")',$date);
		$this->db->where_in('id_shift',$shift);
		$this->db->order_by('id_order','asc');
		return $this->db->get()->result();
	}
	function report_general($shift,$from,$to,$sum=false){
		
		$this->db->where_in('A.id_shift',$shift);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d") >=',$from);
		$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d") <=',$to);	
		/*
		 * tidak menampailkan
		* jika shift tiga pada tanggal yg sama atau diluar waktu 23:00 - 07:00
		*/
		if ($from != $to){
			$shiftmax_timefrom = $this->session->userdata('shiftmax_timefrom');
			//jika memilih shift 3 tanggal from dan to tidak boleh sama
			$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d %H:%i:%s") >', $from.' '.$shiftmax_timefrom);
			$this->db->where('DATE_FORMAT(A.date_add,"%Y-%m-%d %H:%i:%s") <', $to.' '.$shiftmax_timefrom);
		}		
		
		$this->db->order_by('A.id_order','asc');		
		$sql =  ($sum) ? $this->get_rekap_order() : $this->get_order();;
		return $sql;
	}
	function cek_qtyprint($where){
		$this->db->select('sum(qty_print) total_qty');
		$this->db->from('tb_order_detail');
		$this->db->where($where);
		$this->db->group_by('id_order');
		$sql = $this->db->get()->result();
		return (count($sql) > 0) ? $sql[0]->total_qty : 0;
		
	}
	function get_max_qtycost(){
		$this->db->select_max('qty_first');
		$this->db->from('tb_cost_label');
		$this->db->where('deleted',0);
		$this->db->limit(1);
		$res = $this->db->get()->result();
		if ($res > 0){
			return $res[0]->qty_first;
		}
		
	}
	function get_maxshift_timefrom(){
		$this->db->select_max('time_from');
		$this->db->from('tb_shift');
		$this->db->where('deleted',0);
		$this->db->limit(1);
		$res = $this->db->get()->result();
		if ($res > 0){
			return $res[0]->time_from;
		}
	
	}
	
}
