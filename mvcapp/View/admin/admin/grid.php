<?php $pager = $this->pagination()->getPager(); ?>
<div class="page-header" id="banner">
    <div class="row">
        <?php foreach ($this->getButtons() as $key => $button) : ?>
            <div class="col-lg-8 col-md-7 col-sm-6">
                <a href="<?php echo $this->getButtonUrl($button['method']) ?>" class="btn btn-primary" name="update">Add Admin
                    <i class="<?php echo $button['icon']; ?>"></i>
                </a>
            </div>
        <?php endforeach; ?>
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
                            <?php foreach ($this->getColumns() as $key => $column) : ?>
                                <th><?php echo $column['label']; ?></th>
                            <?php endforeach; ?>
                            <th colspan="3">Action</th>

                        </tr>
                        <tr>
                            <form action="<?php echo $this->getUrl()->getUrl('filter'); ?>" method="POST">
                                <?php foreach ($this->getColumns() as $filterColumn) : ?>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" id="<?php echo $filterColumn['field']; ?>" name="filter[<?php echo $filterColumn['type']; ?>][<?php echo $filterColumn['field']; ?>]" value="<?php echo $this->getFilter()->getFilterValue($filterColumn['type'], $filterColumn['field']); ?>">
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </td>
                            </form>
                        </tr>
                        <!-- <tr>
                            <th>Admin Name</th>
                            <th>Admin Username</th>
                            <th>Admin Status</th>
                            <th>Created Date</th>
                            <th colspan="3">Action</th>
                        </tr> -->
                    </thead>
                    <tbody>
                        <?php
                        $data = $this->getPaginationAdmin();
                        //$data = $this->getAdmin();
                        ?>

                        <?php if ($data == "") : ?>
                            <tr>
                                <td colspan="6">
                                    <strong>
                                        <?php echo 'No Records Found'; ?>
                                    </strong>
                                </td>
                            </tr>
                        <?php else : ?>


                            <?php foreach ($data->getData() as $value) : ?>
                                <tr class="<?php echo ($value->status == 1) ? "" : "table-danger"; ?>">
                                    <?php foreach ($this->getColumns() as $column) : ?>
                                        <th><?php echo $this->getFieldValue($value, $column['field']); ?></th>
                                    <?php endforeach; ?>
                                    <?php foreach ($this->getActions() as $action) : ?>
                                        <th>
                                            <a href="<?php echo $this->getMethodUrl($value, $action['method']); ?>">
                                                <i class="<?php echo $action['class']; ?>"></i>
                                            </a>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>

                                <?php /*<tr id="txtData" class="<?php echo ($value->status == 1) ? "" : "table-danger"; ?>">
                                    <td><?php echo $value->name; ?></td>
                                    <td><?php echo $value->username; ?></td>
                                    <td><?php
                                        if ($value->status) {
                                            echo 'Enabled';
                                        } else {
                                            echo 'Disabled';
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $value->createdDate ?></td>
                                    <th>
                                        <a href="<?php echo $this->getUrl()->getUrl('changeStatus', NULL, ['id' => $value->adminId, 'status' => $value->status], true); ?>">
                                            <i class="fa btn <?php echo ($value->status == 1) ? "fa-toggle-on btn-success" : "fa-toggle-off btn-outline-success"; ?>"></i>
                                        </a>
                                    </th>
                                    <th><a href="<?php echo $this->getUrl()->getUrl('form', NULL, ['id' => $value->adminId]); ?>"><i class="fa fa-pencil btn-info btn"></i></a></th>
                                    <th><a href="<?php echo $this->getUrl()->getUrl('delete', NULL, ['id' => $value->adminId]); ?>"><i class="fa fa-trash btn-danger btn"></i></a></th>
                                </tr>*/ ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <ul class="pagination pagination-lg">

                <li class="page-item  <?php echo (!$pager->getPrevious()) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getPrevious()], true); ?>">Previous</a>
                </li>

                <?php foreach (range($pager->getStart(), $pager->getNoOfPages()) as $value) : ?>
                    <li class="page-item <?php echo ($this->getRequest()->getGet('page') == $value) ? 'active' : ''; ?>">
                        <a class="page-link " href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $value], true); ?>"><?php echo $value; ?></a>
                    </li>
                <?php endforeach; ?>

                <li class="page-item <?php echo (!$pager->getNext()) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getNext()], true); ?>">Next</a>
                </li>
            </ul>
        </div>
    </div>
</div>