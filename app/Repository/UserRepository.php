<?php

namespace App\Repository;

class UserRepository implements UserRepositoryInterface
{
    public function find(int $id): array
    {
       $user = User::find($id)->toArray();

       return $user;
    }
}
