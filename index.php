
<?php

$host = 'localhost';
$dbname = 'todolist';
$username = 'root';
$password = ''; 

// Model functions
function get_items($category_id = null) {
    global $host, $dbname, $username, $password;
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if ($category_id !== null) {
            $stmt = $pdo->prepare("SELECT * FROM todoitems WHERE categoryID = ?");
            $stmt->execute([$category_id]);
        } else {
            $stmt = $pdo->query("SELECT * FROM todoitems");
        }
        
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    } catch (PDOException $e) {
        die("Error: Could not connect. " . $e->getMessage());
    }
}

function get_categories() {
    global $host, $dbname, $username, $password;
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->query("SELECT * FROM categories");
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    } catch (PDOException $e) {
        die("Error: Could not connect. " . $e->getMessage());
    }
}

// Controller logic
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_items';
    }
}

// Default action to list items
if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    $category_id = ($category_id) ? $category_id : null;
    $categories = get_categories();
    $items = get_items($category_id);
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ToDo List</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            header {
                background-color: #333;
                color: #fff;
                padding: 20px;
                text-align: center;
            }
            section, aside {
                float: left;
                width: 50%;
                padding: 20px;
            }
            ul {
                list-style-type: none;
                padding: 0;
            }
            footer {
                clear: both;
                background-color: #333;
                color: #fff;
                text-align: center;
                padding: 20px;
            }
            footer p {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>ToDo List</h1>
        </header>
        <section>
            <h2>To Do Items</h2>
            <ul>
                <?php foreach ($items as $item): ?>
                    <li><?php echo $item['Title']; ?> - <?php echo $item['Description']; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <aside>
            <h2>Categories</h2>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li><a href="?category_id=<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <footer>
            <p>&copy; <?php echo date("Y"); ?> ToDo List</p>
        </footer>
    </body>
    </html>
    <?php
}
?>
