<?php
if (!function_exists('Durasi')){
    function Durasi($Dari, $Ke){
        $d1 = new DateTime($Dari);
        $dtcompare = DateTime::createFromFormat('Y-m-d H:i:s', $Ke);
        if($dtcompare){
            $d2 = new DateTime($Ke);
            $interval = $d1->diff($d2);
            $diffInSeconds = $interval->s; //45
            $diffInMinutes = $interval->i; //23
            $diffInHours   = $interval->h; //8
            $diffInDays    = $interval->d; //21
            $diffInMonths  = $interval->m; //4
            $diffInYears   = $interval->y; //1
            $return = "";
            if($diffInYears!=0){
                $return .= $diffInYears.' Tahun ';
            }
            if($diffInMonths!=0){
                $return .= $diffInMonths.' Bulan ';
            }
            if($diffInDays!=0){
                $return .= $diffInDays. ' Hari ';
            }
            if($diffInHours!=0){
                $return .= $diffInHours. ' Jam ';
            }
            if($diffInMinutes!=0){
                $return .= $diffInMinutes. ' Menit ';
            }
            if($diffInSeconds!=0){
                $return .= $diffInSeconds. ' Detik ';
            }
            return $return;
        }else{
            return "-";
        }
    }
}

if(!function_exists('durationMinutes')){
    function durationMinutes($startDateTime, $endDateTime) {
        // Convert date strings to DateTime objects
        $startDateTimeObj = new DateTime($startDateTime);
        $endDateTimeObj = new DateTime($endDateTime);

        // Calculate interval
        $interval = $startDateTimeObj->diff($endDateTimeObj);

        // Calculate total minutes and seconds
        $totalMinutes = $interval->i + $interval->h * 60;
        $totalSeconds = $interval->s;

        // Format the total as mm:ss
        $formattedInterval = sprintf('%02d:%02d', $totalMinutes, $totalSeconds);

        return $formattedInterval;
    }
}
if(!function_exists('durationHours')){
    function durationHours($startDateTime, $endDateTime) {
        // Convert datetime strings to DateTime objects
        $start = new DateTime($startDateTime);
        $end = new DateTime($endDateTime);

        // Calculate the difference between two DateTime objects
        $interval = $start->diff($end);

        // Calculate total hours, including days
        $totalHours = $interval->h + ($interval->days * 24);

        // Format the duration as hours, minutes, and seconds
        $duration = sprintf(
            '%02d:%02d:%02d',
            $totalHours,
            $interval->i,
            $interval->s
        );

    return $duration;
    }
}
if(!function_exists('DurasiMenit')){
    function DurasiMenit($startDateTime, $endDateTime) {
        $start = new DateTime($startDateTime);
        $end = new DateTime($endDateTime);    
        $intervalInMinutes =$intervalInMinutes = $start->diff($end)->days * 24 * 60 + $start->diff($end)->h * 60 + $start->diff($end)->i;
        return $intervalInMinutes;
    }
}


if ( ! function_exists('daysInterval')) {
    function daysInterval($date1, $date2) {
        // Convert dates to timestamps
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        
        // Calculate the difference in seconds
        $difference = abs($timestamp2 - $timestamp1);
        
        // If difference is less than 1 day, return 1 day
        if ($difference < 60 * 60 * 24) {
            return 1;
        }
        
        // Convert the difference from seconds to days
        $days = floor($difference / (60 * 60 * 24));
        
        return $days;
    }
}


