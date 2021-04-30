<?php

namespace patipark;

/**
 * เป็น class ที่เป็น utility ในการตรวจสอบและแปลงค่าวันที่ 
 *
 */
class MyDate
{
    const FORMAT_DATE = 'php:Y-m-d';
    const FORMAT_DATETIME = 'php:Y-m-d H:i:s';
    const FORMAT_TIME = 'php:H:i:s';

    protected $date;

    public function __construct($date)
    {
        $this->date = new \DateTime($date, new \DateTimeZone('Asia/Bangkok'));
    }

    public function getTimezone()
    {
        return $this->date->getTimezone()->getName();
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
     * get array list of day โดยค่า โดยค่าที่เป็นไปได้ 1-31
     * @return  array $days
     */
    public static function listDay()
    {
        for ($i = 1; $i <= 31; $i++) {
            $days[$i] = $i;
        }
        return $days;
    }

    /**
     * get array list of day โดยค่า โดยค่าที่เป็นไปได้ 1-วันสุดท้ายของเดือน โดยส่งผ่านค่า ปี กับ เดือนเข้าไป(เพื่อหากวันที่สุดท้ายของเดือนนั้น)
     * @return  array $days
     */
    public static function listDayOfMonth($year, $month)
    {
        $date = self::lastDateOfMonth($year, $month);
        for ($i = 1; $i <= date('d', strtotime($date)); $i++) {
            $days[$i] = $i;
        }
        return $days;
    }

    /**
     * get array day of week เป็นภาษาไทย
     * @return  array $dayOfWeeks
     */
    private function getThaiDay($index)
    {
        $dayOfWeeks = [
            'อาทิตย์',
            'จันทร์',
            'อังคาร',
            'พุธ',
            'พฤหัสบดี',
            'ศุกร์',
            'เสาร์',
            'อาทิตย์'
        ];
        return $dayOfWeeks[$index];
    }

    /**
     * get month name เป็นภาษาไทย
     * @return  string $monthName
     */
    private function getThaiMonth($index)
    {
        return self::listMonth()[$index];
    }

    /**
     * get string day of week เป็นภาษาไทย
     * @return  string $dayOfWeek
     */
    public function getdayOfWeek()
    {
        return $this->getThaiDay($this->date->format('w'));
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

    /**
     * get integer day
     * @return  integer $day
     */
    public function getDay()
    {
        return $this->date->format('d');
    }

    /**
     * get string month name เป็นภาษาไทย
     * @return  string $monthName
     */
    public function getMonth()
    {
        return $this->getThaiMonth($this->date->format('n'));
    }

    /**
     * get integer year เป็นปี พ.ศ.
     * @return  string $year
     */
    public function getYear()
    {
        return intval($this->date->format('Y')) + 543;
    }

    /**
     * แทนที่ ชุด string ด้วยข้อความ ที่เป็นภาษาไทย
     * @return  string $thaiDate
     */
    private function replaceFormatToThai($format)
    {
        return preg_replace(['/::DDD::/', '/::MMM::/', '/::YYYY::/'], [$this->getdayOfWeek(), $this->getMonth(), $this->getYear()], $format);
    }

     /**
     * คืนค่าวันที่ด้วย รูปแบบ ข้อความที่เป็นภาษาไทย
     * @return  string @newFormat
     */
    public function format($format)
    {
        return $this->date->format(
            $this->replaceFormatToThai($format)
        );
    }
}
