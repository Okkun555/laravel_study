<?php

namespace App\Domain\Repository;

use App\DataProvider\Eloquent\Publisher;
use App\DataProvider\PublisherRepositoryInterface;

class PublisherRepository implements PublisherRepositoryInterface
{
    private $eloquentPublisher;

    public function __construct(Publisher $eloquentPublisher)
    {
        $this->eloquentPublisher = $eloquentPublisher;
    }

    public function findByName(string $name): ?Publisher
    {
        $record = $this->eloquentPublisher->whereName($name)->first();
        if ($record === null) {
            return null;
        }

        return new \App\Domain\Entity\Publisher(
            $record->id,
            $record->name,
            $record->address,
        );
    }

    public function store(\App\Domain\Entity\Publisher $publisher): int
    {
        $eloquent = $this->eloquentPublisher->newInstance();
        $eloquent->name = $publisher->getName();
        $eloquent->address = $publisher->getAddress();
        $eloquent->save();

        return (int)$eloquent->id;
    }
}
