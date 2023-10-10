<?php
require('../model/database.php');
require('../model/category.php');
require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}  
$category_db=new CategoryDB();
$product_db = new ProductDB();
if ($action == 'list_products') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    $current_category = $category_db->getCategory($category_id);
    $categories = $category_db->getCategories();
    $products = $product_db->getProductsByCategory($category_id);

    include('product_list.php');
} else if ($action == 'view_product') {
    $categories = $category_db->getCategories();

    $product_id = filter_input(INPUT_GET, 'product_id', 
            FILTER_VALIDATE_INT);   
    $product = $product_db->getProduct($product_id);

    include('product_view.php');
}
?>