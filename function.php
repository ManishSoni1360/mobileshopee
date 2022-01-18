<?php
// Require MySql Connection
require('database/DBController.php');

// Require Product.php
require('database/Product.php');

// Require Cart.php
require('database/Cart.php');

// DBController Object
$db = new DBController();

// Product Object
$product = new Product($db);

$product_suffle = $product->getData();

// Cart Object
$cart = new Cart($db);




