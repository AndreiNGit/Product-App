<?php

include_once "./core/autoload.php";

$db = new Database();
$handler = new Handler($db->getConn());

$handler->addProduct();