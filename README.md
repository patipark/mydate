# mydate
ใช้ทดสอบวันที่


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require patipark/mydate "dev-master"
```

or add

```
"patipark/mydate": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

- on view 
```php

use patipark\MyDate;


if (MyDate::isValidDate('2021-04-30')) {
    // รูปแบบวันที่ถูกต้อง
    .......
} else {
    // รูปแบบวันที่ไม่ถูกต้อง
    .......
}
echo MyDate::lastDateOfMonth(2021, 2) . "\n";       //2021-02-28 00:00:00
echo MyDate::listMonth()[4] . "\n";                 //เมษายน
foreach (MyDate::listYear(2021) as $key => $val) {  // [2564 , 2565]
    echo $val . "\n";
}
$listDayOfMonth = MyDate::listDayOfMonth(2021, 2);  //return array(1-28)
var_dump($listDayOfMonth);
$date = new MyDate('2021-04-09');
echo $date->getTimezone() . "\n";                   //Asia/Bangkok
echo $date->getDay() . "\n";                        //09
echo $date->getMonth() . "\n";                      //เมษายน
echo $date->getYear() . "\n";                       //2564
echo $date->format('วัน::DDD:: ที่ d ::MMM:: พ.ศ.::YYYY::') . "\n"; //วันศุกร์ ที่ 30 เมษายน พ.ศ.2564

.......
.......
```
