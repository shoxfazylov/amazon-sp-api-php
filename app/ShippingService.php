<?php
namespace App;

use ClouSale\AmazonSellingPartnerAPI\Api\FbaOutboundApi;
use ClouSale\AmazonSellingPartnerAPI\Configuration;
use ClouSale\AmazonSellingPartnerAPI\Models\FulfillmentOutbound\CreateFulfillmentOrderRequest;

class ShippingService implements ShippingServiceInterface
{

    protected $config;
    protected $order;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
        $config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
        $config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
        $config->setApiKey("region", 'us-east-1'); //region of MarketPlace country
    }

    public function createOrder(array $data = null)
    {
        $apiInstance = new FbaOutboundApi($this->config);
        $body = new CreateFulfillmentOrderRequest($data);

        try {
            $result = $apiInstance->createFulfillmentOrder($body);
            $this->order = $result; // TODO: could not check what comes in response
            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling FbaOutboundApi->createFulfillmentOrder: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function ship()
    {
        $apiInstance = new FbaOutboundApi($this->config);
        try {
            $orderDetail = $apiInstance->getFulfillmentOrder($this->order['RequestId']);
            
        } catch (\Exception $e) {
            echo 'Exception when calling FbaOutboundApi->createFulfillmentOrder: ', $e->getMessage(), PHP_EOL;
        }
        // TODO: Implement getTrackingDetails() method.
    }
}