<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function status()
    {
        return response()->json(['status' => 'ok'], 200);
    }

    use AuthorizesRequests, ValidatesRequests;
}
