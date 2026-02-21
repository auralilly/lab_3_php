<?php
require 'config.php';

//goes looking for the id

    header("Location: index.php");
    exit;
$id = $_GET['id'];
// sql query for the team members id
$stmt = $pdo->prepare("SELECT * FROM team_members WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();
//Lets me know if we found the member, or i guess in this cae if we didn't find him
if (!$row) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Team Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4">Edit Team Member</h1>
  <a href="index.php" class="btn btn-secondary mb-4">← Back</a>

  <form action="process.php" method="post" class="card p-4 shadow-sm">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">First Name *</label>
        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($row['first_name']) ?>" required minlength="2">
      </div>
      <div class="col-md-6">
        <label class="form-label">Last Name *</label>
        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($row['last_name']) ?>" required minlength="2">
      </div>
      <div class="col-md-6">
        <label class="form-label">Position</label>
        <select name="position" class="form-select">
          <option value="">— Select —</option>
          <?php
          $opts = ['Point Guard','Shooting Guard','Small Forward','Power Forward','Center'];
          foreach ($opts as $opt) {
              $sel = ($row['position'] === $opt) ? 'selected' : '';
              echo "<option value=\"$opt\" $sel>$opt</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($row['phone']) ?>">
      </div>
      <div class="col-12">
        <label class="form-label">Email *</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
      </div>
      <div class="col-12">
        <label class="form-label">Team Name *</label>
        <input type="text" name="team_name" class="form-control" value="<?= htmlspecialchars($row['team_name']) ?>" required minlength="2">
      </div>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Update Member</button>
  </form>
</div>
</body>
</html>