<?php
// app/resources/layouts/main_foot.php
?>
  </main>
  <footer class="site-footer">
    <p>Contact: support@taskmaster.com </p>
  </footer>
  <script src="<?php echo BASE_URL; ?>/assets/js/app.js"></script>
  <?php if(!empty($_SESSION['flash_message'])): ?>
<script>
  Swal.fire({
    icon: '<?php echo $_SESSION['flash_type']; ?>',
    title: '<?php echo $_SESSION['flash_message']; ?>'
  });
</script>
<?php 
  unset($_SESSION['flash_message'], $_SESSION['flash_type']);
endif; 
?>

</body>
</html>
