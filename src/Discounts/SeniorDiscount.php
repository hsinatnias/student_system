<?php
namespace Home\Solid\Discounts;
class SeniorDiscount implements DiscountStrategy{
    public function apply($amount){
        return $amount*0.7;
    }
}