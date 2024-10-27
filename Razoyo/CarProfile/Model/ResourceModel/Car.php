<?php

namespace Razoyo\CarProfile\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Car extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'razoyo_carprofile_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('razoyo_carprofile', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
