<?php

namespace App\Repository;

interface UserRepositoryInterface
{
    /**
     * EloquentやクエリビルダでServiceに返却すると、データ層のインフラへの依存が発生する。
     * ここではphpの標準型arrayで返却しているが、Entityを生成して返却でも◯
     *
     * @param int $id
     * @return array
     */
    public function find(int $id): array;
}
