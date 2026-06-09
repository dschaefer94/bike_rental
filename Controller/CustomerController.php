<?php

namespace lmd\Controller;

use lmd\Model\CustomerModel;

class CustomerController
{
    public function __construct()
    {
    }

    public function deleteCustomer($id)
    {
        echo json_encode((new CustomerModel())->deleteCustomer($id), JSON_PRETTY_PRINT);
    }

}
