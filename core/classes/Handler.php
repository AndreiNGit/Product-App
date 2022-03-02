<?php

class Handler extends Validator {
    private $conn;
    private $prods;

    public function deleteProducts() {
        if(!empty($_POST) && isset($_POST['delete-products'])) {
            $v = $_POST['delete-products'];
            foreach($v as $sku)
            {
                $prod = new Product($this->conn, $sku);
                $prod->delete();
            }
            unset($_POST);
            header('Location: /');
        }
    }

    public function addProduct() {
        if(strtolower($_POST['attrType']) == 'dimension')
            $_POST['dimension'] = $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'];     
        if(!empty($_POST))
        {
            if($this->issetData($_POST))
            {
                $obj = [
                    "sku" => $_POST['sku'],
                    "name" => $_POST['name'],
                    "price" => $_POST['price'],
                    "attrType" => $_POST['attrType'],
                    "attr" => $_POST[strtolower($_POST['attrType'])],
                ];
                if($this->validType($obj))
                {
                    $prod = new Product($this->conn, $obj['sku'], $obj);
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

    public function displayProducts()
    {
        $skus = Product::getSkuList($this->conn);
        foreach ($skus as $p)
        {
            $this->prods[] = new Product($this->conn, $p['sku']);
            $this->prods[count($this->prods)-1]->read();
            $this->prods[count($this->prods)-1]->displayProduct();
        }
    }

    public function __construct($conn) 
    {
        $this->conn = $conn;
        $this->prods = [];
    }
}