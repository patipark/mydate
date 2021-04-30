<?php

namespace patipark;

class MyDate
{
    // const FORMAT_DATE = 'php:Y-m-d';
    // const FORMAT_DATETIME = 'php:Y-m-d H:i:s';
    // const FORMAT_TIME = 'php:H:i:s';

    public function init()
    {
        date_default_timezone_set("Asia/Bangkok");
    }

    public static function TIMEZONE()
    {
        if (date_default_timezone_get()) {
            return date_default_timezone_get();
        }
        if (ini_get('date.timezone')) {
            return ini_get('date.timezone');
        }
        return date('e');
    }


    public static function isValidDate($dateString)
    {
        if (empty($dateString)) {
            return false;
        }
        if ($dateString != '') {
            if (strtotime($dateString) == null) {
                return false;
            }
            $date = date_parse($dateString);
            if (!checkdate($date["month"], $date["day"], $date["year"])) {
                return false;
            }
        }
        return true;
    }

    public static function listMonth($language = 'th')
    {
        $month = [];
        if ($language == 'th') :
            $month = [
                1 => 'มกราคม',
                2 => 'กุมภาพันธ์',
                3 => 'มีนาคม',
                4 => 'เมษายน',
                5 => 'พฤษภาคม',
                6 => 'มิถุนายน',
                7 => 'กรกฎาคม',
                8 => 'สิงหาคม',
                9 => 'กันยายน',
                10 => 'ตุลาคม',
                11 => 'พฤศจิกายน',
                12 => 'ธันวาคม'
            ];
        else :
            for ($i = 1; $i <= 12; $i++) {
                $month[$i] = date('F', mktime(0, 0, 0, $i, 10));
            }
        endif;

        return $month;
    }

    public static function listYear($from = 1970, $to = 0, $BE = true)
    {
        $from = ($from < 1970) ? 1970 : $from;
        $to = ($to == 0) ? date('Y') + 1 : $to;
        $to = ($to < $from) ? $from : $to;
        $be = ($BE === true) ? 543 : 0;
        for ($i = $from; $i <= $to; $i++) {
            $year[$i] = ($BE === true) ? $i + $be : $i;
        }
        return $year;
    }


    public static function lastDateOfMonth($year, $month)
    {
        $date = date_create($year . '-' . $month . '-01');
        return date_format($date, 'Y-m-t H:i:s');
    }
}
