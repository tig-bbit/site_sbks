<?php

namespace App\Helpers;
use DateTime;
use DatePeriod;
use DateInterval;

class Tanggal {

    public static function Indo($tgl) {
        $tanggal = substr($tgl,8,2);
		$bulan = self::get_bulan_full(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
    }

    public static function Indo2($tgl) {
        $tanggal = substr($tgl,3,2);
        $bulan = self::get_bulan(substr($tgl,0,2));
        $tahun = substr($tgl,6,4);

        return $tanggal.' '.$bulan.' '.$tahun;
    }

    public static function IndoThnDInamic($tgl) {
        $tanggal = substr($tgl,8,2);
		$bulan = self::get_bulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.date('Y');
    }

 	public static function IndoStip($tgl) {
        $tanggal = substr($tgl,8,2);
		$bulan = substr($tgl,5,2);
		$tahun = substr($tgl,0,4);
		return $tahun.'-'.$bulan.'-'.$tanggal;
    }

    public static function IndoThnDInamicStip($tgl) {
        $tanggal = substr($tgl,8,2);
		$bulan = substr($tgl,5,2);
		$tahun = substr($tgl,0,4);
		return date('Y').'-'.$bulan.'-'.$tanggal;
    }

    public static function SabtuMinggu($year, $month, $ignore) {
	    $count = 0;
	    $counter = mktime(0, 0, 0, $month, 1, $year);
	    while (date("n", $counter) == $month) {
	        if (in_array(date("w", $counter), $ignore) == false) {
	            $count++;
	        }
	        $counter = strtotime("+1 day", $counter);
	    }
	    return $count;
	}
	public static function number_of_working_days($from, $to,$hari_kerja) {
		// echo number_of_working_days('2013-12-23', '2013-12-29');
	    // $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
	    $workingDays = $hari_kerja; # date format = N (1 = Monday, ...)
	    $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays

	    $from = new DateTime($from);
	    $to = new DateTime($to);
	    $to->modify('+1 day');
	    $interval = new DateInterval('P1D');
	    $periods = new DatePeriod($from, $interval, $to);

	    $days = 0;
	    foreach ($periods as $period) {
	        if (!in_array($period->format('N'), $workingDays)) continue;
	        if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
	        if (in_array($period->format('*-m-d'), $holidayDays)) continue;
	        $days++;
	    }
	    return $days;
	}
	public static function plus_month($from, $month) {
		// $time = strtotime("2010/12/11");
		$time = strtotime($from);
		$final = date("Y/m/d", strtotime("+".$month." month", $time));
	    return $final;
	}



	public static function get_bulan($bln)
	{
		switch ($bln) {
			case 1 :
			return "Jan";
			break;
			case 2 :
			return "Feb";
			break;
			case 3 :
			return "Mar";
			break;
			case 4 :
			return "Apr";
			break;
			case 5 :
			return "Mei";
			break;
			case 6 :
			return "Jun";
			break;
			case 7 :
			return "Jul";
			break;
			case 8 :
			return "Agus";
			break;
			case 9 :
			return "Sept";
			break;
			case 10 :
			return "Okt";
			break;
			case 11 :
			return "Nov";
			break;
			case 12 :
			return "Des";
			break;
		}
	}

public static function get_bulan_full($bln)
	{
		switch ($bln) {
			case 1 :
			return "Januari";
			break;
			case 2 :
			return "Febuari";
			break;
			case 3 :
			return "Maret";
			break;
			case 4 :
			return "April";
			break;
			case 5 :
			return "Mei";
			break;
			case 6 :
			return "Juni";
			break;
			case 7 :
			return "Juli";
			break;
			case 8 :
			return "Agustus";
			break;
			case 9 :
			return "September";
			break;
			case 10 :
			return "Oktober";
			break;
			case 11 :
			return "November";
			break;
			case 12 :
			return "Desember";
			break;
		}
	}


	public static function Status($status)
	{
		if($status == 'Y')
		{
			return "Aktif";
		}
		else if($status == 'N')
		{
			return "Non Aktif";
		}
		if($status == 1)
		{
			return "Aktif";
		}
		else if($status == 0)
		{
			return "Non Aktif";
		}
		return $status;
	}

	public static function Edit($tgl)
	{
		if(count($tgl) < 1)
		{
			return  "";
		}

		$tgl= explode(' ', $tgl)[0];
		$tgl = explode('-', $tgl);
		return $tgl[1].'/'.explode(' ',$tgl[2])[0].'/'.$tgl[0];
	}

	public static function Edit2($tgl)
	{
		if(count($tgl) < 1)
		{
			return  "";
		}

		$tgl= explode(' ', $tgl)[0];
		$tgl = explode('-', $tgl);
		return $tgl[0].'-'.explode(' ',$tgl[1])[0].'-'.$tgl[2];
	}

	public static function AmbilJam($tgl)
	{
		if(count($tgl) < 1)
		{
			return  "";
		}

		$tgl= explode(' ', $tgl);
		if(@$tgl[1])
		{
			return $tgl[1];
		}
		return "";

	}

	public static function BedaJam($akhir,$awal)
	{
		$jumlahhari = (strtotime($akhir) - strtotime($awal));
		if($jumlahhari/60 < 60)
		{
			return number_format($jumlahhari/60,2) ." Minute";
		}
		else if($jumlahhari/(60*60 ) < 60 )
		{
			return number_format($jumlahhari/(60*60 ),2)." Hour";
		}
		else if($jumlahhari/(60*60*240 ) < 60 )
		{
			return number_format($jumlahhari/(60*60*240),2)." Day";
		}

	}

	public static function Bold($text, $str) {
	    return str_replace($text, "<b>".$text."</b>", $str);
	}

	public static function rp($int)
	{
		return "Rp. ".number_format($int, 0, '', '.').",-";
	}
	public static function rp_nologo($int)
	{
		//dd($int);
		return number_format($int, 0, '', '.');
	}
	public static function terbilang($angka) {
		// pastikan kita hanya berususan dengan tipe data numeric
		$angka = (float)$angka;

		// array bilangan
		// sepuluh dan sebelas merupakan special karena awalan 'se'
		$bilangan = array(
				'',
				'satu',
				'dua',
				'tiga',
				'empat',
				'lima',
				'enam',
				'tujuh',
				'delapan',
				'sembilan',
				'sepuluh',
				'sebelas'
		);

		// pencocokan dimulai dari satuan angka terkecil
		if ($angka < 12) {
			// mapping angka ke index array $bilangan
			return $bilangan[$angka];
		} else if ($angka < 20) {
			// bilangan 'belasan'
			// misal 18 maka 18 - 10 = 8
			return $bilangan[$angka - 10] . ' belas';
		} else if ($angka < 100) {
			// bilangan 'puluhan'
			// misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua'
			// untuk mendapatkan sisa bagi gunakan modulus
			// 27 mod 10 = 7 'tujuh'
			$hasil_bagi = (int)($angka / 10);
			$hasil_mod = $angka % 10;
			return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
		} else if ($angka < 200) {
			// bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :))
			// misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan')
			// daripada menulis ulang rutin kode puluhan maka gunakan
			// saja fungsi rekursif dengan memanggil fungsi self::terbilang(51)
			return sprintf('seratus %s', self::terbilang($angka - 100));
		} else if ($angka < 1000) {
			// bilangan 'ratusan'
			// misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat'
			// sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif self::terbilang(67))
			$hasil_bagi = (int)($angka / 100);
			$hasil_mod = $angka % 100;
			return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], self::terbilang($hasil_mod)));
		} else if ($angka < 2000) {
			// bilangan 'seribuan'
			// misal 1250 maka 1250 - 1000 = 250 (ratusan)
			// gunakan rekursif self::terbilang(250)
			return trim(sprintf('seribu %s', self::terbilang($angka - 1000)));
		} else if ($angka < 1000000) {
			// bilangan 'ribuan' (sampai ratusan ribu
			$hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
			$hasil_mod = $angka % 1000;
			return sprintf('%s ribu %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod));
		} else if ($angka < 1000000000) {
			// bilangan 'jutaan' (sampai ratusan juta)
			// 'satu puluh' => SALAH
			// 'satu ratus' => SALAH
			// 'satu juta' => BENAR
			// @#$%^ WT*

			// hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
			$hasil_bagi = (int)($angka / 1000000);
			$hasil_mod = $angka % 1000000;
			return trim(sprintf('%s juta %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
		} else if ($angka < 1000000000000) {
			// bilangan 'milyaran'
			$hasil_bagi = (int)($angka / 1000000000);
			// karena batas maksimum integer untuk 32bit sistem adalah 2147483647
			// maka kita gunakan fmod agar dapat menghandle angka yang lebih besar
			$hasil_mod = fmod($angka, 1000000000);
			return trim(sprintf('%s milyar %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
		} else if ($angka < 1000000000000000) {
			// bilangan 'triliun'
			$hasil_bagi = $angka / 1000000000000;
			$hasil_mod = fmod($angka, 1000000000000);
			return trim(sprintf('%s triliun %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
		} else {
			return 'Wow...';
		}
	}

    public static function clean($string) {
       $string = str_replace('[', '', $string); // Replaces all spaces with hyphens.
       $string = str_replace(']', '', $string); // Replaces all spaces with hyphens.
       $string = str_replace('"', ' ', $string); // Replaces all spaces with hyphens.
        return $string ;

//        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }

}
