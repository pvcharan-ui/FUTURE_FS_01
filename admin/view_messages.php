<?php
require_once __DIR__ . '/../inc/config.php';
include __DIR__ . '/../inc/header.php';

$adminPass = 'future123';
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Admin Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Authentication required.';
    exit;
} else {
    if (!($_SERVER['PHP_AUTH_USER'] === 'admin' && $_SERVER['PHP_AUTH_PW'] === $adminPass)) {
        echo "<p>Invalid credentials.</p>";
        exit;
    }
}

$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll();
?>

<section class="card">
  <h2>Contact Messages</h2>

  <?php if(empty($messages)): ?>
    <p>No messages yet.</p>
  <?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse">
      <thead style="background:#fafafa">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Received</th></tr>
      </thead>
      <tbody>
        <?php foreach($messages as $m): ?>
        <tr>
          <td><?= $m['id'] ?></td>
          <td><?= htmlspecialchars($m['name']) ?></td>
          <td><?= htmlspecialchars($m['email']) ?></td>
          <td><?= htmlspecialchars($m['subject']) ?></td>
          <td><?= nl2br(htmlspecialchars($m['message'])) ?></td>
          <td><?= $m['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</section>

<?php include __DIR__ . '/../inc/footer.php'; ?>
