<?php
include "database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";
    $result = $connection->query($sql);

    if ($result) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gabim gjate fshirjes: " . $connection->error;
    }
}
?>
