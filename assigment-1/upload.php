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
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = "member_" . $member_id . "_" . time() . "." . $ext;
        $upload_path = "assets/uploads/" . $new_filename;

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            // Update teammember picture
            $stmt = $pdo->prepare("UPDATE team_members SET photo = ? WHERE id = ?");
            $stmt->execute([$new_filename, $member_id]);
            
            $success = "Photo uploaded successfully!";
        } else {
            $error = "Failed to save the file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload Photo - <?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2>Upload Photo for <?= htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) ?></h2>
  
  <a href="index.php" class="btn btn-secondary mb-4">← Back to Team</a>
  <?php if ($success): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <div class="card p-4 shadow-sm">
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Choose Photo</label>
        <input type="file" name="photo" class="form-control" accept="image/*" required>
        <small class="text-muted">Allowed: JPG, PNG, GIF, WebP (max 5MB)</small>
      </div>
      
      <button type="submit" class="btn btn-primary">Upload Photo</button>
    </form>
  </div>

  <?php if (!empty($member['photo'])): ?>
    <div class="mt-4">
      <h5>Current Photo:</h5>
      <img src="assets/uploads/<?= htmlspecialchars($member['photo']) ?>" 
           alt="Current photo" class="img-fluid rounded shadow" style="max-width: 300px;">
    </div>
  <?php endif; ?>
</div>

</body>
</html>
