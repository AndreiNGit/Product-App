<?php

class Validator
{
    public function uniqueSku($sku, $conn)
    {
        $sql = "SELECT sku
        FROM products
        LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return empty($stmt->fetchAll());
    }

    public function validAttr($post)
    {
        if(preg_match("/xx/", $post['attr']) != 0 || preg_match("/[a-wyzA-WYZ]/", $post['attr']) != 0)
            return false;
        else
            return true;
    }

    public function validType($post)
    {
        if(!is_numeric($post['price']) || !$this->validAttr($post))
            return false;
        else 
            return true;
    }

    public function issetData($post)
    {
        if(!isset($post['sku']) || !isset($post['name']) || !isset($post['price']) 
        || !isset($post['attrType']) || !isset($post[strtolower($post['attrType'])]))
            return false;
        else
            return true;
    }
}