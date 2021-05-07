<?php

namespace Block\Admin\ConfigurationGroup\Edit\Tabs;

use Mage;

class Configuration extends \Block\Core\Edit
{
    protected $configurations = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configuration_group/edit/tabs/configuration.php");
    }

    public function setConfiguration($configurations = null)
    {
        if (!$configurations) {
            $configurations = Mage::getModel("Model\ConfigurationGroup\Configuration");
            if ($id = $this->getRequest()->getGet('id')) {
                $query = "SELECT * FROM config WHERE groupId='{$id}'";
                $configurations = $configurations->fetchAll($query);

                if (!$configurations) {
                    return null;
                }
            }
        }
        $this->configurations = $configurations;
        return $this;
    }

    public function getConfiguration()
    {
        if (!$this->configurations) {
            $this->setConfiguration();
        }
        return $this->configurations;
    }
}
