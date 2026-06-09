<?php

namespace lmd\Controller;
use lmd\Model\BookingModel;

class BookingController
{
    public function __construct()
    {
    }
    public function showBikesForBooking(){
        echo json_encode((new BookingModel())->showBikesForBooking(),JSON_PRETTY_PRINT);
    }

}