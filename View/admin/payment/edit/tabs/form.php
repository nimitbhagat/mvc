<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="form">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Payment Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Payment Details</p><br>
                        <?php } ?>
                    </legend>


                    <?php $payment = $this->getPayment(); ?>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="name">NAME</label>
                            <input id="name" name="payment[name]" value="<?php echo $payment->name ?>" type="text" placeholder="NAME" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="code">CODE</label>
                            <input id="code" name="payment[code]" value="<?php echo $payment->code ?>" type="text" placeholder="CODE" class="validate form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="amount">AMOUNT</label>
                            <input id="amount" name="payment[amount]" value="<?php echo $payment->amount ?>" type="text" placeholder="AMOUNT" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">DESCRIPTION</label>
                            <textarea name="payment[description]" class="form-control" id="description" rows="3" placeholder="DESCRIPTION"><?php echo $payment->description ?></textarea>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?php if ($payment->status) {
                                $label = 'checked';
                                $value = '1';
                            } else {
                                $label = '';
                                $value = '0';
                            }
                            ?>
                            <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='payment[status]'>
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                    </div>


                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').load();">Add Payment
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').load();">Update Payment
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