<?php

namespace App\Foundation\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class CacheUserProvider extends EloquentUserProvider
{
    // ユーザー情報アクセス時に都度発生するDBアクセスをキャッシュ併用のドライバとして作成
    protected $cache;
    protected $cacheKey = "authentication:user:%s";
    protected $lifetime;

    public function __construct(
        HasherContract $hasher,
        string $model,
        Repository $cache,
        int $lifetime = 120,
    ) {
        parent::__construct($hasher, $model);
        $this->cache = $cache;
        $this->lifetime = $lifetime;
    }

    public function retrieveById($identifier)
    {
        $cacheKey = sprintf($this->cacheKey, $identifier);
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        $result = parent::retrieveById($identifier);
        if (is_null($result)) {
            return null;
        }
        $this->cache->add($cacheKey, $result, $this->lifetime);
        return $result;
    }

    public function retrieveByToken($identifier, $token)
    {
        $model = $this->retrieveById($identifier);
        if (!$model) {
            return null;
        }
        $rememberToken = $model->getRememberToken();
        return $rememberToken && hash_equals($rememberToken, $token) ? $model : null;
    }
}
