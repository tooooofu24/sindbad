<?php

namespace App\Http\Requests;

use App\Consts\Consts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpotUploadRequst extends FormRequest
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
            'name'   => [
                'required',
                // prefとnameの複合ユニーク
                Rule::unique('spots')->where(function ($query) {
                    $query->where('pref', $this->pref);
                })
            ],
            'pref' => [
                'required',
                Rule::in(Consts::PREF_LIST),
            ],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '観光地名',
            'pref' => '都道府県'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attributeは必須です',
            'unique' => "$this->pref の$this->name は既に存在しています",
            'in' => ':attributeは「都、道、府、県」を付けた形で入力してください'
        ];
    }
}
