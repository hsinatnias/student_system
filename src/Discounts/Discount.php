<?php
namespace Home\Solid\Discounts;
class Discount{
    private DiscountStrategy $strategy;
    public function __construct(DiscountStrategy $strategy){
        $this->strategy = $strategy;
    }

    public function calculate($amount){
        return $this->strategy->apply($amount);
    }
}