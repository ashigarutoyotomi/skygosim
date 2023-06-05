<?php


namespace App\Http\Requests\Users;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddToCartInternetPackageRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'user_id' => 'required',
            'sim_id' => 'required|integer',
            'internet_package_id' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sim_id.required' => 'Choose sim',
            'sim_id.integer' => 'Choose sim'
        ];
    }
}
