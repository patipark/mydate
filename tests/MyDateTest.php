<?php
use PHPUnit\Framework\TestCase;
use patipark\MyDate;
class MyDateTest extends TestCase {

    public function testCanCreateMyDate() {
        $mydate = new MyDate("2020-05-04 13:08");
    }
}