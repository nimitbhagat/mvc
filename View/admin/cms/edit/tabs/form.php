<head>
    <script src="https://cdn.tiny.cloud/1/krxtmava3rbfbh6xktd048nd8i41usepo5kmtnbrksyew15w/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="form">
                <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update CMS Page Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add CMS Page Details</p><br>
                        <?php } ?>
                    </legend>

                    <?php $cms = $this->getCms(); ?>


                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="title">TITLE</label>
                            <input id="title" name="cms[title]" value="<?php echo $cms->title ?>" type="text" placeholder="TITLE" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="identifier ">IDENTIFIER</label>
                            <input id="identifier " name="cms[identifier]" value="<?php echo $cms->identifier ?>" type="text" placeholder="IDENTIFIER" class="validate form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="status ">STATUS</label>

                            <div class="custom-control custom-switch">
                                <?php if ($cms->status) {
                                    $label = 'checked';
                                    $value = '1';
                                } else {
                                    $label = '';
                                    $value = '0';
                                }
                                ?>
                                <input type="checkbox" class="custom-control-input" id="status" <?php echo $label; ?> name='cms[status]'>
                                <label class="custom-control-label" for="status"></label>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="content"></label>
                            <textarea id="content" name="cms[content]" class="form-control"><?php echo $cms->content; ?></textarea>
                        </div>

                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) : ?>
                        <button class="btn btn-primary" type="button" name="add" onclick="mage.resetParams().setForm('#form').load();">Add CMS Page
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php else : ?>
                        <button class="btn btn-primary" type="button" name="edit" onclick="mage.resetParams().setForm('#form').load();">Update CMS Page
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php endif; ?>

                    <button type="reset" class="btn btn-warning">Reset <i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" href="javascript:void(0)">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>



<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Nimit Bhagat'
    });
</script>