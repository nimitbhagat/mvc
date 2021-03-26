<?php
$categories = $this->getCategories();
?>
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown">
                                <a href="<?php echo $this->getUrl()->getUrl('index', 'home\home'); ?>">Home</a>
                            </li>
                            <?php foreach ($categories->getData() as $key => $parentCategory) : ?>
                                <?php if (!$parentCategory->parentId) : ?>
                                    <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parentCategory->name; ?></a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content">
                                                    <div class="row">
                                                        <?php foreach ($categories->getData() as $key => $subCategory) : ?>
                                                            <?php if ($subCategory->parentId == $parentCategory->categoryId) : ?>
                                                                <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                    <h2 class="title"><?php echo $subCategory->name; ?></h2>
                                                                    <ul class="links">
                                                                        <li><a href="#">Dresses</a></li>
                                                                        <li><a href="#">Shoes </a></li>
                                                                        <li><a href="#">Jackets</a></li>
                                                                        <li><a href="#">Sunglasses</a></li>
                                                                        <li><a href="#">Sport Wear</a></li>
                                                                        <li><a href="#">Blazers</a></li>
                                                                        <li><a href="#">Shirts</a></li>
                                                                    </ul>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <li class="dropdown  navbar-right special-menu">
                                <a href="#">Get 30% off on selected items</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>