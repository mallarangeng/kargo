<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once("./application/libraries/dompdf/autoload.inc.php");
require_once './application/libraries/dompdf/lib/html5lib/Parser.php';
require_once './application/libraries/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once './application/libraries/dompdf/lib/php-svg-lib/src/autoload.php';
require_once './application/libraries/dompdf/src/Autoloader.php';
use Dompdf\Dompdf;
use Dompdf\Options;
class Tesprint extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->library('zend');
		$this->load->model('m_admin');
		$this->load->model('m_content');
		$this->load->library('m_pdf');
	}
	/*
	 * print barcode awb
	 */
	function index($id='',$idbarcode=''){
		$html='';
		$data = '';		
		if (!empty($id)){		
			$where='';
			//print all || print by select
			if ($id == 'select'){
				$id_barcode = explode("-", $idbarcode);		
				$this->db->where_in('C.id_barcode',$id_barcode);
			}else{
				//print all barcode
				$where = array('C.id_order_detail'=>$id);
			}			
			$sql = $this->m_admin->get_label_print($where);			
			if (count($sql) > 0){
				$data['x'] = $sql;
				$data['label_dest'] = $sql[0]->id_label_dest;
				$this->load->view('barcode/vw_barcode',$data);
				//$html .= $this->load->view('barcode/vw_barcode',$data,true);	
				/*			
				$customPaper = array(0,0,269.291338583,368.503937008);//95 mm, 130 mm or 10 cm, 13cm convert to pont(computer)				
				//$customPaper = array(0,0,269.291338583,425.196850394);//95 mm, 150 mm or 10 cm, 15cm convert to pont(computer)
				$filename = 'AirwayBill-'.$id;
				$this->generat_dompdf(preg_replace('/>\s+</', "><", $html),$customPaper,$filename);//off break in last page
				*/
			}			
		}			
	}
	function barcode_trial($id){
		$where = array('C.id_order_detail_trial'=>$id);
		$sql = $this->m_admin->get_label_print_trial($where);
		if (count($sql) > 0){
			$data['x'] = $sql;
			$data['label_dest'] = $sql[0]->id_label_dest;
			$this->load->view('barcode/vw_barcode',$data);			
		}
	}
	public function generat_dompdf($html, $customPaper,$filename, $stream=true)
	{
		$options = new Options();		
		$options->setIsRemoteEnabled(true);
		$dompdf = new DOMPDF($options);
		$dompdf->load_html($html);		
		$dompdf->set_paper($customPaper);
		//$dompdf->set_paper($paper, $orientation);
		$dompdf->render();// Render the HTML as PDF		
		// Output the generated PDF to Browser
		if ($stream){
			$dompdf->stream($filename.".pdf", array("Attachment" => false));			
		}else{
			$output =  $dompdf->output();
			//file_put_contents('./pdf-printout/'.$filename.".pdf", $output);//save file pdf to server
			return $output;
		}		
		exit(0);
	}
	function bikin_barcode1($kode)
	{			
		//load yang ada di folder Zend
		$this->zend->load('Zend/Barcode');			
		//generate barcodenya		
		$option = array('text'=>$kode,
				'barHeight'=>20,
				'factor'=>2.35,
				'fontSize'=>8,
				'withQuietZones' => true,
				'drawText'=>false,//show code
				'stretchText'=>false//memisahkan kode perbaris
				
	
		);
		Zend_Barcode::render('code128', 'image', $option, array());
	}
	function bikin_barcode2($kode)
	{
			
		//load yang ada di folder Zend
		$this->zend->load('Zend/Barcode');			
		//generate barcodenya		
		$option = array('text'=>$kode,
				'barHeight'=>17,
				'factor'=>1.50,
				'fontSize'=>7,
				'withQuietZones' => true,
				'drawText'=>false,//show code
				'stretchText'=>false//memisahkan kode perbaris	
	
		);
		Zend_Barcode::render('code128', 'image', $option, array());
	}
	function invoice($id=''){
		if (!empty($id)){
			$sql = $this->m_admin->get_order(array('A.id_order'=>$id));
			if (count($sql) > 0){
				foreach ($sql as $row)
					foreach ($row as $key=>$val){
					$data[$key] = $val;
				}
				$filename = 'Invoice-'.$id;
				$data['detail'] = $this->m_admin->get_order_detail(array('A.id_order'=>$id));		
				$data['title'] = $filename;												
				$header =$this->load->view('report/vw_header',$data,true);
				if ($sql[0]->total_qty >= 21){
					$body = $this->load->view('report/vw_invoice_2',$data,true);
				}else{
					$body = $this->load->view('report/vw_invoice',$data,true);
				}
				
				$footer = $this->load->view('report/vw_footer',$data,true);
				$html = $header.$body.$footer;									
				$customPaper = array(0,0,595.275590551,841.88976378); //A4,portrait = 210 mm, 297 mm/ 21,0 cm, 29,7 cm (convert to point)
				$this->generat_dompdf(preg_replace('/>\s+</', "><", $html),$customPaper,$filename);//off break in last page
			}else{
				echo 'Not Found';
			}
		}else{
			echo 'Invoice generate error!';
		}
	}
	function rekap_report($tab,$print=false){
		$shift = $this->input->post('shift'.$tab,true);		
		$from = put_short_date($this->input->post('from'.$tab,true));
		$to = put_short_date($this->input->post('to'.$tab,true));		
		$body='';
		if ($tab == 'tab1'){								
			$title = 'Rekapitulasi Pendapatan Bulanan';
			$filename = $title.' '.short_date($from).'-'.short_date($to);
			$data['rekap'] = $this->m_admin->rekap_filter($shift,$from,$to);
			if (count($data['rekap']) > 0){
				foreach ($data['rekap'] as $row){
					//menjumlahkan subtotal price, qty sesuai tanggal dan shift
					$d[] = $this->m_admin->rekap_filter_detail($row->date_add,$shift);					
				}				
				
				$sum = $this->m_admin->rekap_summary_all($from,$to);
				foreach ($sum as $r)
					foreach ($r as $key=>$val){
						$data[$key] = $val;
					}
				$byshift = $this->m_admin->rekap_summary_all($from,$to,true);
				foreach ($byshift as $rx){
					$xc[] = '('.$rx->shift_name.') '.ISOCODE.' '.number_format($rx->total_price);
				}
				$data['byshift'] = implode(" | ", $xc);				
				$data['detail'] = $d;		
				$data['title'] = $title;
				$data['title2'] = 'Periode '.short_date($from).' - '.short_date($to);
				$header = $this->load->view('report/vw_header',$data,true);
				$body = $this->load->view('report/vw_rekapitulasi1',$data,true);								
			}			
		}else if ($tab == 'tab2'){			
			$report = $this->m_admin->report_filter($shift,$from);			
			if (count($report) > 0){
				$title = 'Laporan Penerimaan Harian Barcode Label';
				$filename = $title.' '.short_date($from);
				foreach ($report as $row)
					foreach ($row as $key=>$val){
					$data[$key] = $val;					
				}
				$det = $this->m_admin->report_filter_detail($from,$shift);						
				if (count($det) > 0){				
					foreach ($det as $v){					
						$xt[] = '('.$v->shift_name.') '.$v->total_qty;
						$xc[] = '('.$v->shift_name.') '.ISOCODE.' '.number_format($v->total_price);
						$xx[] = '('.$v->shift_name.') '.ISOCODE.' '.number_format($v->total_amount_tax);
						$xz[] = '('.$v->shift_name.') '.ISOCODE.' '.number_format($v->total_price_tax);
					}
				}
				$idorder = $this->m_admin->report_id_order($from,$shift);
				foreach ($idorder as $id){
					$idx[] = $id->id_order;
				}
				$data['qtyshift'] = implode(" | ", $xt);
				$data['totshift'] = implode(" | ", $xc);
				$data['taxshift'] = implode(" | ", $xx);
				$data['totaxshift'] = implode(" | ", $xz);
				$data['id_order'] = implode(" | ", $idx);
				$data['title'] = $title;
				$data['title2'] = 'Periode '.short_date($from);			
				$header =$this->load->view('report/vw_header',$data,true);
				$body = $this->load->view('report/vw_rekapitulasi2',$data,true);
			}
		}else{
			$title = 'Laporan Penerimaan Barcode Label dan MAWB';
			$filename = $title.' '.short_date($from).'-'.short_date($to);			
			$data['title'] = $title;
			$data['title2'] = 'Periode '.short_date($from).' - '.short_date($to);
			$data['order'] = $this->m_admin->report_general($shift,$from,$to);
			
			$sum = $this->m_admin->report_general($shift,$from,$to,true);
			if (count($sum) > 0){
				foreach ($sum as $row)
					foreach ($row as $key=>$val){
					$data[$key] = $val;
				}
				$header = $this->load->view('report/vw_header',$data,true);
				$body = $this->load->view('report/vw_rekapitulasi3',$data,true);
			}				
		}		
		if (!empty($body)){
			$html = $header.$body;
			$customPaper = array(0,0,841.88976378,595.275590551); //A4,landscape = 297 mm, 210 mm / 29,7 cm, 21,0 cm (convert to point)
			$this->generat_dompdf(preg_replace('/>\s+</', "><", $html),$customPaper,$filename);//off break in last page
		}else{
			echo 'Data is empty';
		}
		
	}
}