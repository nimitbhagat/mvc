<div>
  <?php
  $tabs = $this->getTabs();
  $urlTab = $this->getRequest()->getGet('tab');
  ?>

  <?php foreach ($tabs as $key => $value) : ?>
    <?php $active = ""; ?>
    <a href="javascript:void(0)" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['tab' => $key]); ?>').resetParams().load();" class="btn btn-primary btn-lg btn-block <?php echo ($key == $urlTab) ? "active" : ""; ?>">
      <?php echo $value['label'] ?>
    </a>
  <?php endforeach; ?>
</div>