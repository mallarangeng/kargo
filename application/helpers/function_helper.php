<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function get_num_name($num){
	switch($num){
		case 1:return 'satu';
		case 2:return 'dua';
		case 3:return 'tiga';
		case 4:return 'empat';
		case 5:return 'lima';
		case 6:return 'enam';
		case 7:return 'tujuh';
		case 8:return 'delapan';
		case 9:return 'sembilan';
	}
}
function time_short($time){
	return date_format(date_create($time), 'H:i');
}
function num_to_words($number, $real_name, $decimal_digit, $decimal_name){
	$res = '';
	$real = 0;
	$decimal = 0;

	if($number == 0)
		return 'Nol'.(($real_name == '')?'':' '.$real_name);
	if($number >= 0){
		$real = floor($number);
		$decimal = round($number - $real, $decimal_digit);
	}else{
		$real = ceil($number) * (-1);
		$number = abs($number);
		$decimal = $number - $real;
	}
	$decimal = (int)str_replace('.','',$decimal);

	$unit_name[1] = 'ribu';
	$unit_name[2] = 'juta';
	$unit_name[3] = 'milliar';
	$unit_name[4] = 'trilliun';

	$packet = array();

	$number = strrev($real);
	$packet = str_split($number,3);

	for($i=0;$i<count($packet);$i++){
		$tmp = strrev($packet[$i]);
		$unit = isset($unit_name[$i]) ? $unit_name[$i] : '' ;
		if((int)$tmp == 0)
			continue;
		$tmp_res = '';
		if(strlen($tmp) >= 2){
			$tmp_proc = substr($tmp,-2);
			switch($tmp_proc){
				case '10':
					$tmp_res = 'sepuluh';
					break;
				case '11':
					$tmp_res = 'sebelas';
					break;
				case '12':
					$tmp_res = 'dua belas';
					break;
				case '13':
					$tmp_res = 'tiga belas';
					break;
				case '15':
					$tmp_res = 'lima belas';
					break;
				case '20':
					$tmp_res = 'dua puluh';
					break;
				case '30':
					$tmp_res = 'tiga puluh';
					break;
				case '40':
					$tmp_res = 'empat puluh';
					break;
				case '50':
					$tmp_res = 'lima puluh';
					break;
				case '70':
					$tmp_res = 'tujuh puluh';
					break;
				case '80':
					$tmp_res = 'delapan puluh';
					break;
				default:
					$tmp_begin = substr($tmp_proc,0,1);
					$tmp_end = substr($tmp_proc,1,1);

					if($tmp_begin == '1')
						$tmp_res = get_num_name($tmp_end).' belas';
					elseif($tmp_begin == '0')
					$tmp_res = get_num_name($tmp_end);
					elseif($tmp_end == '0')
					$tmp_res = get_num_name($tmp_begin).' puluh';
					else{
						if($tmp_begin == '2')
							$tmp_res = 'dua puluh';
						elseif($tmp_begin == '3')
						$tmp_res = 'tiga puluh';
						elseif($tmp_begin == '4')
						$tmp_res = 'empat puluh';
						elseif($tmp_begin == '5')
						$tmp_res = 'lima puluh';
						elseif($tmp_begin == '6')
						$tmp_res = 'enam puluh';
						elseif($tmp_begin == '7')
						$tmp_res = 'tujuh puluh';
						elseif($tmp_begin == '8')
						$tmp_res = 'delapan puluh';
						elseif($tmp_begin == '9')
						$tmp_res = 'sembilan puluh';

						$tmp_res = $tmp_res.' '.get_num_name($tmp_end);
					}
					break;
			}

			if(strlen($tmp) == 3){
				$tmp_begin = substr($tmp,0,1);
				$space = '';
				if(substr($tmp_res,0,1) != ' ' && $tmp_res != '')
					$space = ' ';
				if($tmp_begin != 0){
					if($tmp_begin == 1)
						$tmp_res = 'seratus'.$space.$tmp_res;
					else
						$tmp_res = get_num_name($tmp_begin).' ratus'.$space.$tmp_res;
				}
			}
		}else
			$tmp_res = get_num_name($tmp);

		$space = '';
		if(substr($res,0,1) != ' ' && $res != '')
			$space = ' ';

		if($tmp_res == 'satu' && $unit == 'ribu')
			$res = 'se'.$unit.$space.$res;
		else
			$res = $tmp_res.' '.$unit.$space.$res;
	}

	$space = '';
	if(substr($res,-1) != ' ' && $res != '')
		$space = ' ';
	$res .= $space.$real_name;

	if($decimal > 0)
		$res .= ' '.num_to_words($decimal, '', 0, '').' '.$decimal_name;
	return ucfirst($res);
}

//use now for make session link in backend
if (! function_exists('links'))
{
	function links($linked='')
	{
		$ci = get_instance();
		$ci->session->set_userdata('links',$linked);
		return true;
	}
}
function url_sess($url='')
{
	$ci = get_instance();
	$ci->session->set_userdata('url_sess',$url);
	return true;
}
if (!function_exists('replace_p')){
	function replace_p($data){
		$find = array('<p>','</p>');
		return str_replace($find,'',$data);
	}
}
function replace_freetext($text)
{
	$string = str_ireplace(array("\r","\n",'\r','\n','\\',"<p>","</p>"),'', $text);
	return $string;
}
function replace_desc($text)
{
	$replace_desc = str_ireplace(array("\r","\n",'\r','\n','\\'),'', $text);
	return $replace_desc;
}
function tab_title($str)
{
	$ci = get_instance();
	$find = array('<p>','</p>');
	return str_replace($find,'',$ci->session->userdata($str));
}
if (!function_exists('format_email')){
	function format_email($subject){
		if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $subject)){
			return false;
		}else{return true;}
	}
}
function hash_password($password)
{
	//buat password_hash
	$options = ['cost' => 10,
	'salt' => mcrypt_create_iv(33, MCRYPT_DEV_URANDOM),];
	$hash = password_hash($password, PASSWORD_BCRYPT, $options);
	return $hash;
}
function email_send($emailparam)
{
	$ci =& get_instance();
	$ci->load->library('email');	
	$ci->email->set_newline("\r\n");
	$config = Array(
	    'protocol'  => protocol,		
	    'smtp_host' => smtp_host,
	    'smtp_port' => smtp_port,
	    'smtp_user' => smtp_user,
	    'smtp_pass' => smtp_pass,
	    'mailtype'  => mailtype, 
	    'charset'   => charset
	);
	$ci->email->initialize($config);	
	$subjek      =  $emailparam['subjek'];
	$email_to	 =  $emailparam['email_to'];
	$content      = $emailparam['content'];
	$email_from	 =  smtp_user;
	$name_from	 =  tab_title('tab_title');	
	$email_bcc   =  $emailparam['bcc'];
	//konfigurasi pengiriman
	$ci->email->from($email_from,$name_from);
	$ci->email->to($email_to);
	$ci->email->bcc($email_bcc);
	$ci->email->subject($subjek);
	$ci->email->message($content);
	if ($ci->email->send()){
		return true;
	}else{
		//show_error($ci->email->print_debugger());
		return false;
	}

}

function request_server($data,$request)
{

	$ci =& get_instance();
	$server_url = $data['request_http'];
	$ci->xmlrpc->server($server_url, 80);
	$ci->xmlrpc->method($data['method']);
	$ci->xmlrpc->request($request);
	if ( ! $ci->xmlrpc->send_request())
	{
		return $ci->xmlrpc->display_error();
	}
	else
	{
		$response = $ci->xmlrpc->display_response();
		return $response;
			
	}
}
function xml_generate($data,$sql){
	$xml = new SimpleXMLElement($data['parent']);
	$no=0;
	foreach($sql as $item) {
		$sale = $xml->addChild($data['child'].$no++);
		foreach ($item as $key=>$val)
			$sale->addChild($key,htmlspecialchars($val));
	}
	$xml->asXML($data['path']);

}
function short_date($date){
	return date_format(date_create($date),'d/m/Y');
}
function short_date_time($date){
	return date_format(date_create($date),'d/m/Y H:i');
}
function long_date($date){

	return date_format(date_create($date), 'd M Y');
}
function long_date_time($date){

	return date_format(date_create($date), 'd M Y - H:i');
}
function put_short_date($date){
	return date_format(date_create($date), 'Y-m-d');
}

function alert_warning($notif){
	$alert = '<div class="alert alert-block alert-warning"><i class="icon-info-sign bigger-120"></i><strong> ATTENTION!</strong><br>'.$notif.'</div>';
	return $alert;
}
function alert_status($status,$notif){
	$alert = '<div class="alert alert-block alert-'.$status.'"><i class="icon-info-sign bigger-120"></i>'.$notif.'</div>';
	return $alert;
}
function pay_status($val){
	$payalert = array(
			'UnPaid'=>'label label-warning arrowed-in-right arrowed',
			'UnderPaid'=>'label label-important arrowed-in-right arrowed',
			'OverPaid'=>'label label-info arrowed-in-right arrowed',
			'Matched'=>'label label-success arrowed-in-right arrowed',
			'Success'=>'label label-success arrowed-in-right arrowed',
			'Paid' =>'label label-success arrowed-in-right arrowed'
	);
	return $payalert[$val];
}
function upload_file($setting){
	$ci =& get_instance();
	$config['upload_path'] = $setting['upload_path'];
	//echo $config['upload_path'];die;
	$config['allowed_types'] = "jpg|png|jpeg|gif";
	$config['max_size']	= '6020';
	$config['max_width']  = '5020';
	$config['max_height']  = '5020';
	$config['file_name'] = $setting['file_name'];
	$config['overwrite'] = TRUE;
	$ci->load->library('upload', $config);	
	if (!$ci->upload->do_upload($setting['var_name']))
	{
		//menampilkan error upload
		return $ci->upload->display_errors();
	}
	else
	{
		$zdata = array('upload_data'=>$ci->upload->data());
		$zfile = $zdata['upload_data']['full_path'];
		chmod($zfile, 0777);
	}
}
function icon_action($action){
	switch ($action){
		case 'edit':
			$btn = '<i class="ace-icon fa fa-pencil bigger-120"></i>';
			break;
		case 'delete':
			$btn = '<i class="ace-icon fa fa-trash-o bigger-120"></i>';
			break;
		case 'view':
			$btn ='<i class="ace-icon glyphicon glyphicon-zoom-in bigger-120"></i>';
			break;
		case 'access':
			$btn ='<i class="ace-icon fa fa-sitemap bigger-120"></i>';
			break;
		case 'zone':
			$btn ='<i class="ace-icon fa fa-truck bigger-120"></i>';
			break;
		case 'cost':
			$btn ='<i class="ace-icon fa fa-money bigger-120"></i>';
			break;
		case 'cart':
			$btn ='<i class="ace-icon glyphicon glyphicon-ok bigger-120"></i>';
			break;
		case 'cancel':
			$btn ='<i class="ace-icon fa fa-ban bigger-120"></i>';
			break;
	}
	return $btn;

}
function csrf_token(){
	$ci =& get_instance();
	$csrf = array(
			'name' =>$ci->security->get_csrf_token_name(),
			'hash' =>$ci->security->get_csrf_hash()
	);
	return $csrf;
}
function load_chosen(){
	return '<script>$(".chosen-select").chosen()</script>';
}
function image($file){
	$image = 'no-image.jpg';
	if (!empty($file)){
		$image = $file;
	}
	return $image;
}
function image_product($img_name){
	$img = '<img src="'.base_url('assets/images/product/'.image($img_name)).'" style="width:50px">';
	return $img;
}

function terbilang($angka){
	$ci =& get_instance();
	$angka = (float)$angka;//merubah kebilangan pecahan	
	$bilangan = array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas');	
	if ($angka < 12){
		return $bilangan[$angka];
	}else if ($angka < 20){
		return $bilangan[$angka - 10].' Belas';
	}else if ($angka < 100){
		$hasil_bagi = (int)($angka / 10);//merubah kebilangan bulat	
		$hasil_mod = $angka % 10;//mendapatkan sisa hasil bagi
		return trim(sprintf('%s Puluh %s',$bilangan[$hasil_bagi],$bilangan[$hasil_mod]));
	}else if ($angka < 200){
		return sprintf('Seratus %s',terbilang($angka - 100));
	}else if ($angka < 1000){
		$hasil_bagi = (int)($angka / 100);
		$hasil_mod = $angka % 100;
		return trim(sprintf('%s Ratus %s',$bilangan[$hasil_bagi],terbilang($hasil_mod)));
	}else if ($angka < 2000){
		return trim(sprintf('Seribu %s',terbilang($angka - 1000)));
	}else if ($angka < 1000000){
		$hasil_bagi = (int)($angka / 1000);
		$hasil_mod = $angka % 1000;
		return sprintf('%s Ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
	}else if ($angka < 1000000000) {
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s Juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000) {
         $hasil_bagi = (int)($angka / 1000000000);
         $hasil_mod = fmod($angka, 1000000000);
         return trim(sprintf('%s Milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000000) {
         $hasil_bagi = $angka / 1000000000000;
         $hasil_mod = fmod($angka, 1000000000000);
         return trim(sprintf('%s Triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else {
         return 'Data Wrong!!!';
    }
	
}
function generate_url($name){
	$karakter = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','/','\\',',','.','#',':',';','\'','"','[',']');
	$hapus_karakter_aneh = strtolower(str_replace($karakter,"",$name));
	$result =$tambah_strip = strtolower(str_replace(' ', '-', $hapus_karakter_aneh));
	return $result;
}
function replace_character($string){
	return preg_replace("/[^ \w.]+/", "", $string);//excepts dot(.) not replace
}
function shift_array(){
	for ($i=0; $i <=23; $i++){
		$x = strlen($i) == 1 ? '0'.$i : $i;
		if ($x >= 07 && $x < 15){
			$data[$x] = 'SHF1';
		}elseif ($x >= 15 && $x < 23){
			$data[$x] = 'SHF2';
		}else{
			$data[$x] = 'SHF3';
		}
			
	}
	return $data;
}
function substr_awb($val){
	$num1 = substr($val, 0,3);//get 3 angka didepan
	$midle = substr($val, 3);//get angka setelah 3 angka didepan
	$num2 = substr($midle, 0,4);//get 4 angka dari mid
	$num3 = substr($val, 7);//get angka setelah 7 angka didepan
	$data['subnumber1'] = $num1.' - '.$num2;
	$data['subnumber2'] = $num3;
	$data['num1-klm1'] = $num1;
	$data['num2-klm1'] = ' - '.$num2.$num3;
	return $data;
}