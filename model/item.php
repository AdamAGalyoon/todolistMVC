<?php
class Item {
    public static function getAll($category_id = null) {
        $sql = ($category_id !== null) ? "SELECT * FROM todoitems WHERE categoryID = ?" : "SELECT * FROM todoitems";
        $stmt = Database::query($sql, [$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
