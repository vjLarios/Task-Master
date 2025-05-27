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

<h1>Crear Nueva Tarea</h1>
<form action="<?php echo BASE_URL; ?>/tasks" method="POST">
  <div class="form-group">
    <label for="title">Título:</label>
    <input type="text" id="title"  class="validable" name="title">
  </div>
  <div class="form-group">
    <label for="description">Descripción:</label>
    <textarea id="description" name="description"></textarea>
  </div>
  <div class="form-group">
    <label for="due_date">Fecha de vencimiento:</label>
    <input type="date" id="due_date" class="validable" name="due_date" min="<?php echo date('Y-m-d'); ?>" >
  </div>
  <div class="form-group">
    <label for="status">Estado:</label>
    <select id="status" name="status" class="validable">
      <option value="" disabled selected>Seleccione un estado</option>
      <option value="pendiente">Pendiente</option>
      <option value="en progreso">En progreso</option>
      <option value="completada">Completada</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Guardar tarea</button>
</form>

<p><a href="<?php echo BASE_URL; ?>/tasks" class="btn btn-secondary">← Volver al listado</a></p>

<?php require __DIR__ . '/../../layouts/main_foot.php'; ?>
