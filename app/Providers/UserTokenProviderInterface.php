<?php

namespace App\DataProvider;

use stdClass;

interface UserTokenProviderInterface
{
    public function retrieveUserByToken(string $token): ?stdClass;
}
