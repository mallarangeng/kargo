<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('tgl_indo')){
	function tgl_indo($tgl){
		$ubah = put_short_date($tgl);
		$expl = explode("-", $ubah);		
		$tanggal = $expl[2];
		$bulan = bulan($expl[1]);
		$tahun = $expl[0];
		return $tanggal.' '.$bulan.' '.$tahun;
	}
}
if (!function_exists('bulan')){
	function bulan($bln){
		$bln_array = array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
						   '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		return $bln_array[$bln];
	}
}
if (!function_exists('nama_hari')){
	function nama_hari($tgl){
		$ubah = put_short_date($tgl);
		$expl = explode("-", $ubah);
		$tanggal = $expl[2];
		$bulan = $expl[1];
		$tahun = $expl[0];		
		$nama = date("l", mktime(0,0,0,$bulan,$tanggal,$tahun));
		$nama_hari_indo= array('Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu');
		return $nama_hari_indo[$nama];		
	}
}
