<?php if ($success = $this->getMessage()->getSuccess()) : ?>
  <?php $this->getMessage()->clearSuccess(); ?>
  <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $success; ?>
  </div>
<?php endif; ?>

<?php if ($failure = $this->getMessage()->getFailure()) : ?>
  <?php $this->getMessage()->clearFailure(); ?>
  <div class="alert alert-dismissible alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $failure; ?>
  </div>
<?php endif; ?>