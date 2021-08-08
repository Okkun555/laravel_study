<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        /**
         * コンストラクタに渡された値は$this->resourceプロパティを利用して取得
         * ArticleResource.phpで new UserResource()の引数で渡している値の事
         */
        return [
            'id' => $this->resource['user_id'],
            'name' => $this->resource['user_name'],
            '_links' => [
                'self' => [
                    'href' => 'https://example.com/users/%s',
                    $this->resource['user_id']
                ]
            ]
        ];
    }
}
