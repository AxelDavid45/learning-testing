<?php


namespace Unit;

use App\Connection;
use App\Exceptions\EmptyCartException;
use PHPUnit\Framework\TestCase;
use App\ShoppingCart\{CartItem, Cart};

class CartTest extends TestCase
{

    private Cart $cart;
    private Connection $conn;
    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->cart = new Cart();
        $this->conn = new Connection();
        $this->conn->createSchema();
    }

    /*
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        $this->conn->dropTable();
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

    public function test_EmptyCartException()
    {
        $this->expectException(EmptyCartException::class);
        try {

        } catch (EmptyCartException $e) {
            $this->cart->getFirstItem();
        }

    }

    public function test_insertIntoDB()
    {
        $this->conn->insert($this->cart);

        $cart = $this->conn->retrieve($this->cart->id);

        $this->assertEquals($this->cart->id, $cart->id);
    }
}