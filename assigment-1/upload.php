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