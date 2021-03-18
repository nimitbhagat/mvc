<div class="page-header" id="banner">
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-6">
            <a href="<?php echo $this->getUrl()->getUrl('form'); ?>" class="btn btn-primary" name="update">Add Category
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
                            <th>Category Name</th>
                            <th>Parent Id</th>
                            <th>Path Id</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = $this->getCategories();
                        if ($data == "") :
                        ?>
                            <tr>
                                <td colspan="9">
                                    <strong>
                                        <?php echo 'No Records Found'; ?>
                                    </strong>
                                </td>
                            </tr>
                            <?php
                        else :
                            foreach ($data->getData() as $key => $value) : ?>
                                <tr id="txtData" class="<?php echo ($value->status == 1) ? "" : "table-danger"; ?>">
                                    <td>
                                        <?php echo $this->getName($value); ?>
                                    </td>
                                    <td><?php echo $value->parentId; ?></td>
                                    <td><?php echo $value->pathId ?></td>
                                    <td><?php
                                        if ($value->status) {
                                            echo 'Enabled';
                                        } else {
                                            echo 'Disabled';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value->description ?></td>

                                    <th>
                                        <a href="<?php echo $this->getUrl()->getUrl('changeStatus', NULL, ['id' => $value->categoryId, 'status' => $value->status], true); ?>">
                                            <i class="fa btn <?php echo ($value->status == 1) ? "fa-toggle-on btn-success" : "fa-toggle-off btn-outline-success"; ?>"></i>
                                        </a>
                                    </th>
                                    <th><a href="<?php echo $this->getUrl()->getUrl('edit', NULL, ['id' => $value->categoryId]); ?>"><i class="fa fa-pencil btn-info btn"></i></a></th>
                                    <th><a href="<?php echo $this->getUrl()->getUrl('delete', NULL, ['id' => $value->categoryId]); ?>"><i class="fa fa-trash btn-danger btn"></i></a></th>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>