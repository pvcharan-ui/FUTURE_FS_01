<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>My Portfolio</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/FUTURE_FS_01/assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <div class="brand">
      <a class="logo" href="/FUTURE_FS_01/">PILLA VENKATA SREE CHARAN REDDY</a>
      <div class="tag">B.Tech CSE • Full-Stack Developer</div>
    </div>

    <nav class="main-nav" aria-label="Main navigation">
      <a href="/FUTURE_FS_01/" class="nav-link <?= $current === 'index.php' ? 'active' : '' ?>">Home</a>
      <a href="/FUTURE_FS_01/about.php" class="nav-link <?= $current === 'about.php' ? 'active' : '' ?>">About</a>
      <a href="/FUTURE_FS_01/projects.php" class="nav-link <?= $current === 'projects.php' ? 'active' : '' ?>">Projects</a>
      <a href="/FUTURE_FS_01/contact.php" class="nav-link <?= $current === 'contact.php' ? 'active' : '' ?>">Contact</a>
    </nav>
  </div>
</header>

<main class="container">
