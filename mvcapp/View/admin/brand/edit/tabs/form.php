<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" enctype="multipart/form-data">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Brand Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Brands Details</p><br>
                        <?php } ?>
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

                        <button class="btn btn-primary" type="submit" name="add">Add Brand
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="submit" name="edit">Update Brand
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

    <?php $brand = $this->getBrand(); ?>
    <div class="container">
        <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
                <h4 class="card-title">
                    <?php if ($this->getController()->getRequest()->getGet('id')) : ?>
                        <p class="h2 text-center">Update Brand Details</p><br>
                    <?php else : ?>
                        <p class="h2 text-center">Add Brand Details</p><br>
                    <?php endif; ?>
                </h4>
                <p class="card-text">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="brandname" name="brand[name]" value="<?php echo $brand->name ?>" type="text" class="validate">
                                <label for="brandname">Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="brandname" name="brand[code]" value="<?php echo $brand->code ?>" type="text" class="validate">
                                <label for="brandname">Code</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="desc" name="brand[description]" class="materialize-textarea"><?php echo $brand->description ?></textarea>
                                <label for="desc">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="brandname" name="brand[amount]" value="<?php echo $brand->amount ?>" type="text" class="validate">
                                <label for="brandname">Amount</label>
                            </div>
                            <div class="input-field col s6">
                                <div class="switch">
                                    <label>
                                        Disabled
                                        <?php if ($brand->status) {
                                            $label = 'checked';
                                        } else {
                                            $label = '!checked';
                                        }
                                        ?>
                                        <input name='brand[status]' type='checkbox' <?php echo $label; ?>>
                                        <span class="lever"></span>
                                        Enabled
                                    </label>
                                </div>
                            </div>
                        </div>

                        <?php if (!$this->getController()->getRequest()->getGet('id')) : ?>
                            <button class="btn waves-effect waves-light" type="submit" name="add">Add Brand
                                <i class="material-icons right">add</i>
                            </button>
                        <?php else : ?>
                            <button class="btn waves-effect waves-light" type="submit" name="add">Update Brand
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