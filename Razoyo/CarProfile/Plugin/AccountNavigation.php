<?php

namespace Razoyo\CarProfile\Plugin;

use Magento\Customer\Block\Account\Navigation;
use Razoyo\CarProfile\Model\ResourceModel\Car\CollectionFactory;
use Magento\Customer\Model\SessionFactory;

class AccountNavigation
{
    protected $carCollectionFactory;
    protected $customerSession;

    public function __construct(
        CollectionFactory $carCollectionFactory,
        SessionFactory $customerSession,
    ){
        $this->carCollectionFactory = $carCollectionFactory;
        $this->customerSession = $customerSession;
    }

    public function afterGetLinks(Navigation $subject, $result)
    {
        $customerSession = $this->customerSession->create();
        $customerId = $customerSession->getCustomerId();
      
        $carCollection = $this->carCollectionFactory->create();
        $carCollection->addFieldToFilter('customer_id', $customerId);

        $carCollectionSize = $carCollection->getSize();

        foreach($result as $navItem){
            if ( $navItem->getLabel() == "My Car" && $carCollectionSize > 0) {
                $navItem->setLabel('My Car Profile');
                $navItem->setPath('carprofile/profile/index');
            }
        }
         
        return $result;
    }
}