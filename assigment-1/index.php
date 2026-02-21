<?php
require 'config.php';

// Our success message is here yippee, hopefully
$msg = $_GET['msg'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Team Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

  <h1 class="mb-4">Basketball Team Tracker</h1>
<!-- messages for each addition, update, or termination -->
  <?php if ($msg === 'added'): ?>
    <div class="alert alert-success">Member added successfully.</div>
  <?php elseif ($msg === 'updated'): ?>
    <div class="alert alert-success">Member updated successfully.</div>
  <?php elseif ($msg === 'deleted'): ?>
    <div class="alert alert-success">Member deleted successfully.</div>
  <?php endif; ?>

  <p class="mb-4">
    <a href="create.php" class="btn btn-primary">+ Add New Member</a>
  </p>

  <?php
  $stmt = $pdo->query("SELECT * FROM team_members ORDER BY last_name, first_name");
  $members = $stmt->fetchAll();

  if (empty($members)):
  ?>
    <div class="alert alert-info">No team members added yet.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Team</th>
            <th>Actions</th>
          </tr>
        </thead>