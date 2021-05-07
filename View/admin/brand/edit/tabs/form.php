<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="form" enctype="multipart/form-data">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) : ?>
                            <p class="h2 text-center">Update Brand Details</p><br>
                        <?php else : ?>
                            <p class="h2 text-center">Add Brands Details</p><br>
                        <?php endif; ?>
                    </legend>


                    <?php $brand = $this->getBrand(); ?>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">NAME</label>
                            <input id="name" name="brand[name]" value="<?php echo $brand->name ?>" type="text" placeholder="BRAND NAME" class="validate form-control" require>
                        </div>

                        <?php
                        if (!$brand->image) :
                            $brand->image = "placeholder.png";
                        else :
                            $id = $this->getRequest()->getGet('id');
                            $brand->image = "{$id}/{$brand->image}";
                        endif;
                        ?>

                        <div class="form-group col-md-2">
                            <img src="./Media/images/Brand/<?php echo "{$brand->image}"; ?>" alt="" height="100px" width="100px">
                        </div>

                        <div class="form-group col-md-10">
                            <label for="image">UPLOAD BRAND IMAGE</label>
                            <input id="image" name="image" value="<?php echo $brand->image ?>" type="file" placeholder="BRAND IMAGE" class="validate form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <?php if ($brand->status) {
                                $label = 'checked';
                                $value = '1';
                            } else {
                                $label = '';
                                $value = '0';
                            }
                            ?>
                            <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='brand[status]'>
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                    </div>


                    <?php if (!$this->getRequest()->getGet('id')) { ?>
                        <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').uploadFile().load();">Add Brand
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').uploadFile().load();">Update Brand
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