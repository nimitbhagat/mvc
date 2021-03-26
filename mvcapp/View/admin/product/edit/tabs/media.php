<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('check', 'admin\media'); ?>" method="post">
                <?php if ($this->getRequest()->getGet('id')) { ?>
                    <fieldset>
                        <legend>
                            <p class="h2 text-center">Add/Update Product Media Details</p><br>
                        </legend>
                        <div class="text-right">
                            <button class="btn btn-info" type="submit" name="update">Update <i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger" type="submit" name="delete">Delete <i class="fa fa-trash"></i></button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Label</th>
                                        <th>Small</th>
                                        <th>Thumb</th>
                                        <th>Base</th>
                                        <th>Gallery</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = $this->getRequest()->getGet('id');
                                    $imageData = $this->getMedia($id);
                                    if (!$imageData) { ?>
                                        <tr>
                                            <td colspan="7">No Images Found</td>
                                        </tr>
                                        <?php } else { {
                                            //print_r($imageData->getData());
                                            foreach ($imageData->getData() as $key => $value) {
                                        ?>
                                                <tr id="txtData">
                                                    <td><img src="./Media/images/Products/<?php echo "{$id}/" . $value->imageName; ?>" alt="" height="100px" width="100px"></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="image[<?php echo $value->mediaId; ?>][label]" placeholder="Label" id="inputDefault" value="<?php echo $value->label; ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="small[<?php echo $value->mediaId; ?>]" value="<?php echo $value->mediaId; ?>" class="custom-control-input" name="image[small]" <?php echo $value->small ? "checked" : "" ?>>
                                                            <label class="custom-control-label" for="small[<?php echo $value->mediaId; ?>]"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="thumb[<?php echo $value->mediaId; ?>]" value="<?php echo $value->mediaId; ?>" class="custom-control-input" name="image[thumb]" <?php echo $value->thumb ? "checked" : "" ?>>
                                                            <label class="custom-control-label" for="thumb[<?php echo $value->mediaId; ?>]"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="base[<?php echo $value->mediaId; ?>]" value="<?php echo $value->mediaId; ?>" class="custom-control-input" name="image[base]" <?php echo $value->base ? "checked" : "" ?>>
                                                            <label class="custom-control-label" for="base[<?php echo $value->mediaId; ?>]"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="galary[<?php echo $value->mediaId; ?>]" name="image[<?php echo $value->mediaId; ?>][gallery]" <?php echo $value->gallery ? "checked" : "" ?>>
                                                            <label class="custom-control-label" for="galary[<?php echo $value->mediaId; ?>]"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="remove[<?php echo $value->mediaId; ?>]" name="image[<?php echo $value->mediaId; ?>][remove]">
                                                            <label class="custom-control-label" for="remove[<?php echo $value->mediaId; ?>]"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>
                        <legend>
                            <p class="h2 text-center">Product Id Not found</p><br>
                        </legend>
                    <?php } ?>
            </form>

            <form method="post" action="<?php echo $this->getUrl()->getUrl('save', 'admin\media'); ?>" enctype="multipart/form-data">
                <div class="row">

                    <div class="form-group col-md-10">
                        <input type="file" class="form-control-file" id="uploadMedia" name="image">
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit" name="add">UPLOAD <i class="fa fa-upload"></i></button>
                    </div>
                </div>
            </form>
            </fieldset>
        </div>
    </div>
</div>