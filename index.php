<?php

require_once './vendor/autoload.php';

$appInstance = new \App\ShippingService();
$appInstance->createOrder([
    'marketplace_id' => null,
    'seller_fulfillment_order_id' => null,
    'displayable_order_id' => null,
    'displayable_order_date' => null,
    'displayable_order_comment' => null,
    'shipping_speed_category' => null,
    'delivery_window' => null,
    'destination_address' => null,
    'fulfillment_action' => null,
    'fulfillment_policy' => null,
    'cod_settings' => null,
    'ship_from_country_code' => null,
    'notification_emails' => null,
    'feature_constraints' => null,
    'items' => null,
]);

print_r($appInstance->ship());