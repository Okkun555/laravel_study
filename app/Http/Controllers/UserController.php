<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Service\UserPurchaseService;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $inputs = $request->all();

        $rules = [
            'name' => ['required', 'string', 'ascii_alpha'],
            'age' => ['required', 'integer'],
        ];

        // 独自バリデーションを定義
        Validator::extend('ascii_alpha', function ($attribute, $value, $parameters) {
            // 半角アルファベットならtrue　→　クロージャからの戻り値がtrueならばok
            return preg_match('/^[a-zA-Z]+S/', $value);
        });

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            // エラーの場合の処理
        }
    }
}
