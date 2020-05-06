<?php


namespace App\ShoppingCart;


class Cart
{
    private array $cart;
    public string $id;

    public function __construct()
    {
        $this->id = uniqid();
        $this->cart = [];
    }

    public function addItem(CartItem $item): void
    {
        array_push($this->cart, $item);
    }

    public function addItems(array $items): void
    {
        $this->cart = array_merge($this->cart, $items);
    }

    public function getFirstItem(): CartItem
    {
        return reset($this->cart);
    }

    public function count(): int
    {
        return count($this->cart);
    }

    public function isEmpty(): bool
    {
        return empty($this->cart);
    }
}