<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    private $config_path;
    private $RESPONSE_JSON_FORMAT = [
        'status'      => '',
        'status_code' => 400,
        'result_code' => 0,
        'errors'      => [],
        'result'      => [],
    ];

    public function __construct()
    {
        $route = \Route::current();
        $this->config_path = $route ? str_replace('/', '.', $route->uri) : '';
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = config("validator.$this->config_path", []);
        if ($rules == '') {
            //abort(500, 'バリデーションルールが見つかりませんでした。');
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->failedResponse($validator)
        );
    }

    public function failedResponse(Validator $validator) {
        $errorMessages = $validator->errors()->getMessages();
        $failedRules   = $validator->failed();

        $errors = [];
        foreach($failedRules as $name => $rules){
            $i = 0;
            foreach($rules as $ruleName => $ruleInfo){
                $ruleName = snake_case($ruleName);
                $code = config('validationErrorCode.' . $ruleName, '');
                if (!$code) {
                    abort(500, 'エラーコードが見つかりませんでした。');
                }
                $errors[] = [
                    'name'    => $name,
                    'code'    => $code,
                    'message' => $errorMessages[$name][$i],
                ];
                $i++;
            }
        }

        $response = $this->RESPONSE_JSON_FORMAT;
        $response['errors']      = $errors;
        $response['result_code'] = 0;
        $response['status_code'] = 400;
        $response['status']      = 'Validation Error';

        return response()->json($response, 200);
    }

    public function successResponse($data)
    {
        $response = $this->RESPONSE_JSON_FORMAT;
        $response['result']      = $data;
        $response['result_code'] = 1;
        $response['status_code'] = 200;
        $response['status']      = 'success';
        return response()->json($response, 200);
    }

    public function getResponseFormat() {
        return $this->RESPONSE_JSON_FORMAT;
    }
}