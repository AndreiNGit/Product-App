<?php

abstract class Product
{
    private const defaultTypes = ['Furniture', 'Disk', 'Book'];
    protected $sku;
    protected $name;
    protected $price;
    protected $conn;
    protected $type;
    protected $attr;

    /*------------------------------CONSTRUCTOR--------------------------------*/

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /*------------------------------CRUD OPERATIONS--------------------------------*/
    static public function create($p, $conn)
    {
        $sql = "INSERT INTO products VALUES (:sku, :name, :price, :type, :attr)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            "sku" => $p->getSku(),
            "name" => $p->getName(),
            "price" => $p->getPrice(),
            "type" => $p->getType(),
            "attr" => $p->getAttr()
        ]);
    }

    static public function read($sku, $conn)
    {
        $sql = "SELECT *
                FROM products
                WHERE sku = :sku";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("sku", $sku['sku']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    static public function delete($sku, $conn)
    {
        $sql = "DELETE FROM products WHERE sku = :sku";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("sku", $sku);
        return $stmt->execute();
    }

    /*------------------------------HELPER FUNCTIONS--------------------------------*/
    static public function uniqueSku($sku, $conn)
    {
        $sql = "SELECT sku
        FROM products
        where :sku = sku
        LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["sku" => $sku]);
        return empty($stmt->fetchAll());
    }

    public static function getSkuList($conn) {
        $sql = "SELECT sku
        FROM products";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function displayProduct()
    {
        echo '
        <div class="product-div">
            <input type="checkbox" class="delete-checkbox" id='.$this->sku.' name="delete-products[]" value='.$this->sku.'>
            <p>'.$this->getSku().'</p>
            <p>'.$this->getName().'</p>
            <p>'.$this->getPrice().' $</p>
            <p>'.$this->getAttr().'</p>
        </div>';
    }

    /*------------------------------Validators--------------------------------*/
    public function validateSKU($inputs)
    {
        $reg = "/[\s~`!@#$%^&*\(\)\-_+={}\[\]\|\/:;\"'<>,\.\?]/";
        return self::uniqueSku($inputs['sku'], $this->conn) && preg_match($reg, $inputs['sku']) == 0;
    }

    static public function validatePrice($inputs)
    {
        return filter_var($inputs['price'], FILTER_VALIDATE_FLOAT) != false;
    }

    static public function validateType($inputs)
    {
        return in_array($inputs['attrType'], self::defaultTypes);
    }
    
    static public function issetVal($inputs, $val)
    {
        $ok = true;
        foreach($val as $x)
        {
            if(strlen($inputs[$x]) == 0)
                $ok = false;
        }
        return $ok;
    }

    public function validateData($inputs)
    {
        return ($this->validateSKU($inputs, $this->conn)
        && $this->validatePrice($inputs)
        && $this->validateType($inputs)
        && $this->validateAttr($inputs));
    }

    /*------------------------------GETTERS && SETTERS--------------------------------*/
    public function getSku(){
		return $this->sku;
	}

	public function setSku($sku){
		$this->sku = htmlspecialchars($sku);
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = htmlspecialchars($name);
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = filter_var($price, FILTER_VALIDATE_FLOAT);
	}

	public function getType(){
		return $this->type;
	}

	public function setType($type){
		$this->type = htmlspecialchars($type);
	}

    public function getAttr(){
		return $this->attr;
	}

	public function setAttr($attr){
		$this->attr = htmlspecialchars($attr);
	}

    /*------------------------------ABSTRACTS--------------------------------*/
    abstract public function issetData($inputs);
    abstract public function validateAttr($inputs);
    abstract public function createAttribute($inputs);
}