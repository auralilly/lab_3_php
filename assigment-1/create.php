<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Team Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4">Add New Team Member</h1>
  <a href="index.php" class="btn btn-secondary mb-4">← Back</a>

  <form action="process.php" method="post" class="card p-4 shadow-sm">
    <input type="hidden" name="action" value="create">