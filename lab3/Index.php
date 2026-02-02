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

<?php if ($success): ?>
  <div class="success">
    <strong>Thank you!</strong> Your message has been sent successfully.<br>
    We'll get back to you soon.
  </div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
  <div style="color:#d32f2f; background:#ffebee; padding:1rem; border-radius:6px; margin-bottom:1.5rem;">
    <strong>Please fix the following errors:</strong>
    <ul style="margin:0.5rem 0 0 1.2rem; padding-left:0;">
      <?php foreach ($errors as $err): ?>
        <li><?= htmlspecialchars($err) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="post" action="process.php" novalidate>
  <!-- Honeypot spam trap -->
  <div class="honeypot">
    <label for="website_url">Website (leave empty)</label>
    <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
  </div>

  <label for="first_name">First Name *</label>
  <input 
    type="text" 
    id="first_name" 
    name="first_name" 
    value="<?= htmlspecialchars($form_data['first_name']) ?>"
    required 
    minlength="2" 
    maxlength="50"
    placeholder="John"
  >

  <label for="last_name">Last Name *</label>
  <input 
    type="text" 
    id="last_name" 
    name="last_name" 
    value="<?= htmlspecialchars($form_data['last_name']) ?>"
    required 
    minlength="2" 
    maxlength="50"
    placeholder="Smith"
  >

  <label for="email">Email Address *</label>
  <input 
    type="email" 
    id="email" 
    name="email" 
    value="<?= htmlspecialchars($form_data['email']) ?>"
    required 
    placeholder="john@example.com"
  >

  <label for="message">Message *</label>
  <textarea 
    id="message" 
    name="message" 
    rows="6" 
    required 
    minlength="10" 
    maxlength="2000"
    placeholder="How can we help you?"
  ><?= htmlspecialchars($form_data['message']) ?></textarea>

  <button type="submit">Send Message</button>
</form>

</body>
</html>