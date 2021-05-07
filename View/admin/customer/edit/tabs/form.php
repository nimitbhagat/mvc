<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="form">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Customer Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Customer Details</p><br>
                        <?php } ?>
                    </legend>

                    <?php $customer = $this->getCustomer(); ?>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="firstName">FIRST NAME</label>
                            <input id="firstName" name="customer[firstName]" value="<?php echo $customer->firstName ?>" type="text" placeholder="FIRST NAME" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lastName">LAST NAME</label>
                            <input id="lastName" name="customer[lastName]" value="<?php echo $customer->lastName ?>" type="text" placeholder="LAST NAME" class="validate form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="price">EMAIL</label>
                            <input id="price" name="customer[email]" value="<?php echo $customer->email ?>" type="text" placeholder="EMAIL" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mobile">MOBILE NUMBER</label>
                            <input id="mobile" name="customer[mobile]" value="<?php echo $customer->mobile ?>" type="text" placeholder="MOBILE NUMBER" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password">PASSWORD</label>
                            <input id="password" name="customer[password]" value="<?php echo $customer->password ?>" type="text" placeholder="PASSWORD" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="groupId">GROUP</label>
                            <select class="form-control" id="groupId" name="customer[groupId]">
                                <option value="" disabled selected>Select Group</option>
                                <?php
                                $groupNames = $this->getGroupName();
                                foreach ($groupNames->getData() as $key => $value) :
                                ?>
                                    <option value="<?php echo $value->groupId ?>"><?php echo $value->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?php if ($customer->status) {
                                $label = 'checked';
                                $value = '1';
                            } else {
                                $label = '';
                                $value = '0';
                            }
                            ?>
                            <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='customer[status]'>
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                    </div>


                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').load();">Add Customer
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').load();">Update Customer
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