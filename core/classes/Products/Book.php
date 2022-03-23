<?php

class Book extends Product
{
    /*------------------------------CONSTRUCTOR--------------------------------*/
    public function __construct($conn)
    {
        parent::__construct($conn);
        $this->setType('Book');
    }

    /*------------------------------Validators--------------------------------*/
    public function issetData($inputs)
    {
        return (self::issetVal($inputs, ['sku', 'name', 'price', 'attrType', 'weight']));
    }

    public function validateAttr($inputs)
    {
        return (filter_var($inputs['weight'], FILTER_VALIDATE_FLOAT) != false);
    }

    public function createAttribute($inputs)
    {
        $attr = 'Weight: ' . $inputs['weight'] . 'KG';
        $this->setAttr($attr);
    }
}