<?php


namespace App\Models;


trait HasPriceTrait
{
    private $price;

    public function getPrice()
    {
        return $this->price;
    }
}