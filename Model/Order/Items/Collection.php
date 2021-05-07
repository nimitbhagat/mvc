<?php

namespace Model\Order\Items;

use Model\Core\Table\Collection as CoreTableCollection;
use Mage;

Mage::loadClassByFileName('Model\Core\Table\Collection');

class Collection extends \Model\Core\Table\Collection
{
    public function __construct()
    {
        parent::__construct();
    }
}
