<?php
namespace App;

interface ShippingServiceInterface
{
    public function createOrder();
    public function ship();
}