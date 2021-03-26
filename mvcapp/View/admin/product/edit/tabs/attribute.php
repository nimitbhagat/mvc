<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Product Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Product Details</p><br>
                        <?php } ?>
                    </legend>




                    <?php $attribute = $this->getAttributes(); ?>
                    <?php $product = $this->getProduct(); ?>

                    <div class="row">
                        <?php foreach ($attribute->getData() as $value) : ?>
                            <?php if ($value->inputType == 'select' || $value->inputType == 'multiple') : ?>

                                <?php $option = $this->getOptions($value->attributeId); ?>

                                <?php if ($option) : ?>
                                    <div class="form-group col-md-6">
                                        <label for="<?php echo $value->name; ?>"><?php echo $value->name; ?></label>
                                        <select name="product[<?php echo $value->name; ?>]<?php echo ($value->inputType == 'multiple') ? "[]" : ""; ?>" id="<?php echo $value->name; ?>" class="validate form-control" <?php echo $value->inputType; ?>>
                                            <option value="0" disabled selected>Select <?php echo $value->name; ?></option>
                                            <?php foreach ($option->getData() as $option) : ?>
                                                <option value="<?php echo $option->name; ?>"><?php echo $option->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                <?php endif; ?>

                            <?php elseif ($value->inputType == 'radio' || $value->inputType == 'checkbox') : ?>
                                <?php $option = $this->getOptions($value->attributeId); ?>
                                <div class="form-group col-md-6">
                                    <b><label for="<?php echo $value->name; ?>"><?php echo $value->name; ?></label></b>:<br>
                                    <?php foreach ($option->getData() as $key => $option) : ?>
                                        <?php echo $option->name; ?>&nbsp;&nbsp;&nbsp;<input type="<?php echo $value->inputType; ?>" id="<?php echo $value->name; ?>" value="<?php echo $option->name; ?>" name="product[<?php echo $value->name; ?>]<?php echo ($value->inputType == 'checkbox') ? "[]" : ""; ?>" class="validate" require>&nbsp;&nbsp;&nbsp;
                                    <?php endforeach; ?>
                                </div>

                            <?php elseif ($value->inputType == 'text') : ?>
                                <?php $option = $this->getOptions($value->attributeId); ?>
                                <div class="form-group col-md-6">
                                    <label for="<?php echo $value->name; ?>"><?php echo $value->name; ?></label>
                                    <input type="<?php echo $value->inputType; ?>" id="<?php echo $value->name; ?>" name="product[<?php echo $value->name; ?>]" class="validate form-control" require>
                                </div>

                            <?php elseif ($value->inputType == 'textarea') : ?>
                                <?php $option = $this->getOptions($value->attributeId); ?>
                                <div class="form-group col-md-6">
                                    <label for="<?php echo $value->name; ?>"><?php echo $value->name; ?></label>
                                    <textarea name="product[<?php echo $value->name; ?>]" id="<?php echo $value->name; ?>" cols="30" rows="10" class="validate form-control"></textarea>
                                    <input id="" name="" class="validate" require>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="submit" name="add">Add Product
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="submit" name="edit">Update Product
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