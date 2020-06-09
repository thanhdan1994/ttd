<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'excerpt' => ['required'],
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
            'excerpt.required' => 'Tên sản phẩm là bắt buộc',
            'product_id.required' => 'Sản phẩm report là bắt buộc',
        ];
    }
}
