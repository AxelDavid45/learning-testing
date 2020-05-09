<?php


namespace App\ShoppingCart;


use App\Exceptions\EmptyCartException;
use Cassandra\Exception\InvalidArgumentException;

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

    /**
     * @return CartItem
     * @throws EmptyCartException
     */
    public function getFirstItem(): CartItem
    {
        $item = reset($this->cart);
        if (!$item) {
            throw new EmptyCartException("Item was not found, cart empty");
        }
    }

    public function count(): int
    {
        return count($this->cart);
    }

    public function remove(string $id): void
    {
        foreach ($this->cart as $index => $item) {
            if ($item->id == $id) {
                unset($this->cart[$index]);
            }
        }
    }

    public function isEmpty(): bool
    {
        return empty($this->cart);
    }
}