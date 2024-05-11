<?php
require_once 'Item.php';
require_once 'Category.php';

$action = $_GET['action'] ?? 'list_items';

switch ($action) {
    case 'list_items':
        $category_id = $_GET['category_id'] ?? null;
        $categories = Category::getAll();
        $items = Item::getAll($category_id);
        include 'view.php';
        break;
    default:
        die('Invalid action.');
}
?>
