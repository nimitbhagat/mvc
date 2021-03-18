<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save', 'Product\PriceGroup'); ?>" method="post">

                <fieldset>
                    <legend>
                        <p class="h2 text-center">Add/Update Product Media Details</p><br>
                    </legend>
                    <div class="text-right">
                        <button class="btn btn-info m-1" type="submit" name="update">Update <i class="fa fa-pencil"></i></button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>Group ID</th>
                                    <th>Group Name</th>
                                    <th>Price</th>
                                    <th>Group Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($this->getRequest()->getGet('id')) : ?>
                                    <?php
                                    $id = $this->getRequest()->getGet('id');
                                    $gropuPrice = $this->getPriceGroup($id);

                                    ?>

                                    <?php if (!$gropuPrice) : ?>
                                        <tr>
                                            <td colspan="7">No Images Found</td>
                                        </tr>
                                        <?php else :

                                        foreach ($gropuPrice->getData() as $key => $value) : ?>
                                            <?php $type = ($value->entityId) ? "exist" : "new"; ?>
                                            <?php echo $value->entityId; ?>
                                            <tr id="txtData">
                                                <td><?php echo $value->groupId; ?></td>
                                                <td><?php echo $value->name; ?></td>
                                                <td><?php echo $value->price; ?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="priceGroup[<?php echo $type; ?>][<?php echo $value->groupId; ?>]" placeholder="Price For <?php echo $value->name; ?>" id="inputDefault" value="<?php echo $value->groupPrice; ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) : ?>
                        <legend>
                            <p class="h2 text-center">Product Id Not found</p><br>
                        </legend>
                    <?php endif; ?>
            </form>
            </fieldset>
        </div>
    </div>
</div>