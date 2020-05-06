<?php


namespace App\ShoppingCart;


class CartItem
{
    private string $name, $amount;
    public string $id;

    public function __construct(string $name, int $amount)
    {
        $this->id = uniqid();
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getAmount() : int
    {
        return $this->amount;
    }


}