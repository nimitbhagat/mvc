<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">

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

                        <button class="btn btn-primary" type="submit" name="add">Add Payment
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="submit" name="edit">Update Payment
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php } ?>
                    <button type="reset" class="btn btn-warning">Reset <i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>















<form action="<?php echo $this->getUrl('save'); ?>" method="post">

    <?php $payment = $this->getPayment(); ?>
    <div class="container">
        <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
                <h4 class="card-title">
                    <?php if ($this->getController()->getRequest()->getGet('id')) : ?>
                        <p class="h2 text-center">Update Payment Details</p><br>
                    <?php else : ?>
                        <p class="h2 text-center">Add Payment Details</p><br>
                    <?php endif; ?>
                </h4>
                <p class="card-text">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="paymentname" name="payment[name]" value="<?php echo $payment->name ?>" type="text" class="validate">
                                <label for="paymentname">Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="paymentname" name="payment[code]" value="<?php echo $payment->code ?>" type="text" class="validate">
                                <label for="paymentname">Code</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="desc" name="payment[description]" class="materialize-textarea"><?php echo $payment->description ?></textarea>
                                <label for="desc">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="paymentname" name="payment[amount]" value="<?php echo $payment->amount ?>" type="text" class="validate">
                                <label for="paymentname">Amount</label>
                            </div>
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label>
                                        Disabled
                                        <?php if ($payment->status) {
                                            $label = 'checked';
                                        } else {
                                            $label = '!checked';
                                        }
                                        ?>
                                        <input name='payment[status]' type='checkbox' <?php echo $label; ?>>
                                        <span class="lever"></span>
                                        Enabled
                                    </label>
                                </div>
                            </div>
                        </div>

                        <?php if (!$this->getController()->getRequest()->getGet('id')) : ?>
                            <button class="btn waves-effect waves-light" type="submit" name="add">Add Payment
                                <i class="material-icons right">add</i>
                            </button>
                        <?php else : ?>
                            <button class="btn waves-effect waves-light" type="submit" name="add">Update Payment
                                <i class="material-icons right">edit</i>
                            </button>
                        <?php endif; ?>
                        <button class="btn waves-effect waves-light" type="reset" name="cancel">Cancel
                            <i class="material-icons right">close</i>
                        </button>
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>
</form>