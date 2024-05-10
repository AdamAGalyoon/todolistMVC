<?php
class Category {
    public static function getAll() {
        $stmt = Database::query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
