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

<h1>Editar Tarea </h1>
<form action="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" method="POST">
  <div class="form-group">
    <label for="title">Título:</label>
    <input type="text" id="title" name="title" class="validable" 
           value="<?php echo htmlspecialchars($task['title']); ?>" >
  </div>
  <div class="form-group">
    <label for="description">Descripción:</label>
    <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
  </div>
  <div class="form-group">
    <label for="due_date">Fecha de vencimiento:</label>
    <input type="date" id="due_date" name="due_date"
           value="<?php echo htmlspecialchars($task['due_date']); ?>"
           min="<?php echo date('Y-m-d'); ?>" class="validable">
  </div>
  <div class="form-group">
    <label for="status">Estado:</label>
    <select id="status" name="status" class="validable" >
      <?php foreach (['pendiente','en progreso','completada'] as $estado): ?>
        <option value="<?php echo $estado; ?>" <?php echo $task['status'] === $estado ? 'selected' : ''; ?>>
          <?php echo ucfirst($estado); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Actualizar tarea</button>
</form>

<p><a href="<?php echo BASE_URL; ?>/tasks" class="btn btn-secondary">← Volver al listado</a></p>

<?php require __DIR__ . '/../../layouts/main_foot.php'; ?>
