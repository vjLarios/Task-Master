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
<form action="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" method="POST" id="formEditarTarea" autocomplete="off">
  <div class="form-group">
    <label for="title">Título:</label>
    <input type="text" id="title" class="validable" name="title" 
           value="<?php echo htmlspecialchars($task['title']); ?>">
  </div>
  <div class="form-group">
    <label for="description">Descripción:</label>
    <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
  </div>
  <div class="form-group">
    <label for="due_date">Fecha de vencimiento:</label>
    <input type="date" id="due_date" class="validable" name="due_date"
           value="<?php echo htmlspecialchars($task['due_date']); ?>"
           min="<?php echo date('Y-m-d'); ?>">
  </div>
  <div class="form-group">
    <label for="status">Estado:</label>
    <select id="status" name="status" class="validable">
      <option value="">Selecciona un estado</option>
      <option value="pendiente" <?php if(($task['status'] ?? '')==='pendiente') echo 'selected'; ?>>Pendiente</option>
      <option value="en progreso" <?php if(($task['status'] ?? '')==='en progreso') echo 'selected'; ?>>En progreso</option>
      <option value="completada" <?php if(($task['status'] ?? '')==='completada') echo 'selected'; ?>>Completada</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Actualizar tarea</button>
</form>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formEditarTarea');
    form.noValidate = true;
    form.addEventListener('submit', function(e) {
      const campos = form.querySelectorAll('.validable');
      for (let campo of campos) {
        if (!campo.value.trim()) {
          e.preventDefault();
          if (campo.id === 'due_date') {
            Swal.fire({
              icon: 'error',
              title: 'Fecha inválida',
              text: 'La fecha debe ser igual o posterior a la actual.'
            });
          } else if (campo.id === 'title') {
            Swal.fire({
              icon: 'error',
              title: 'Campo obligatorio',
              text: 'El título es obligatorio.'
            });
          } else if (campo.id === 'status') {
            Swal.fire({
              icon: 'error',
              title: 'Campo obligatorio',
              text: 'Debes seleccionar un estado.'
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Campo obligatorio',
              text: 'Por favor completa todos los campos requeridos.'
            });
          }
          campo.focus();
          return;
        }
      }
      const fecha = form.querySelector('#due_date').value;
      const hoy = new Date();
      hoy.setHours(0,0,0,0);
      const fechaSel = new Date(fecha);
      if (fechaSel < hoy) {
        e.preventDefault();
        Swal.fire({
          icon: 'error',
          title: 'Fecha inválida',
          text: 'La fecha debe ser igual o posterior a la actual.'
        });
        form.querySelector('#due_date').focus();
        return;
      }
    });
  });
</script>

<p><a href="<?php echo BASE_URL; ?>/tasks" class="btn btn-secondary">← Volver al listado</a></p>

<?php require __DIR__ . '/../../layouts/main_foot.php'; ?>
