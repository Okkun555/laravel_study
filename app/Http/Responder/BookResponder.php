<?php

namespace App\Http\Responder;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;

class BookResponder
{
    protected $response;
    protected $view;

    public function __construct(Response $response, Factory $view)
    {
        $this->response = $response;
        $this->view = $view;
    }

    public function response(User $user): Response
    {
        if (!$user->id) {
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
        }
        $this->response->setContent(
            $this->view->make('user.index', ['user' => $user])
        );
        return $this->response;
    }
}
