<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//use now current
if ( ! function_exists('relativeTime'))
{
	function last_time($last_date)
	{
		//60 = 1 menit
		//60 * 60 = 3600 (1 jam)	
		$chunks = array(
				array(60 * 60 * 24 * 365, 'tahun'),
				array(60 * 60 * 24 * 30, 'bulan'),
				array(60 * 60 * 24 * 7, 'minggu'),//604800 = 1 minggu
				array(60 * 60 * 24, 'hari'),//86400 = 1hari
				array(60 * 60, 'jam'),//3600 = 1jam
				array(60, 'menit'),//60
				array(1, 'detik'),
		);
	
		$today = time();
		
		//menambahkan 1 hari pada tanggal yang diinput di database
		
		$original = strtotime($last_date);
		//$original = strtotime("+1 day",$originalconvert);
		
		
		//waktu sekarang - waktu database
		$since = $today - $original;
	
		//jika since lebih dari 1 minggu
		//****tidak digunakan***
		if ($since > 604800)
		{
			$print = date("M jS", $original);
				
			//jika since lebih dari 1 tahun
			if ($since > 31536000)
			{
				$print .= ", " . date("Y", $original);
			}
			//return $print;
				
		}
	
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			//jumlah waktu
			$seconds = $chunks[$i][0];
			
			//nama waktu (menit,jam,hari,dll..)
			$name = $chunks[$i][1];
			
			//floor pembulatan kebawah
			if (($count = floor($since / $seconds)) != 0)
			break;
			//echo $seconds;die;
		}
	
		//jika count ==1 maka dihitung 1 detik yang lalu
		$print = ($count == 1) ? '1 ' . $name : "$count {$name}";
	
		return $print.' yang lalu';
	}
	
	function relativeTime($dt,$precision=2)
	{
		date_default_timezone_set('Asia/Jakarta');
		$date = strtotime($dt)+3600 * 7;
		/*$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");*/
		
		$times=array(	365*24*60*60	=> "tahun",
				30*24*60*60				=> "bulan",
				7*24*60*60				=> "minggu",
				24*60*60				=> "hari",
				60*60					=> "jam",
				60						=> "menit",
				1						=> "detik");
		
		$passed=strtotime(gmdate ("Y-m-d H:i:s", time () + 60 * 60 * 8))-$date;
		
		if($passed < 1)
		{
			$output='kurang dari 5 detik yang lalu';
		}
		else
		{
			$output=array();
			$exit=0;
			
			foreach($times as $period=>$name)
			{
				if($exit>=2 || ($exit>0 && $period<60)) break;
				
				$result = floor($passed/$period);
				if($result>0)
				{
					$output[]=$result.' '.$name.($result==1?'':'');
					$passed-=$result*$period;
					$exit++;
				}
				else if($exit>0) $exit++;
			}
					
			$output=implode(' dan ',$output).' yang lalu';
		}
		
		return $output;
		
	}
}

if ( ! function_exists('loginTime'))
{
	function loginTime($dt,$precision=2)
	{
		$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	
		$passed=time()-$dt-10;
		
		if($passed<5)
		{
			$output='less than 5 seconds ago';
		}
		else
		{
			$output=array();
			$exit=0;
			
			foreach($times as $period=>$name)
			{
				if($exit>=2 || ($exit>0 && $period<60)) break;
				
				$result = floor($passed/$period);
				if($result>0)
				{
					$output[]=$result.' '.$name.($result==1?'':'s');
					$passed-=$result*$period;
					$exit++;
				}
				else if($exit>0) $exit++;
			}
					
			$output=implode(' and ',$output).' ago';
		}
		
		return $output;
		
	}
	
}
function dateformat($date)
{
	return date('Y-m-d',strtotime($date));
}
function month_ind(){
	$month_ind = array('',
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July ',
			'August',
			'September',
			'October',
			'November',
			'December',
	);
	return $month_ind;
}