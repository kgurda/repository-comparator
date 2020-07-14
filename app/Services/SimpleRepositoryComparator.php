<?php

namespace App\Services;

class SimpleRepositoryComparator implements RepositoryComparatorInterface
{


    public function __construct()
    {

    }

    public function compare($firstRepositoryDetails, $secondRepositoryDetails)
    {
        return json_encode($firstRepositoryDetails);
    }
}