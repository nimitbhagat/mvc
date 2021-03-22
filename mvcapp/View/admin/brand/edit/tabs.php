<?php
$tabs = $this->getTabs();
$urlTab = $this->getRequest()->getGet('tab');

foreach ($tabs as $key => $value) {
    $active = ""; ?>
    <a href="<?php echo $this->getUrl()->getUrl(null, null, ["tab" => $key]); ?>" class="btn btn-primary btn-lg btn-block <?php echo ($key == $urlTab) ? "active" : ""; ?>">
        <?php echo $value['label'] ?>
    </a>
<?php } ?>