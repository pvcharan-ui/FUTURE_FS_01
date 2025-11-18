<?php
require 'inc/config.php';
include 'inc/header.php';

// server-side handling
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $errors[] = "Name, email and message are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        // Redirect to avoid double POST
        header("Location: /FUTURE_FS_01/contact.php?sent=1");
        exit;
    }
}

if (isset($_GET['sent']) && $_GET['sent'] == '1') {
    $success = "Thanks! Your message has been sent.";
}
?>

<section class="card contact-card">
  <h2>Contact Me</h2>

  <?php if (!empty($errors)): ?>
    <div class="form-alert form-alert-error">
      <?php foreach ($errors as $e) echo "<div>" . htmlspecialchars($e) . "</div>"; ?>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="form-alert form-alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="post" action="/FUTURE_FS_01/contact.php" class="contact-form" novalidate>
    <div class="form-row">
      <label for="name">Name <span class="required">*</span></label>
      <input id="name" name="name" type="text" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" />
    </div>

    <div class="form-row">
      <label for="email">Email <span class="required">*</span></label>
      <input id="email" name="email" type="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" />
    </div>

    <div class="form-row full">
      <label for="subject">Subject (optional)</label>
      <input id="subject" name="subject" type="text" value="<?= isset($subject) ? htmlspecialchars($subject) : '' ?>" />
    </div>

    <div class="form-row full">
      <label for="message">Message <span class="required">*</span></label>
      <textarea id="message" name="message" rows="6" required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn-primary">Send Message</button>
      <button type="reset" class="btn-muted">Reset</button>
    </div>
  </form>
</section>

<?php include 'inc/footer.php'; ?>
