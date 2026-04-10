<?php


require 'config.php';

    

//get the id
$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM team_members WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: index.php?msg=deleted");
    exit;
} catch (PDOException $e) {
    die("Delete failed: " . $e->getMessage());
}