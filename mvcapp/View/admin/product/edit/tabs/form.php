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


                    <?php $product = $this->getProduct(); ?>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="sku">SKU</label>
                            <input id="sku" name="product[SKU]" value="<?php echo $product->sku ?>" type="text" placeholder="SKU" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="productname">NAME</label>
                            <input id="productname" name="product[name]" value="<?php echo $product->name ?>" type="text" placeholder="PRODUCT NAME" class="validate form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="price">PRICE</label>
                            <input id="price" name="product[price]" value="<?php echo $product->price ?>" type="text" placeholder="PRODUCT PRICE" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="discount">DISCOUNT</label>
                            <input id="discount" name="product[discount]" value="<?php echo $product->discount ?>" type="text" placeholder="PRODUCT DISCOUNT" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="quantity">QUANTITY</label>
                            <input id="quantity" name="product[quantity]" value="<?php echo $product->quantity ?>" type="text" placeholder="PRODUCT QUANTITY" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description">DESCRIPTION</label>
                            <textarea name="product[description]" class="form-control" id="description" rows="3" placeholder="PRODUCT DESCRIPTION"><?php echo $product->description ?></textarea>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?php if ($product->status) {
                                $label = 'checked';
                                $value = '1';
                            } else {
                                $label = '';
                                $value = '0';
                            }
                            ?>
                            <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='product[status]'>
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
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