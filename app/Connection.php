<?php


namespace App;
use App\ShoppingCart\Cart;
use \PDO;


class Connection
{
    public \PDO $conn;
    private string $schema = "CREATE TABLE IF NOT EXISTS carts(id varchar(20), data TEXT);";

    public function __construct()
    {
        $this->conn = $this->connect();
    }


    public function connect(): \PDO
    {
        try {
            //Generate the connection
            $conn = new \PDO("mysql:host=localhost;dbname=learning-test", 'root', '');
            //Throws exceptions
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Connection error ' . $e->getMessage();
        }
    }

    public function createSchema() : void
    {
        $this->conn->exec($this->schema);
    }

    public function dropTable() : void
    {
        $stmt = "DROP TABLE IF EXISTS  carts";
        $this->conn->exec($stmt);
    }

    public function insert(Cart $cart) :void
    {
        //Serialize
        $data = base64_encode(serialize($cart));
        //Create the query
        $query = "INSERT INTO carts VALUES ('{$cart->id}', '{$data}')";
        //Run the query
        $this->conn->query($query);
    }

    public function retrieve(string $id)
    {
        $query = "SELECT * FROM carts WHERE carts.id = {$id}";
        $result = $this->conn->query($query);

        return unserialize(base64_decode($result->fetch()));
    }



}