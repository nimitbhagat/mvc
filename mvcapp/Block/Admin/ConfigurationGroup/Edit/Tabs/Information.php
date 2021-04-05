<?php

namespace Block\Admin\ConfigurationGroup\Edit\Tabs;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName("Block\Core\Template");
class Information extends Template
{
    protected $configurationGroup = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configuration_group/edit/tabs/information.php");
    }

    public function setConfigurationGroup($configurationGroup = null)
    {
        if (!$configurationGroup) {
            $configurationGroup = Mage::getModel("Model\ConfigurationGroup");
            if ($id = $this->getRequest()->getGet('id')) {
                $configurationGroup = $configurationGroup->load($id);

                if (!$configurationGroup) {
                    return null;
                }
            }
        }
        $this->configurationGroup = $configurationGroup;


        return $this;
    }

    public function getConfigurationGroup()
    {
        if (!$this->configurationGroup) {
            $this->setConfigurationGroup();
        }

        return $this->configurationGroup;
    }
}
