<?php
namespace Home\Solid\Discounts;

interface DiscountStrategy{
    public function apply($amount);
}