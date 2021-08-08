<?php

namespace App\Service;

use App\Models\Purchase;
use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserPurchaseService
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function retrievePurchase(int $identifier): User
    {
        $user = $this->userRepository->find($identifier);
        return $user;
    }
}
