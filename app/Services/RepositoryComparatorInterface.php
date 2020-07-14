<?php

namespace App\Services;

interface RepositoryComparatorInterface
{
    public function compare($firstRepositoryDetails, $secondRepositoryDetails);
}