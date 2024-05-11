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
                <li><?= $item['Title']; ?> - <?= $item['Description']; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
    <aside>
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $category): ?>
                <li><a href="?category_id=<?= $category['categoryID']; ?>"><?= $category['categoryName']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>
    <footer>
        <p>&copy; <?= date("Y"); ?> ToDo List</p>
    </footer>
</body>
</html>
