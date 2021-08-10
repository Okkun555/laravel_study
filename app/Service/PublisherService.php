<?php

namespace App\Service;

use App\DataProvider\Eloquent\Publisher;
use App\DataProvider\PublisherRepositoryInterface;

class PublisherService
{
    private $publisher;

    public function __construct(PublisherRepositoryInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    public function exists(string $name): bool
    {
        if ($this->publisher->findByName($name)) {
            return true;
        }
        return false;
    }app

    public function store(string $name, string $address): int
    {
        return $this->publisher->store(new \App\Domain\Entity\Publisher(null, $name, $address));
    }
}
