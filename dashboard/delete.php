<?php
session_start();
include "../includes/database.php";

// Vetëm admin mund të fshijë
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

// Kontrollo nëse ka id dhe është numerik
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Përdor prepared statement për siguri
    $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Gabim gjatë fshirjes së përdoruesit.";
    }
} else {
    echo "ID e pavlefshme!";
}
?>
