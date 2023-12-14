<?php

namespace PNjuguna\Reviews\ReviewsServiceProvider\src;

class Reviews
{
    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = "https://mybusiness.googleapis.com/v4/accounts/{accountId}/locations/{locationId}/reviews";
    }

}
