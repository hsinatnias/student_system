<?php

require './DiscountStrategy.php';

$studentDiscount = new Discount(new StudentDiscount);
$seniorDiscount = new Discount(new SeniorDiscount);

echo $studentDiscount->calculate(250);
echo $seniorDiscount->calculate(250);