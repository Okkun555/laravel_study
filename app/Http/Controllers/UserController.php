<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Service\UserPurchaseService;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserPurchaseService $service)
    {
        $this->service = $service;
    }

    public function index(string $id)
    {
        $result = $this->service->retrievePurchase(intval($id));
        return view('user.index', ['user' => $result]);
    }

    public function register(Request $request)
    {
        $name = $request->get('name');
        $age = $request->get('age');
    }
}
