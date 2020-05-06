<?php


namespace Unit;

use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\ShoppingCart\{CartItem, Cart};

class CartTest extends TestCase
{
    public function test_canAddAnElement()
    {
        $item = new CartItem("fool item", 20);
        $cart = new Cart();

        //Verify has 0 elements
        $this->assertEquals(0, $cart->count());

        $cart->addItem($item);
        $this->assertEquals(1, $cart->count());

    }

    public function test_canAddManyElements()
    {
        $items = [];
        $cart = new Cart();
        //Assert is empty
        $this->assertTrue($cart->isEmpty());

        for ($i = 1; $i <= 5; $i++) {
            array_push($items, new CartItem($i . 'th element', $i * 20));
        }

        $cart->addItems($items);

        $this->assertEquals(count($items), $cart->count());
    }

    public function test_remove()
    {
        $item = new CartItem("fool item", 20);
        $cart = new Cart();

        $cart->addItem($item);
        $this->assertEquals(1, $cart->count());

        $cart->remove($item->id);

        $this->assertTrue($cart->isEmpty());
    }

    public function test_cannotRemove()
    {
        $item = new CartItem("fool item", 20);
        $cart = new Cart();

        $cart->addItem($item);
        $this->assertEquals(1, $cart->count());

        $cart->remove('test');
        $this->assertFalse($cart->isEmpty());

    }

}