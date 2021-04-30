<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use patipark\MyDate;
// echo MyDate::isValidDate('2021-04-30') ? 'Yes' : 'No';
// echo MyDate::lastDateOfMonth(2021,2);
echo MyDate::listMonth()[4];
// var_dump(MyDate::listYear());