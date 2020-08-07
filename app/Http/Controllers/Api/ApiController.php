<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;

class ApiController extends Controller
{
    protected $modelName;

    public function search(ApiRequest $request)
    {
        $result = $this->modelName::all();
        return $request->successResponse($result);
    }

    public function create(ApiRequest $request)
    {
        $m = new $this->modelName;
        $m->fill($request->all())->save();
        return $request->successResponse([]);
    }

    public function update(ApiRequest $request)
    {
        $m = $this->modelName::find($request->id);
        $m->fill($request->all())->save();
        return $request->successResponse([]);
    }

    public function delete(ApiRequest $request)
    {
        $this->modelName::find($request->id)->delete();
        return $request->successResponse([]);
    }
}