<?php


namespace App\Http\Requests\InternetPackage\Purchase;


use Illuminate\Foundation\Http\FormRequest;

class PurchaseInternetPackagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method_id' => 'required',
            'amount' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'state' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'email' => 'required',
            'zip_code' => 'required',
            'cart' => 'required',
        ];
    }
}
