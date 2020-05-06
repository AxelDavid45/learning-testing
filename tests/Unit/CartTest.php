<?php


namespace Unit;

use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\ShoppingCart\{CartItem, Cart};

class CartTest extends TestCase
{

    private Cart $cart;
    /*
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->cart = new Cart();
    }

    /*
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        echo "Teardown\n";
    }

    public function test_canAddAnElement()
    {
        $item = createFoolItem();

        //Verify has 0 elements
        $this->assertEquals(0, $this->cart->count());

        $this->cart->addItem($item);
        $this->assertEquals(1, $this->cart->count());

    }

    public function test_canAddManyElements()
    {
        $items = [];
        //Assert is empty
        $this->assertTrue($this->cart->isEmpty());

        for ($i = 1; $i <= 5; $i++) {
            array_push($items, createFoolItem());
        }

        $this->cart->addItems($items);

        $this->assertEquals(count($items), $this->cart->count());
    }

    public function test_remove()
    {
        $item = createFoolItem();

        $this->cart->addItem($item);
        $this->assertEquals(1, $this->cart->count());

        $this->cart->remove($item->id);

        $this->assertTrue($this->cart->isEmpty());
    }

    public function test_cannotRemove()
    {
        $item = createFoolItem();

        $this->cart->addItem($item);
        $this->assertEquals(1, $this->cart->count());

        $this->cart->remove('test');
        $this->assertFalse($this->cart->isEmpty());

    }

}