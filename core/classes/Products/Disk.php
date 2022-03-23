<?php

class Disk extends Product
{
    /*------------------------------CONSTRUCTOR--------------------------------*/
    public function __construct($conn)
    {
        parent::__construct($conn);
        $this->setType('Disk');
    }

    /*------------------------------Validators--------------------------------*/
    public function issetData($inputs)
    {
        return (self::issetVal($inputs, ['sku', 'name', 'price', 'attrType', 'size']));
    }

    public function validateAttr($inputs)
    {
        if(filter_var($inputs['size'], FILTER_VALIDATE_FLOAT) != false);
    }

    public function createAttribute($inputs)
    {
        $attr = 'Size: ' . $inputs['size'] . ' MB';
        $this->setAttr($attr);
    }
}