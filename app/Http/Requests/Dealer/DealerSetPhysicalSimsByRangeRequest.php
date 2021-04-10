<?php


namespace App\Http\Requests\Dealer;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DealerSetPhysicalSimsByRangeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'dealer_id' => 'required',
            'from_iccid' => 'required',
            'to_iccid' => 'required',
        ];
    }
}
