<?php

namespace lmd\Controller;

use lmd\Model\BikeModel;

class BikeController
{
    public function __construct()
    {
    }

    public function updateBike($id, $data)
    {
        echo json_encode((new BikeModel())->updateBike($id, $data), JSON_PRETTY_PRINT);
    }

    public function writeBike($data)

    {
        echo json_encode((new BikeModel())->writeBike($data), JSON_PRETTY_PRINT);
    }
}
