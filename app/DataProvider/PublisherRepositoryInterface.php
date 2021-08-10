<?php

namespace App\DataProvider;

use App\DataProvider\Eloquent\Publisher;

interface PublisherRepositoryInterface
{
    public function findByName(string $name): ?Publisher;

    public function store(\App\Domain\Entity\Publisher $publisher): int;
}
