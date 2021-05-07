<?php

namespace Block\Core\Layout;

use Mage;


class Footer extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/footer.php");
    }
}
