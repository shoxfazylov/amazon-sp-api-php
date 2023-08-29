<?php

namespace App;

use ClouSale\AmazonSellingPartnerAPI\Api\FbaOutboundApi;
use ClouSale\AmazonSellingPartnerAPI\Configuration;
use ClouSale\AmazonSellingPartnerAPI\Models\FulfillmentOutbound\CreateFulfillmentOrderRequest;

class ShippingService implements ShippingServiceInterface
{

    protected $order_id;
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setAccessToken('Atza|IwEBxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'); //access token of Selling Partner
        $config->setApiKey("accessKey", 'AKIA2xxxxxxxxxxxxx'); // Access Key of IAM
        $config->setApiKey("secretKey", '94U4Gi81Tpxxxxxxxxxxxxxxx'); // Secret Key of IAM
        $config->setApiKey("region", 'us-east-1'); //region of MarketPlace country
        $this->apiInstance = new FbaOutboundApi($config);
    }

    public function createOrder(array $data = null)
    {
        $body = new CreateFulfillmentOrderRequest($data);

        try {
            $result = $this->apiInstance->createFulfillmentOrder($body);
            $this->order_id = $body['seller_fulfillment_order_id']; // TODO: could not check what comes in response
            print_r($result);
        } catch (\Exception $e) {
            echo 'Exception when calling FbaOutboundApi->createFulfillmentOrder: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function ship()
    {
        try {
            $orderDetail = $this->apiInstance->getFulfillmentOrder($this->order_id);
            try {
                return $this->getTracking($orderDetail);
            } catch (\Exception $e) {
                echo 'Exception when calling FbaOutboundApi->getPackageTrackingDetails: ', $e->getMessage(), PHP_EOL;
            }
        } catch (\Exception $e) {
            echo 'Exception when calling FbaOutboundApi->getFulfillmentOrder: ', $e->getMessage(), PHP_EOL;
        }
        // TODO: Implement getTrackingDetails() method.
    }

    private function getTracking(array $orderDetail = []): array
    {
        $trackings = [];

        foreach ($orderDetail['fulfillment_shipment']['fulfillment_shipment_package'] as $package) {
            $trackings[] = $this->apiInstance->getPackageTrackingDetails($package['package_number']);
        }
        return $trackings;
    }
}