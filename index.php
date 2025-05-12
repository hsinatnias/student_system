<?php
require './vendor/autoload.php';
use  Home\Solid\Discounts\Discount;
use Home\Solid\Discounts\SeniorDiscount;
use Home\Solid\Discounts\StudentDiscount;
use Home\Solid\Student\Controllers\StudentController;

$studentDiscount = new Discount(new StudentDiscount);
$seniorDiscount = new Discount(new SeniorDiscount);
$student = new StudentController();

echo $studentDiscount->calculate(250);
echo "</br>";
echo $seniorDiscount->calculate(250);

$student->dashboard();


