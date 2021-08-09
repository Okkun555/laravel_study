<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;

class ArticlePayloadAction extends Controller
{
    public function __invoke(Request $request)
    {
       $resource = new ArticleResource([
           'id' => 1,
           'title' => 'Laravel Rest Api',
           'comments' => [
               [
                   'id' => 2134,
                   'body' => 'awesome!',
                   'user_id' => 123334,
                   'user_name' => 'Application Developer',
               ]
           ],
           'user_id' => 12344,
           'user_name' => 'user1',
       ]);
       return $resource->response($request)
           ->header('content-type', 'application/hal+json');
    }
}
