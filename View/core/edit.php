<div class="row">
    <?php if ($this->getRequest()->getGet('id')) : ?>
        <div class="col-lg-3">
            <?php echo $this->getTabHtml(); ?>
        </div>
    <?php endif; ?>

    <div class="<?php echo ($this->getRequest()->getGet('id')) ? "col-lg-9" : "col-lg-12"; ?>">
        <?php echo $this->getTabContent(); ?>
    </div>
</div>