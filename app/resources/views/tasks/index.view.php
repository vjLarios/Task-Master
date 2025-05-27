<?php require __DIR__ . '/../../layouts/main_head.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!empty($_SESSION['swal'])) {
    $swal = $_SESSION['swal'];
    echo "<script>Swal.fire({icon: '" . addslashes($swal['icon']) . "', title: '" . addslashes($swal['title']) . "', text: '" . addslashes($swal['text']) . "'});</script>";
    unset($_SESSION['swal']);
}
?>

<div class="search-container">
  <input type="text" placeholder="Buscar tareas...">
  <a href="<?php echo BASE_URL; ?>/tasks/create" class="btn btn-primary">Crear nueva tarea</a>
</div>

<div class="card-container">
  <?php if (empty($tasks)): ?>
    <p>No hay tareas registradas.</p>
  <?php else: foreach ($tasks as $task): ?>
    <div class="card">
      <h3><?php echo htmlspecialchars($task['title']); ?></h3>
      <p><strong>Vencimiento:</strong> <?php echo htmlspecialchars($task['due_date']); ?></p>
      <p><strong>Estado:</strong> <?php echo Task::mostrarStatus($task['status']); ?></p>
      <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" class="btn btn-secondary">Ver</a>
      <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>/edit" class="btn btn-secondary">Editar</a>
    </div>
  <?php endforeach; endif; ?>
</div>

<?php require __DIR__ . '/../../layouts/main_foot.php'; ?>
