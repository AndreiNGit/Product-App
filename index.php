<?php
require_once "./core/autoload.php";

$db = new Database();
$handler = new Handler($db->getConn());


$handler->deleteProducts();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/src/style/css/style.css">
    <title>Product List</title>
</head>
<body>
    <div id="div-menu">
        <div class="container">
            <h1>Product List</h1>
            <div class="buttons-container">
                <a href="/add-product.php" id="add-product-btn" class="btn primary-btn">ADD</a>
                <button id="delete-product-btn" class="btn danger-btn" type="submit" form="product-form">MASS DELETE</button>
            </div>
        </div>
    </div>

    <div id=div-products>
        <div class="container">
            <form action="index.php" method="post" id="product-form">
                <?php
                    $handler->displayProducts();
                ?>
            </form>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>ScandiWeb Test Assignment</p>
        </div>
    </footer>
</body>
</html>