<!-- app/resources/views/home.view.php -->
<?php require __DIR__ . '/../layouts/main_head.php'; ?>
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
  <form method="get" id="filterForm" style="display:flex;gap:8px;width:100%">
    <input type="text" name="search" placeholder="Buscar tareas..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
    <select name="status">
      <option value="">Todos los estados</option>
      <option value="pendiente" <?php if(($_GET['status'] ?? '')==='pendiente') echo 'selected'; ?>>Pendiente</option>
      <option value="en progreso" <?php if(($_GET['status'] ?? '')==='en progreso') echo 'selected'; ?>>En progreso</option>
      <option value="completada" <?php if(($_GET['status'] ?? '')==='completada') echo 'selected'; ?>>Completada</option>
    </select>
    <select name="sort">
      <option value="">Ordenar por...</option>
      <option value="date_asc" <?php if(($_GET['sort'] ?? '')==='date_asc') echo 'selected'; ?>>Fecha ↑</option>
      <option value="date_desc" <?php if(($_GET['sort'] ?? '')==='date_desc') echo 'selected'; ?>>Fecha ↓</option>
      <option value="title_asc" <?php if(($_GET['sort'] ?? '')==='title_asc') echo 'selected'; ?>>Título A-Z</option>
      <option value="title_desc" <?php if(($_GET['sort'] ?? '')==='title_desc') echo 'selected'; ?>>Título Z-A</option>
    </select>
    <a href="<?php echo BASE_URL; ?>/tasks/create" class="btn btn-primary">Crear tarea</a>
  </form>
</div>
<script>
  // Filtrado automático al cambiar select o escribir
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filterForm');
    form.status.onchange = form.sort.onchange = function() { form.submit(); };
    form.search.oninput = function() { form.submit(); };
  });
</script>

<div class="card-container">
  <?php if (empty($tasks)): ?>
    <p>No tasks found.</p>
  <?php else: foreach ($tasks as $task): ?>
    <div class="card">
      <h3><?php echo htmlspecialchars($task['title']); ?></h3>
      <p>Due Date: <?php echo htmlspecialchars($task['due_date']); ?></p>
      <p>Status: <?php echo htmlspecialchars($task['status']); ?></p>
      <div class="actions">
        <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" class="btn btn-secondary">View</a>
        <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>/edit" class="btn btn-secondary">Edit</a>
      </div>
    </div>
  <?php endforeach; endif; ?>
</div>

<?php require __DIR__ . '/../layouts/main_foot.php'; ?>
