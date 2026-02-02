<?php
require_once 'config.php';

session_start(); 

$errors = [];
$success = false;
$form_data = [
    'first_name' => '',
    'last_name'  => '',
    'email'      => '',
    'message'    => ''
];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and trim inputs
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name']  ?? '');
    $email      = trim($_POST['email']      ?? '');
    $message    = trim($_POST['message']    ?? '');

    // Store for repopulation
    $form_data = [
        'first_name' => $first_name,
        'last_name'  => $last_name,
        'email'      => $email,
        'message'    => $message
    ];

    // ---------------- SERVER-SIDE VALIDATION ----------------
    if (empty($first_name)) {
        $errors[] = "First name is required.";
    } elseif (strlen($first_name) < 2 || strlen($first_name) > 50) {
        $errors[] = "First name must be between 2 and 50 characters.";
    }

    if (empty($last_name)) {
        $errors[] = "Last name is required.";
    } elseif (strlen($last_name) < 2 || strlen($last_name) > 50) {
        $errors[] = "Last name must be between 2 and 50 characters.";
    }