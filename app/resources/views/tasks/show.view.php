<!-- app/resources/views/tasks/show.view.php -->
<?php require __DIR__ . '/../../layouts/main_head.php'; ?>

<div class="card detail-card">
  <h2 class="card-title">Task Details</h2>
  <dl class="detail-list">
    <dt>Title:</dt><dd><?php echo htmlspecialchars($task['title']); ?></dd>
    <dt>Description:</dt><dd><?php echo nl2br(htmlspecialchars($task['description'])); ?></dd>
    <dt>Due Date:</dt><dd><?php echo htmlspecialchars($task['due_date']); ?></dd>
    <dt>Status:</dt><dd><?php echo htmlspecialchars($task['status']); ?></dd>
  </dl>
  <div class="actions">
    <a href="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>/edit" class="btn btn-secondary">Edit</a>
    <button data-method="DELETE" data-url="<?php echo BASE_URL; ?>/tasks/<?php echo $task['id']; ?>" class="btn btn-primary">Delete</button>
  </div>
</div>

<?php require __DIR__ . '/../../layouts/main_foot.php'; ?>
