<?php


namespace App\Http\Requests\Apn;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateApnRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'country_id' => 'required',
            'operator' => 'required',
            'apn' => 'required',
        ];
    }
}
