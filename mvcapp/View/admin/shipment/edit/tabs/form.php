<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Shipment Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Shipment Details</p><br>
                        <?php } ?>
                    </legend>

                    <?php $shipment = $this->getShipment(); ?>

                    <div class="row">
                        <!-- Name	Code	Amount	Description	Status	Created At -->
                        <div class="form-group col-md-4">
                            <label for="name">NAME</label>
                            <input id="name" name="shipment[name]" value="<?php echo $shipment->name ?>" type="text" placeholder="NAME" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="code">CODE</label>
                            <input id="code" name="shipment[code]" value="<?php echo $shipment->code ?>" type="text" placeholder="CODE" class="validate form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="amount">AMOUNT</label>
                            <input id="amount" name="shipment[amount]" value="<?php echo $shipment->amount ?>" type="text" placeholder="AMOUNT" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">DESCRIPTION</label>
                            <textarea name="shipment[description]" class="form-control" id="description" rows="3" placeholder="PRODUCT DESCRIPTION"><?php echo $shipment->description ?></textarea>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?php if ($shipment->status) {
                                $label = 'checked';
                                $value = '1';
                            } else {
                                $label = '';
                                $value = '0';
                            }
                            ?>
                            <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='shipment[status]'>
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="submit" name="add">Add Shipment
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="submit" name="edit">Update Shipment
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php } ?>
                    <button type="reset" class="btn btn-warning">Reset <i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>">Cancle <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>