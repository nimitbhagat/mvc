<div class="container col-lg-8">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save', 'admin\attribute\option'); ?>" method="post" id="form">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) : ?>
                            <p class="h2 text-center">Update Attribute Details</p><br>
                        <?php else : ?>
                            <p class="h2 text-center">Add Attribute Details</p><br>
                        <?php endif; ?>
                    </legend>

                    <div class="row">
                        <div class="form-group col-md-8">
                        </div>
                        <div class="form-group col-md-4">
                            <button type="button" id="add" name="add" class="btn btn-warning form-control" onclick="addOption();">Add Option <i class="fa fa-plus"></i></button>
                        </div>
                    </div>

                    <?php $option = $this->getOption(); ?>

                    <div class="row" id="existingOption">
                        <?php if ($option) : ?>
                            <?php foreach ($option->getData() as $key => $value) : ?>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-5">
                                        <label for="name<?php echo $value->optionId; ?>">OPTION NAME</label>
                                        <input id="name<?php echo $value->optionId; ?>" name="existing[<?php echo $value->optionId; ?>][name]" value="<?php echo $value->name ?>" type="text" placeholder="Option NAME" class="validate form-control" require>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="sortOrder<?php echo $value->optionId; ?>">OPTION SORT ORDER</label>
                                        <input id="sortOrder<?php echo $value->optionId; ?>" name="existing[<?php echo $value->optionId; ?>][sortOrder]" value="<?php echo $value->sortOrder ?>" type="text" placeholder="Option NAME" class="validate form-control" require>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="remove">&nbsp;</label>
                                        <a class="btn btn-warning form-control" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'admin\attribute\option', ['optionId' => $value->optionId], true); ?>').load()" href="javascript:void(0);">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>



                    <?php if (!$this->getRequest()->getGet('id')) : ?>

                        <button class="btn btn-primary" type="button" onclick="mage.resetParams().setForm('#form').load();">Add Attribute
                            <i class=" fa fa-plus"></i>
                        </button>
                    <?php else : ?>
                        <button class="btn btn-primary" type="button" onclick="mage.resetParams().setForm('#form').load();">Update Attribute
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php endif; ?>
                    <a class="btn btn-danger" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" href="javascript:void(0)">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>

<div style="display: none;" id="newOption">
    <div class="row col-md-12">
        <div class="form-group col-md-5">
            <label for="name">OPTION NAME</label>
            <input id="name" name="new[name][]" type="text" placeholder="OPTION NAME" class="validate form-control" require>
        </div>

        <div class="form-group col-md-5">
            <label for="sortOrder">OPTION SORT ORDER</label>
            <input id="sortOrder" name="new[sortOrder][]" type="text" placeholder="Option NAME" class="validate form-control" require>
        </div>

        <div class="form-group col-md-2">
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