<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|unique:users|max:100',
            'name'=>'required|max:100',
            'surname'=>'required|max:100',
            'contact_number'=>'required|max:15',
            'role_id'=>'required',
            'branch_id'=>'required',
            'account_status'=>'required',
            'dob'=>'nullable',
            'contact_number_two'=>'nullable'
        ];
    }
}
