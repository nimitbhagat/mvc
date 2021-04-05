<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save', 'Admin\ConfigurationGroup\Configuration'); ?>" method="post">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Configuration Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Configuration Details</p><br>
                        <?php } ?>
                    </legend>

                    <div class="row">
                        <div class="form-group col-md-9">
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" id="add" name="add" class="btn btn-warning form-control" onclick="addOption();">Add Option <i class="fa fa-plus"></i></button>
                        </div>
                    </div>

                    <?php $configuration = $this->getConfiguration(); ?>

                    <div class="row" id="existingOption">
                        <?php if ($configuration) : ?>
                            <?php foreach ($configuration->getData() as $key => $value) : ?>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="name<?php echo $value->configId; ?>">TITLE</label>
                                        <input id="name<?php echo $value->title; ?>" name="existing[<?php echo $value->configId; ?>][title]" value="<?php echo $value->title ?>" type="text" placeholder="TITLE" class="validate form-control" require>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="sortOrder<?php echo $value->configId; ?>">CODE</label>
                                        <input id="sortOrder<?php echo $value->code; ?>" name="existing[<?php echo $value->configId; ?>][code]" value="<?php echo $value->code ?>" type="text" placeholder="CODE" class="validate form-control" require>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="sortOrder<?php echo $value->configId; ?>">VALUE</label>
                                        <input id="sortOrder<?php echo $value->value; ?>" name="existing[<?php echo $value->configId; ?>][value]" value="<?php echo $value->value ?>" type="text" placeholder="VALUE" class="validate form-control" require>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="remove">&nbsp;</label>
                                        <a class="btn btn-warning form-control" href="<?php echo $this->getUrl()->getUrl('delete', 'admin\ConfigurationGroup\Configuration', null, false) . "&configId={$value->configId}"; ?>"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="submit">Add Attribute
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="submit">Update Attribute
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php } ?>
                    <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<div style="display: none;" id="newOption">
    <div class="row col-md-12">
        <div class="form-group col-md-3">
            <label for="title">TITLE</label>
            <input id="title" name="new[title][]" type="text" placeholder="TITLE" class="validate form-control" require>
        </div>

        <div class="form-group col-md-3">
            <label for="code">CODE</label>
            <input id="code" name="new[code][]" type="text" placeholder="CODE" class="validate form-control" require>
        </div>

        <div class="form-group col-md-3">
            <label for="value">VALUE</label>
            <input id="value" name="new[value][]" type="text" placeholder="VALUE" class="validate form-control" require>
        </div>

        <div class="form-group col-md-3">
            <label for="remove">&nbsp;</label>
            <button type="button" class="btn btn-warning form-control" onclick="removeOption(this);"> <i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>

<script>
    function removeOption(removeButton) {
        var option = removeButton.parentElement.parentElement.remove();
    }

    function addOption() {
        var existingOption = document.getElementById('existingOption');
        var newOption = document.getElementById('newOption').children[0];
        existingOption.prepend(newOption.cloneNode(true));
    }
</script>