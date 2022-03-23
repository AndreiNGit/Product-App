<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/src/js/jquery-3.6.0.min.js"></script>
    <script src="/src/js/add-product.js"></script>
    <link rel="stylesheet" href="/src/style/css/add-product.css">
    <title>Product Add</title>
</head>
<body>
<div id="div-menu">
        <div class="container">
            <h1>Product Add</h1>
            <div class="buttons-container">
                <button class=" btn primary-btn" type="submit" form="product_form">Save</button>
                <a href="/index.php" id="add-product-btn" class="btn danger-btn">Cancel</a>
            </div>
        </div>
    </div>

    <div class="form-div">
        <div class="container">
            <form method="post" id="product_form" onsubmit="submitForm(); return false">
                <div class="form-container">
                    <p class="form-warning"></p>
                    <div class="input">
                        <label for="sku">SKU </label>
                        <input name="sku" type="text" id="sku" required>
                    </div>
                    <div class="input">
                        <label for="name">Name </label>
                        <input name="name" type="text" id="name" required>
                    </div>
                    <div class="input">
                        <label name="price" for="price">Price ($) </label>
                        <input name="price" type="number" step="0.01" id="price" required>
                    </div>
                    <div class="input">
                        <label name="attrType" for="productType">Type Switcher: </label>
                        <select name="attrType" id="productType">
                            <option name="size" value="Disk" id="DVD">DVD</option>
                            <option name="dimension" value="Furniture" id="Furniture">Furniture</option>
                            <option name="weight" value="Book" id="Book">Book</option>
                        </select>
                    </div>

                    <div id="size-options" class="form-options">
                        <p>Please provide the size in MB:</p>
                        <div class="input">
                            <label for="size">Size (MB)</label>
                            <input type="number" step="0.01" id="size" name="size" required>
                        </div>
                    </div>

                    <div id="dimension-options" class="form-options">
                        <p>Please provide the dimensions in HxWxL format:</p>
                        <div class="input">
                            <label for="height">Height (CM)</label>
                            <input type="number" step="0.01" id="height" name="height" required>
                        </div>
                        <div class="input">
                            <label for="width">Width (CM)</label>
                            <input type="number" step="0.01" id="width" name="width" required>
                        </div>
                        <div class="input">
                            <label for="length">Length (CM)</label>
                            <input type="number" step="0.01" id="length" name="length" required>
                        </div>
                    </div>

                    <div id="weight-options" class="form-options">
                        <p>Please provide the weight in KG:</p>
                        <div class="input">
                            <label for="weight">Weight (KG)</label>
                            <input type="number" step="0.01" id="weight" name="weight" required>
                        </div>
                    </div>
                </div>
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