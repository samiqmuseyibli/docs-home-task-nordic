<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'max:191'],
            'lastname' => ['required', 'string', 'max:191'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'description' => ['required', 'string', 'max:191'],
            'refId' => ['required', 'string', 'unique:payments,ref_id'],
            'paymentDate' => ['required', 'date']
        ];
    }

    public function attributes()
    {
        return [
            'firstname' => "First name",
            'lastname' => "Last name",
            'amount' => "Amount",
            'description' => "Description",
            'refId' => "Reference Id",
            'paymentDate' => 'Payment Date',
        ];
    }

    public function messages()
    {
        return [
            'refId.unique' => "Duplicate Reference Id."
        ];
    }
}
