<?php

class Furniture extends Product
{   
    /*------------------------------CONSTRUCTOR--------------------------------*/
    public function __construct($conn)
    {
        parent::__construct($conn);
        $this->setType('Furniture');
    }

    /*------------------------------Validators--------------------------------*/
    public function issetData($inputs)
    {
        return (self::issetVal($inputs, ['sku', 'name', 'price', 'attrType', 'height', 'width', 'length']));
    }

    public function validateAttr($inputs)
    {
        return (filter_var_array([$inputs['width'], $inputs['height'], $inputs['length']], FILTER_VALIDATE_FLOAT) != false);
    }

    public function createAttribute($inputs)
    {
        $attr = 'Dimension: ' . $inputs['height'] . 'x' . $inputs['width'] . 'x' . $inputs['length'];
        $this->setAttr($attr);
    }
}