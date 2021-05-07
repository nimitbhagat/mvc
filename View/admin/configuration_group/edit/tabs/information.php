<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="form">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Configuration Group Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Configuration Group Details</p><br>
                        <?php } ?>
                    </legend>


                    <div class="row">

                        <?php $configurationGroup = $this->getConfigurationGroup(); ?>

                        <div class="form-group col-md-12">
                            <label for="code">GROUP NAME</label>
                            <input id="code" name="config_group[name]" value="<?php echo $configurationGroup->name ?>" type="text" placeholder="GROUP NAME" class="validate form-control" require>
                        </div>

                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').load();">Add Configuration Group
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').load();">Update Configuration Group
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php } ?>
                    <button type="reset" class="btn btn-warning">Reset <i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" onclick="mage.setUrl('<?php echo  $this->getUrl()->getUrl('grid', null, null, true) ?>').load();">
                        Cancel
                        <i class="fa fa-times">
                        </i>
                    </a>
                </fieldset>
            </form>

        </div>
    </div>
</div>