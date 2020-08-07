<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /* パス */
    protected $path;

    public function __construct(Request $request)
    {
        $this->path = preg_replace('/\/{.+}/', '', Route::current()->uri);
        $actionName = explode("@", Route::getCurrentRoute()->getActionName())[1];
        if ($actionName == 'index') {
            $this->path .= '/index';
        }
    }
}