<?php if (!$this->validCustomer()) : ?>
    <h2>Register First</h2>
<?php else : ?>
    <div class="container">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <form action="<?php echo $this->getUrl()->getUrl('address', 'customer'); ?>" method="post" id="form">

                    <fieldset>
                        <legend>
                            <?php if ($this->getRequest()->getGet('id')) { ?>
                                <p class="h2 text-center">Update Customer Address Details</p><br>
                            <?php } else { ?>
                                <p class="h2 text-center">Add Customer Address Details</p><br>
                            <?php } ?>
                        </legend>

                        <?php
                        $id = $this->getRequest()->getGet('id');
                        $shippingData = $this->getAddressData($id, 'Shipping');
                        $billingData = $this->getAddressData($id, 'Billing');
                        ?>
                        <div class="row">
                            <div class="card border-secondary mb-3 col-mb-6">
                                <div class="card-header">Shipping Address</div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="address">ADDRESS</label>
                                            <input id="address" name="shipping[address]" value="<?php echo $shippingData->address ?>" type="text" placeholder="ADDRESS" class="validate form-control" require>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="city">CITY</label>
                                            <select class="validate form-control" id="city" name="shipping[city]">
                                                <option selected>SELECT CITY</option>
                                                <option value="VALSAD" <?php echo ($shippingData->city == "VALSAD") ? "selected" : ""; ?>>VALSAD</option>
                                                <option value="MUMBAI" <?php echo ($shippingData->city == "MUMBAI") ? "selected" : ""; ?>>MUMBAI</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="state">STATE</label>
                                            <select class="validate form-control" id="state" name="shipping[state]">
                                                <option selected>SELECT STATE</option>
                                                <option value="GUJARAT" <?php echo ($shippingData->state == "GUJARAT") ? "selected" : ""; ?>>GUJARAT</option>
                                                <option value="MAHARASHTRA" <?php echo ($shippingData->state == "MAHARASHTRA") ? "selected" : ""; ?>>MAHARASHTRA</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="zipcode">ZIPCODE</label>
                                            <input id="zipcode" name="shipping[zipcode]" value="<?php echo $shippingData->zipcode ?>" type="text" placeholder="ZIPCODE" class="validate form-control" require>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="country">COUNTRY</label>
                                            <select class="validate form-control" id="state" name="shipping[country]">
                                                <option selected>SELECT COUNTRY</option>
                                                <option value="INDIA" <?php echo ($shippingData->country == "INDIA") ? "selected" : ""; ?>>INDIA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card border-secondary mb-3 col-mb-6">
                                <div class="card-header">Billing Address</div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="address">ADDRESS</label>
                                            <input id="address" name="billing[address]" value="<?php echo $billingData->address ?>" type="text" placeholder="ADDRESS" class="validate form-control" require>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="city">CITY</label>
                                            <select class="validate form-control" id="city" name="billing[city]">
                                                <option selected>SELECT CITY</option>
                                                <option value="VALSAD" <?php echo ($billingData->city == "VALSAD") ? "selected" : ""; ?>>VALSAD</option>
                                                <option value="MUMBAI" <?php echo ($billingData->city == "MUMBAI") ? "selected" : ""; ?>>MUMBAI</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="state">STATE</label>
                                            <select class="validate form-control" id="state" name="billing[state]">
                                                <option selected>SELECT STATE</option>
                                                <option value="GUJARAT" <?php echo ($billingData->state == "GUJARAT") ? "selected" : ""; ?>>GUJARAT</option>
                                                <option value="MAHARASHTRA" <?php echo ($billingData->state == "MAHARASHTRA") ? "selected" : ""; ?>>MAHARASHTRA</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="zipcode">ZIPCODE</label>
                                            <input id="zipcode" name="billing[zipcode]" value="<?php echo $billingData->zipcode ?>" type="text" placeholder="ZIPCODE" class="validate form-control" require>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="country">COUNTRY</label>
                                            <select class="validate form-control" id="state" name="billing[country]">
                                                <option selected>SELECT COUNTRY</option>
                                                <option value="INDIA" <?php echo ($billingData->country == "INDIA") ? "selected" : ""; ?>>INDIA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if (!$this->getRequest()->getGet('id')) : ?>
                            <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').load();">Add Customer Address
                                <i class="fa fa-plus"></i>
                            </button>
                        <?php else : ?>
                            <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').load();">Update Customer Address
                                <i class="fa fa-edit"></i>
                            </button>
                        <?php endif; ?>

                        <!-- <button type="reset" class="btn btn-warning">Reset <i class="fa fa-undo"></i></button> -->

                        <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('grid'); ?>">Cancel <i class="fa fa-times"></i></a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>