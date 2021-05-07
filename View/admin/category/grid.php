<?php $pager = $this->pagination()->getPager(); ?>
<div class="page-header" id="banner">
    <div class="row">
        <!-- <?php foreach ($this->getButtons() as $key => $button) : ?> -->
        <div class="col-lg-8 col-md-7 col-sm-6">
            <a onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form', 'admin\category', null, true); ?>').setMethod('post').load();" href="javascript:void(0);" class="btn btn-primary" name="update">Add Category
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
                <table class="table table-hover table-striped">
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
                        $data = $this->getPaginationCategory();
                        //$data = $this->getCategories();
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
                                <tr>
                                    <th><?php echo $value->categoryId; ?></th>

                                    <th>
                                        <?php echo $this->getName($value); ?>
                                    </th>
                                    <th><?php echo $value->parentId; ?></th>
                                    <th><?php echo $value->pathId ?></th>
                                    <th><?php
                                        if ($value->status) {
                                            echo 'Enabled';
                                        } else {
                                            echo 'Disabled';
                                        }
                                        ?>
                                    </th>
                                    <th><?php echo $value->description ?></th>


                                    <th><a onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('form', null, ['id' => $value->categoryId]); ?>').load()" href="javascript:void(0);"><i class="fa fa-pencil btn-info btn"></i></a></th>
                                    <th><a onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete', null, ['id' => $value->categoryId]); ?>').load()" href="javascript:void(0);"><i class="fa fa-trash btn-danger btn"></i></a></th>
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