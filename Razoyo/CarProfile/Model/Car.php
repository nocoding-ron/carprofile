<?php

namespace Razoyo\CarProfile\Model;

use Magento\Framework\Model\AbstractModel;
use Razoyo\CarProfile\Model\ResourceModel\Car as ResourceModel;

class Car extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'razoyo_carprofile_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
