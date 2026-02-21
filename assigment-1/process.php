<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$action = $_POST['action'] ?? '';

$first_name  = trim(filter_input(INPUT_POST, 'first_name',  FILTER_SANITIZE_SPECIAL_CHARS) ?? '');
$last_name   = trim(filter_input(INPUT_POST, 'last_name',   FILTER_SANITIZE_SPECIAL_CHARS) ?? '');
$position    = trim(filter_input(INPUT_POST, 'position',    FILTER_SANITIZE_SPECIAL_CHARS) ?? '');
$phone       = trim(filter_input(INPUT_POST, 'phone',       FILTER_SANITIZE_SPECIAL_CHARS) ?? '');
$email       = trim(filter_input(INPUT_POST, 'email',       FILTER_SANITIZE_EMAIL) ?? '');
$team_name   = trim(filter_input(INPUT_POST, 'team_name',   FILTER_SANITIZE_SPECIAL_CHARS) ?? '');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? 0;

$errors = [];

if ($first_name === '') {
    $errors[] = "First Name is required.";
} elseif (strlen($first_name) < 2) {
    $errors[] = "First Name must be at least 2 characters.";
}

if ($last_name === '') {
    $errors[] = "Last Name is required.";
} elseif (strlen($last_name) < 2) {
    $errors[] = "Last Name must be at least 2 characters.";
}

if ($email === '') {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email must be a valid email address.";
}

if ($team_name === '') {
    $errors[] = "Team Name is required.";
} elseif (strlen($team_name) < 2) {
    $errors[] = "Team Name must be at least 2 characters.";
}

if (!empty($errors)) {
    require "includes/header.php";
    echo "<div class='alert alert-danger mt-4'>";
    echo "<h2>Please fix the following errors:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
    require "includes/footer.php";
    exit;
}

if ($action === 'create') {
    $sql = "
        INSERT INTO team_members 
        (first_name, last_name, position, phone, email, team_name)
        VALUES (:first_name, :last_name, :position, :phone, :email, :team_name)
    ";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':first_name',  $first_name);
    $stmt->bindParam(':last_name',   $last_name);
    $stmt->bindParam(':position',    $position);
    $stmt->bindParam(':phone',       $phone);
    $stmt->bindParam(':email',       $email);
    $stmt->bindParam(':team_name',   $team_name);

    $stmt->execute();

    header("Location: index.php?msg=added");
    exit;
}

elseif ($action === 'update' && $id > 0) {
    $sql = "
        UPDATE team_members SET
            first_name = :first_name,
            last_name  = :last_name,
            position   = :position,
            phone      = :phone,
            email      = :email,
            team_name  = :team_name
        WHERE id = :id
    ";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':first_name',  $first_name);
    $stmt->bindParam(':last_name',   $last_name);
    $stmt->bindParam(':position',    $position);
    $stmt->bindParam(':phone',       $phone);
    $stmt->bindParam(':email',       $email);
    $stmt->bindParam(':team_name',   $team_name);
    $stmt->bindParam(':id',          $id, PDO::PARAM_INT);

    $stmt->execute();

    header("Location: index.php?msg=updated");
    exit;
}

header("Location: index.php");
exit;
//So for this project i was a lot of love, and hate with the update that i put a placeholder code till i reviewed some old lectures. no clue if it would work with them, but i just wanted to stop seeing errors. The easiest part by far was the sql. Not giving me much trouble. though i will say losing the code was a night mare, and having to redo it all was stressful to say the least as it had gotten corrupted. though thats my little reflection hope the project is nice to you like it was not to me.

//citations https://www.php.net/manual/en/function.is-numeric.php 
// https://www.php.net/manual/en/function.isset.php where i found the place holders, and how to remember some things
//https://www.php.net/manual/en/control-structures.foreach.php