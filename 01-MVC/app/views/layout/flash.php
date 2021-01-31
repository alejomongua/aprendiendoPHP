<?php if (isset($_SESSION['success'])): ?>
  <article class="message is-success">
    <div class="message-header">
      <p><?= $_SESSION['success'] ?></p>
    </div>
  </article>
  <?php unset($_SESSION['success']) ?>
<?php endif ?>
<?php if (isset($_SESSION['danger'])): ?>
  <article class="message is-danger">
    <div class="message-header">
      <p><?= $_SESSION['danger'] ?></p>
    </div>
  </article>
  <?php unset($_SESSION['danger']) ?>
<?php endif ?>