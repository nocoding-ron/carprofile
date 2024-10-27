<?php
namespace Razoyo\CarProfile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Razoyo\CarProfile\Model\CarFactory;
use Magento\Framework\HTTP\Client\Curl;

class Save extends Action
{
    protected $customerSession;
    protected $carFactory;
    protected $curl;

    public function __construct(
        Context $context,
        Session $customerSession,
        CarFactory $carFactory,
        Curl $curl,
    ){
        $this->customerSession = $customerSession;
        $this->carFactory = $carFactory;
        $this->curl = $curl;
        parent::__construct($context);
    }

    public function execute()
    {
        $carId = $this->getRequest()->getPost('car_selection');
        if(!empty($carId)){
            $customerId = $this->customerSession->getCustomerId();

            $carDetails = $this->getCarDetails($carId);

            $car = $this->carFactory->create();
            $car->load($customerId, 'customer_id');
            $car->setCustomerId($customerId);
            $car->setCarId($carId);

            $car->setYear($carDetails['year']);
            $car->setMake($carDetails['make']);
            $car->setModel($carDetails['model']);
            $car->setPrice($carDetails['price']);
            $car->setSeats($carDetails['seats']);
            $car->setMpg($carDetails['mpg']);
            $car->setImage($carDetails['image']);

            $car->save();

            $this->_redirect('carprofile/profile/index');
        }

        return;

    }

    public function getCarDetails($carId){

        $token = $this->getToken();

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ];
        $this->curl->setHeaders($headers);

        if(!empty($carId)) {
            $this->curl->get('https://exam.razoyo.com/api/cars/'.$carId);
        } else {
            return false;
        }
        $response = $this->curl->getBody();

        $carDetails = json_decode($response, true);
        return $carDetails['car'];
    }

    public function getToken()
    {
        $headers = [
            'Accept' => 'application/json',
        ];
        $this->curl->setHeaders($headers);
        $this->curl->get('https://exam.razoyo.com/api/cars');
        $response = $this->curl->getHeaders();

        return $response['your-token'];
    }
}
