<?php


namespace App\Http\Requests\Setting;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'id' => 'required',
            'section' => 'required',
            'title' => 'required',
            'type' => 'required',
            'value' => 'required',
        ];
    }
}
