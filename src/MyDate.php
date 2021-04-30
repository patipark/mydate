<?php

namespace patipark;

/**
 * เป็น class ที่เป็น utility ในการตรวจสอบและแปลงค่าวันที่ 
 *
 */
class MyDate
{
    // const FORMAT_DATE = 'php:Y-m-d';
    // const FORMAT_DATETIME = 'php:Y-m-d H:i:s';
    // const FORMAT_TIME = 'php:H:i:s';

    public function init()
    {
        date_default_timezone_set("Asia/Bangkok");
    }

    /**
     * Gets timezone ของ php
     *
     * @return string timezone
     */
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

    /**
     * ตรวจสอบข้อมูลวันที่ว่าถูกต้องหรือไม่
     * @return  boolean isValidDate
     */
    public static function isValidDate(String $dateString)
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

    /**
     * get array list of month โดยค่า $language เริ่มต้น 'th' (ภาษาไทย) นอกนั้นให้เป็น en
     * @return  array $months
     */
    public static function listMonth($language = 'th')
    {
        $months = [];
        if ($language == 'th') :
            $months = [
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
                $months[$i] = date('F', mktime(0, 0, 0, $i, 10));
            }
        endif;

        return $months;
    }

    /**
     * get array list of year จากปี $from ถึงปี $to โดยถ้าค่า $BE = true จะได้ปี พ.ศ.
     * @return  array $years
     */
    public static function listYear($from = 1970, $to = 0, $BE = true)
    {
        $from = ($from < 1970) ? 1970 : $from;
        $to = ($to == 0) ? date('Y') + 1 : $to;
        $to = ($to < $from) ? $from : $to;
        $be = ($BE === true) ? 543 : 0;
        for ($i = $from; $i <= $to; $i++) {
            $years[$i] = ($BE === true) ? $i + $be : $i;
        }
        return $years;
    }

    /**
     * get last date of month  คือคืนว่าว่า ณ ปี/เดือน นั้นจะเป็นวันที่อ่ะไร (ส่วนใหญ่ใช้ตรวจสอบ เดือน กุมภาพันธ์ เพราะบางที 28 บางที 29)
     * @return  String date
     */
    public static function lastDateOfMonth($year, $month)
    {
        $date = date_create($year . '-' . $month . '-01');
        return date_format($date, 'Y-m-t H:i:s');
    }
}
