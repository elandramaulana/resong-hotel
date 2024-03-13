<?php
if (!function_exists('bulan')){
    function bulan($bln){
        switch ($bln) {
            case '01':
                return "Januari";
                break;
            case '02':
                return "Februari";
                break;
            case '03':
                return "Maret";
                break;
            case '04':
                return "April";
                break;
            case '05':
                return "Mei";
                break;
            case '06':
                return "Juni";
                break;
            case '07':
                return "Juli";
                break;
            case '08':
                return "Agustus";
                break;
            case '09':
                return "September";
                break;
            case '10':
                return "Oktober";
                break;
            case '11':
                return "November";
                break;
            case '12':
                return "Desember";
                break;
        }
    }
}
if ( ! function_exists('hari')) {
    function hari($tanggal) {
        $hari = date('D', strtotime($tanggal));
        switch($hari) {
            case 'Sun':
                return "Minggu";
                break;
            case 'Mon':
                return "Senin";
                break;
            case 'Tue':
                return "Selasa";
                break;
            case 'Wed':
                return "Rabu";
                break;
            case 'Thu':
                return "Kamis";
                break;
            case 'Fri':
                return "Jumat";
                break;
            case 'Sat':
                return "Sabtu";
                break;
            case 'Sunday':
                return "Minggu";
                break;
            case 'Monday':
                return "Senin";
                break;
            case 'Tuesday':
                return "Selasa";
                break;
            case 'Wednesday':
                return "Rabu";
                break;
            case 'Thursday':
                return "Kamis";
                break;
            case 'Friday':
                return "Jumat";
                break;
            case 'Saturday':
                return "Sabtu";
                break;
        }
    }
}

if ( ! function_exists('tgl_indo')) {
    function tgl_indo($datenow) {
        $newdate = gmdate($datenow, time()+60*60*8);
        $arrDate = explode('-', $newdate);
        return $arrDate[2].' '.bulan($arrDate[1]).' '.$arrDate[0]; //hasil akhir
    }
}

if ( ! function_exists('tgl_indo_time')) {
    function tgl_indo_time($datenow) {
        $dateTime   = explode(' ', $datenow);
        $newDate    = explode('-', $dateTime[0]);
        $formatDate = $newDate[2].' '.bulan($newDate[1]).' '.$newDate[0].' '.$dateTime[1];
        return $formatDate;
    }
}

if ( ! function_exists('time_only')) {
    function time_only($datenow) {
        $dateTime   = explode(' ', $datenow);
        $newDate    = explode('-', $dateTime[0]);
        $formatDate = $dateTime[1];
        return $formatDate;
    }
}



