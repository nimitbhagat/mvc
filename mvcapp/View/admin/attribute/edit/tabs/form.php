<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post">

                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Attribute Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Attribute Details</p><br>
                        <?php } ?>
                    </legend>



                    <?php $attribute = $this->getAttribute(); ?>

                    <div class="row">

                        <?php $attribute = $this->getAttribute(); ?>
                        <div class="form-group col-md-12">
                            <label for="entityTypeId">INPUT TYPE</label>
                            <select id="entityTypeId" name="attribute[entityTypeId]" class="validate form-control" require>
                                <option value="0" selected disabled>Select Input Type</option>
                                <?php foreach ($attribute->getEntityType() as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($attribute->entityTypeId == $key) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">ATTRIBUTE NAME</label>
                            <input id="name" name="attribute[name]" value="<?php echo $attribute->name ?>" type="text" placeholder="ATRIBUTE NAME" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="code">CODE</label>
                            <input id="code" name="attribute[code]" value="<?php echo $attribute->code ?>" type="text" placeholder="ATTRIBUTE CODE" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputType">INPUT TYPE</label>
                            <select id="inputType" name="attribute[inputType]" class="validate form-control" require>
                                <option value="0" selected disabled>Select Input Type</option>
                                <?php foreach ($attribute->getInputTypeOption() as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($attribute->inputType == $key) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputType">BACKEND TYPE</label>
                            <select id="inputType" name="attribute[backendType]" class="validate form-control" require>
                                <option value="0" selected disabled>Select Backend Type</option>
                                <?php foreach ($attribute->getBackendTypeOption() as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($attribute->backendType == $key) ? "selected" : ""; ?>>
                                        <?php echo $value; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sortOrder">SORT ORDER</label>
                            <input id="sortOrder" name="attribute[sortOrder]" value="<?php echo $attribute->sortOrder ?>" type="number" placeholder="SORT ORDER" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="backendModel">BACKEND MODEL</label>
                            <input id="backendModel" name="attribute[backendModel]" value="<?php echo $attribute->backendModel ?>" type="text" placeholder="BACKEND MODEL" class="validate form-control" require>
                        </div>




                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="submit" name="add">Add Attribute
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="submit" name="edit">Update Attribute
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