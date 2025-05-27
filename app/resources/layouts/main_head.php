<?php
// app/resources/layouts/main_head.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Task Master</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <header class="navbar">
    <div class="navbar-brand">
      <a href="<?php echo BASE_URL; ?>">TaskMaster</a>
    </div>
    <nav class="navbar-nav">
      <a href="<?php echo BASE_URL; ?>">Home</a>
      <a href="<?php echo BASE_URL; ?>/tasks">Tasks</a>
      <a href="<?php echo BASE_URL; ?>/profile">Profile</a>
    </nav>
  </header>
  <main class="content">
