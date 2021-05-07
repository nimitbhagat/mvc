<?php

namespace Block\Admin;

class Layout extends \Block\Core\Layout
{
    public function __construct()
    {
        $this->setTemplate('./admin/layout.php');
        $this->prepareChildren();
    }
}
