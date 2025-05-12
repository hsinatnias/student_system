<?php
namespace Home\Solid\Discounts;
class StudentDiscount implements DiscountStrategy{
    public function apply($amount){
        return $amount*0.8;
    }
}