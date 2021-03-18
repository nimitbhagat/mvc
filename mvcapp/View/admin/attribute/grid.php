<div class="page-header" id="banner">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <a href="<?php echo $this->getUrl()->getUrl('form'); ?>" class="btn btn-primary" name="update">Add Attribute
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card text-white bg-dark mb-12">
            <div class="card-body">
                <h4 class="card-title"><?php echo $this->getTitle(); ?></h4>
                <table class="table table-hover table-striped table-dark">
                    <thead>
                        <tr>
                            <th>Attribute Id</th>
                            <th>Entity Type ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Input Type</th>
                            <th>Backend Type</th>
                            <th>Sort Order</th>
                            <th>Backend Model</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = $this->getAttributes();
                        if ($data == "") {
                        ?>
                            <tr>
                                <td colspan="9">
                                    <strong>
                                        <?php echo 'No Records Found'; ?>
                                    </strong>
                                </td>
                            </tr>
                            <?php

                        } else {
                            foreach ($data->getData() as $key => $value) {

                            ?>
                                <tr id="txtData">
                                    <td><?php echo $value->attributeId; ?></td>
                                    <td><?php echo $value->entityTypeId; ?></td>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->code ?></td>
                                    <td><?php echo $value->inputType ?></td>
                                    <td><?php echo $value->backendType ?></td>
                                    <td><?php echo $value->sortOrder ?></td>
                                    <td><?php echo $value->backendModel ?></td>

                                    <th><a href="<?php echo $this->getUrl()->getUrl('form', NULL, ['id' => $value->attributeId]); ?>"><i class="fa fa-pencil btn-info btn"></i></a></th>
                                    <th><a href="<?php echo $this->getUrl()->getUrl('delete', NULL, ['id' => $value->attributeId]); ?>"><i class="fa fa-trash btn-danger btn"></i></a></th>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>