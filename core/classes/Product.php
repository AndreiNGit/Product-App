<?php

class Product implements Crud
{
    private $sku;
    private $name;
    private $price;
    private $attr;
    private $conn;

    public function displayProduct()
    {
        echo '
        <div class="product-div">
            <input type="checkbox" class="delete-checkbox" id='.$this->sku.' name="delete-products[]" value='.$this->sku.'>
            <p>'.$this->sku.'</p>
            <p>'.$this->name.'</p>
            <p>'.$this->price.' $</p>
            <p>'.$this->attr->getType().': '.$this->attr->getValue().' '.$this->attr->getUnit().'</p>
        </div>';
    }

    public function toAssoc()
    {
        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'price' => $this->price,
            'attr' => $this->attr,
        ];
    }

    public static function getSkuList($conn) {
        $sql = "SELECT sku
        FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function create()
    {
        $sql = "INSERT INTO products (sku, name, price) VALUES (:sku, :name, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price
        ]);
        $this->attr->create();
    }

    public function read()
    {
        $sql = "SELECT *
                FROM products
                WHERE sku = :sku";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "sku" => $this->sku
        ]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $this->assocToObj($stmt->fetch());
        $this->attr->read();
    }

    public function delete()
    {
        $sql = "DELETE FROM products WHERE sku = :sku";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("sku", $this->sku);
        $stmt->execute();
        $this->attr->delete();
    }

    public function assocToObj($assoc)
    {
        $this->sku = $assoc['sku'];
        $this->name = $assoc['name'];
        $this->price = $assoc['price'];
        if(isset($assoc['attrType']))
            $this->attr->assocToObj($assoc);
    }

    public function __construct($conn, $sku, $assoc=null)
    {
        $this->conn = $conn;
        $this->sku = $sku;
        $this->attr = new Attr($conn, $sku);
        if($assoc != null)
            $this->assocToObj($assoc);
    }
}