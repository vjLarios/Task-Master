<!-- app/resources/views/tasks/show.view.php -->
<?php require __DIR__ . '/../../layouts/main_head.php'; ?>

<div class="card detail-card">
  <h2 class="card-title">Detalles de la tarea</h2>
  <dl class="detail-list">
    <dt>Título:</dt><dd><?php echo htmlspecialchars($task['title']); ?></dd>
    <dt>Descripción:</dt><dd><?php echo nl2br(htmlspecialchars($task['description'])); ?></dd>
    <dt>Fecha de vencimiento:</dt><dd><?php echo htmlspecialchars($task['due_date']); ?></dd>
    <dt>Estado:</dt><dd><?php echo Task::mostrarStatus($task['status']); ?></dd>
  </dl>
  <div class="actions">
    <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>/edit" class="btn btn-secondary">Editar</a>
    <button data-method="DELETE" data-url="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" class="btn btn-primary">Eliminar</button>
  </div>
</div>

<?php require __DIR__ . '/../../layouts/main_foot.php'; ?>
