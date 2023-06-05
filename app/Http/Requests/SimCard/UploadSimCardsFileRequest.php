<?php


namespace App\Http\Requests\SimCard;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadSimCardsFileRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xlsx,xls'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Choose a file',
            'file.file' => 'It is must be a file',
            'file.mimes' => 'It is must be a Excel file'
        ];
    }
}
