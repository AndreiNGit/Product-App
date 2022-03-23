<?php

class Handler{
    private $conn;

    public function deleteProducts() {
        if(!empty($_POST) && isset($_POST['delete-products'])) {
            $v = $_POST['delete-products'];
            foreach($v as $sku)
            {
                Product::delete($sku, $this->conn);
            }
            unset($_POST);
            header('Location: /');
        }
    }

    public function addProduct() {
        if(!empty($_POST))
        {
            if(Product::issetVal($_POST, 'attrType'))
            {
                $prod = new $_POST['attrType']($this->conn);
                if($prod->issetData($_POST))
                {
                    if($prod->validateData($_POST))
                    {
                        $prod->setSku($_POST['sku']);
                        $prod->setName($_POST['name']);
                        $prod->setPrice($_POST['price']);
                        $prod->setType($_POST['attrType']);
                        $prod->createAttribute($_POST);
                        $prod->create();
                        echo "ok";
                    }
                    else
                    {
                        echo "Please, provide the data of indicated type";
                    }
                }
                else
                {
                    echo "Please, submit required data";
                }
            }
        }
    }

    public function displayProducts()
    {
        $skus = Product::getSkuList($this->conn);
        foreach ($skus as $sku)
        {
            $data = Product::read($sku, $this->conn);
            $prod = new $data['type']($this->conn);
            $prod->setSku($data['sku']);
            $prod->setName($data['name']);
            $prod->setPrice($data['price']);
            $prod->setAttr($data['attribute']);
            $prod->displayProduct();
        }
    }

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }
}