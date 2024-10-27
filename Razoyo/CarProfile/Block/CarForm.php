<?php

namespace Razoyo\CarProfile\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Customer\Model\Session;

class CarForm extends Template
{
    protected $curl;
    protected $request;
    public function __construct(Template\Context $context, Curl $curl, array $data = [])
    {
        $this->curl = $curl;
        $this->request = $context->getRequest();
        parent::__construct($context, $data);
    }

    public function getCars()
    {
        $search = $this->request->getParam('search');

        $headers = [
            'Accept' => 'application/json',
        ];
        $this->curl->setHeaders($headers);

        if(isset($search) && !empty($search)) {
            $search = strtolower($search);
            $this->curl->get('https://exam.razoyo.com/api/cars?make='.ucfirst($search));
        } else {
            $this->curl->get('https://exam.razoyo.com/api/cars');
        }

        $response = $this->curl->getBody();

        return json_decode($response, true);
    }

    public function getFormAction()
    {
        return $this->getUrl('carprofile/index/save');
    }
}
