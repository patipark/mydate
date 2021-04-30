# mydate
ใช้ทดสอบวันที่


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require patipark/mydate "*"
```

or add

```
"patipark/mydate": "*"
```

to the require section of your `composer.json` file.


Usage
-----

- on view 
```php
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
.......
.......
```
