<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CYBERCOM CREATION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Skin/admin/solar/bootstrap.css">
    <link rel="stylesheet" href="./Skin/admin/_assets/css/custom.min.css">
    <link rel="stylesheet" href="./Skin/admin/_vendor/font-awesome/css/font-awesome.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">CYBERCOM CREATION</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <?php echo  $this->getChild("Header")->toHtml(); ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <?php echo $this->getChild('Sidebar')->toHtml(); ?>
            </div>
            <div class="col-lg-10">
                <?php echo $this->createBlock('Block\Core\Layout\Message')->toHtml(); ?>
                <?php echo  $this->getChild("Content")->toHtml(); ?>
            </div>
        </div>
        <?php echo  $this->getChild("Footer")->toHtml(); ?>

        <script src="./View/admin/js/jquery-3.6.0.js"></script>
        <script src="./View/admin/js/mage.js"></script>
        <script src="./Skin/admin/_vendor/jquery/dist/jquery.min.js"></script>
        <script src="./Skin/admin/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./Skin/admin/_assets/js/custom.js"></script>
</body>

</html>