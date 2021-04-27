<?php


namespace App\Http\Requests\Countries;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'region_id' => 'required',
            'name' => 'required',
            'tag' => 'required',
        ];
    }
}
