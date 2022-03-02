<?php
//I've tried to name the class Attribute but I got strange errors regarding the constructor thus I've named it the short variant
class Attr implements Crud
{
    private $sku;
    private $type;
    private $value;
    private $unit;
    private $conn;

    public function create()
    {
        $sql = "INSERT INTO attrvalues (attrType, productSku, value) VALUES (:type, :sku, :val)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "type" => $this->type,
            "sku" => $this->sku,
            "val" => $this->value
        ]);
    }

    public function read()
    {
        $sql = "SELECT attrType, productSku sku, value attr
                FROM attrvalues v, attributes a
                WHERE a.name = v.attrType AND productSku = :sku";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "sku" => $this->sku
        ]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $this->assocToObj($stmt->fetch());
    }

    public function delete()
    {
        $sql = "DELETE FROM attrvalues WHERE Productsku = :sku";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("sku", $this->sku);
        return $stmt->execute();
    }

    public function assocToObj($assoc)
    {
        $this->sku = $assoc['sku'];
        $this->type = $assoc['attrType'];
        $this->value = $assoc['attr'];
        $this->unit = $this->getUnitDb();
    }

    public function getUnitDb()
    {
        $sql = "SELECT  unit
        FROM attributes
        WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "name" => $this->type
        ]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $val = $stmt->fetch();
        return $val['unit'];
    }

    public function getSku(){
		return $this->sku;
	}

	public function setSku($sku){
		$this->sku = $sku;
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}

	public function getUnit(){
		return $this->unit;
	}

	public function setUnit($unit){
		$this->unit = $unit;
	}

    public function __construct($conn, $sku)
    {
        $this->sku = $sku;
        $this->conn = $conn;
    }
}