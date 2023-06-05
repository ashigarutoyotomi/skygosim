<?php


namespace App\Http\Requests\InternetPackage;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadInternetPackagesFileRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,txt'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Choose a file',
            'file.file' => 'It is must be a file',
            'file.mimes' => 'It is must be a CSV file'
        ];
    }
}
