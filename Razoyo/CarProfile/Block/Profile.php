<?php

namespace Razoyo\CarProfile\Block;


use Magento\Framework\View\Element\Template;
use Razoyo\CarProfile\Model\ResourceModel\Car\CollectionFactory;
use Magento\Customer\Model\SessionFactory;

class Profile extends Template
{
    protected $customerSession;
    protected $carCollectionFactory;
    public function __construct(
        Template\Context $context,
        SessionFactory $customerSession,
        CollectionFactory $carCollectionFactory,
        array $data = []
    ){
        $this->customerSession = $customerSession;
        $this->carCollectionFactory = $carCollectionFactory;

        parent::__construct($context, $data);
    }
    public function getCarProfile(){
        $customerSession = $this->customerSession->create();
        $customerId = $customerSession->getCustomerId();

        $carCollection = $this->carCollectionFactory->create();
        $carCollection->addFieldToFilter('customer_id', $customerId);

        return $carCollection->getFirstItem();
    }
}
