<?php
require 'config.php';

$member_id = $_GET['id'] ?? 0;

// Check if member exists
$stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
$stmt->execute([$member_id]);
$member = $stmt->fetch();

if (!$member) {
    header("Location: index.php");
    exit;
}
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $file = $_FILES['photo'];
    
    // limiting the pictures
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 5 * 1024 * 1024; 

    if ($file['error'] !== 0) {
        $error = "Error uploading file.";
    } elseif (!in_array($file['type'], $allowed_types)) {
        $error = "Only JPG, PNG, GIF, and WebP images are allowed.";
    } elseif ($file['size'] > $max_size) {
        $error = "File is too large. Maximum size is 5MB.";
    } else {