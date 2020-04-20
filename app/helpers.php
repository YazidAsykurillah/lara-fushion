<?php
	use Carbon\Carbon;
	
	if(!function_exists('indonesian_date')){
		function indonesian_date($date = NULL){
			$output = NULL;
			if(is_null($date)){
				$output = NULL;
			}else{
				$indo_month = '';
				$year = Carbon::parse($date)->format('Y');
				$month = Carbon::parse($date)->format('m');
				switch ($month) {
					case '01':
						$indo_month = 'Januari';
						break;
					case '02':
						$indo_month = 'Februari';
						break;
					case '03':
						$indo_month = 'Maret';
						break;
					case '04':
						$indo_month = 'April';
						break;
					case '05':
						$indo_month = 'Mei';
						break;
					case '06':
						$indo_month = 'Juni';
						break;
					case '07':
						$indo_month = 'Juli';
						break;
					case '08':
						$indo_month = 'Agustus';
						break;
					case '09':
						$indo_month = 'September';
						break;
					case '10':
						$indo_month = 'Oktober';
						break;
					case '11':
						$indo_month = 'November';
						break;
					case '12':
						$indo_month = 'Desember';
						break;
					default:
						$indo_month = 'UNDEFINED';
						break;
				}
				$date = Carbon::parse($date)->format('d');
				
				$output = $date.' '.$indo_month.' '.$year;
			}
			return $output;
		}
	}

	if(!function_exists('rupiah_format')){
		function rupiah_format($input = NULL){
			$output = 0;
			if(!is_null($input)){
				$output = number_format($input,0,',','.');
			}
			return $output;
		}
	}

?>