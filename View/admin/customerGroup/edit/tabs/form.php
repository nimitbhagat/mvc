<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="form">
                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Customer Group Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Customer Group Details</p><br>
                        <?php } ?>
                    </legend>

                    <?php $customerGroup = $this->getCustomerGroup(); ?>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="productname">NAME</label>
                            <input id="productname" name="customerGroup[name]" value="<?php echo $customerGroup->name ?>" type="text" placeholder="PRODUCT NAME" class="validate form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?php if ($customerGroup->status) {
                                $label = 'checked';
                                $value = '1';
                            } else {
                                $label = '';
                                $value = '0';
                            }
                            ?>
                            <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='customerGroup[status]'>
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                    </div>


                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').load();">Add Customer Group
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').load();">Update Customer Group
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php } ?>
                    <button type="reset" class="btn btn-warning">Reset <i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" href="javascript:void(0)">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>