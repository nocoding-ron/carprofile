<?php

namespace Razoyo\CarProfile\Model\ResourceModel\Car;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Razoyo\CarProfile\Model\Car as Model;
use Razoyo\CarProfile\Model\ResourceModel\Car as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'razoyo_carprofile_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
