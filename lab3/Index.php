<?php
require_once 'process.php';  // This will process POST if submitted
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us</title>
  <style>
    body { font-family: system-ui, sans-serif; max-width: 600px; margin: 2rem auto; padding: 0 1rem; }
    .error { color: #d32f2f; font-size: 0.9rem; margin: 0.3rem 0; }
    .success { color: #2e7d32; background: #e8f5e9; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; }
    label { display: block; margin: 1.2rem 0 0.4rem; font-weight: 500; }
    input, textarea { width: 100%; padding: 0.7rem; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; }
    input:invalid:focus, textarea:invalid:focus { border-color: #d32f2f; outline: none; }
    button { background: #1976d2; color: white; border: none; padding: 0.9rem 1.8rem; border-radius: 6px; cursor: pointer; font-size: 1.05rem; margin-top: 1rem; }
    button:hover { background: #1565c0; }
    .honeypot { display: none; }
  </style>
</head>
<body>

<h1>Contact Us</h1>
