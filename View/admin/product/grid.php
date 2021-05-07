<form action="<?php echo $this->getUrl()->getUrl('filter'); ?>" method="POST" id="filterData">
    <?php $pager = $this->pagination()->getPager(); ?>
    <div class="page-header" id="banner">
        <div class="row">
            <!-- <?php foreach ($this->getButtons() as $key => $button) : ?> -->
            <div class="col-lg-8 col-md-7 col-sm-6">
                <a onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form', 'admin\product', null, true); ?>').setMethod('post').load();" href="javascript:void(0);" class="btn btn-primary" name="update">Add Product
                    <i class="<?php echo $button['icon']; ?>"></i>
                </a>
            </div>
            <!-- <?php endforeach; ?> -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card text-white  mb-12">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $this->getTitle(); ?></h4>
                    <table class="table table-hover table-striped ">
                        <thead>
                            <tr>
                                <?php foreach ($this->getColumns() as $key => $column) : ?>
                                    <th><?php echo $column['label']; ?></th>
                                <?php endforeach; ?>
                                <th colspan="3">Action</th>

                            </tr>
                            <tr>
                                <?php foreach ($this->getColumns() as $filterColumn) : ?>
                                    <td>
                                        <div>
                                            <input type="text" class="form-control" id="<?php echo $filterColumn['field']; ?>" name="filter[<?php echo $filterColumn['type']; ?>][<?php echo $filterColumn['field']; ?>]" value="<?php echo $this->getFilter()->getFilterValue($filterColumn['type'], $filterColumn['field']); ?>">
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                                <td colspan="3">
                                    <button type="button" class="btn btn-primary" onclick="mage.resetParams().setForm('#filterData').load();">Filter</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = $this->getPaginationProducts();
                            //$data = $this->getProducts();
                            ?>
                            <?php if ($data == "") : ?>
                                <tr>
                                    <td colspan="<?php echo count($this->getColumns()) ?>">
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
                                                <a href="javascript:void(0)" onclick="mage.setUrl('<?php echo $this->getMethodUrl($value, $action['method']); ?>').load()">
                                                    <i class="<?php echo $action['class']; ?>"></i>
                                                </a>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <ul class="pagination pagination-lg">

                    <li class="page-item  <?php echo (!$pager->getPrevious()) ? 'disabled' : ''; ?>">
                        <a class="page-link" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getPrevious()], true); ?>').load();" href="javascript:void(0);">Previous</a>
                    </li>

                    <?php foreach (range($pager->getStart(), $pager->getNoOfPages()) as $value) : ?>
                        <li class="page-item <?php echo ($this->getRequest()->getGet('page') == $value) ? 'active' : ''; ?>">
                            <a class="page-link " onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['page' => $value], true); ?>').load();" href="javascript:void(0);"><?php echo $value; ?></a>
                        </li>
                    <?php endforeach; ?>

                    <li class="page-item <?php echo (!$pager->getNext()) ? 'disabled' : ''; ?>">
                        <a class="page-link" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getNext()], true); ?>').load();" href="javascript:void(0);">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</form>