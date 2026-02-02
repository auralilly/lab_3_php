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