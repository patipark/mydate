<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use patipark\MyDate;

if(MyDate::isValidDate('2021-04-30'))
{
    // รูปแบบวันที่ถูกต้อง
}
else
{
    // รูปแบบวันที่ไม่ถูกต้อง
}
echo MyDate::lastDateOfMonth(2021,2);
echo MyDate::listMonth()[4];
foreach(MyDate::listYear() as $key => $val)
{
    echo $val.'<br>';
}
