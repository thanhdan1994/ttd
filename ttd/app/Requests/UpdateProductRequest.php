<?php
namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'excerpt' => ['required'],
            'content' => ['required'],
            'phone' => ['required'],
            'amount' => ['required', 'numeric'],
            'address' => ['required'],
            'lat' => ['required'],
            'long' => ['required']
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
            'name.required' => 'Tên sản phẩm là bắt buộc',
            'name.max' => 'Tên sản phẩm quá dài (phải nhỏ hơn 255 kí tự)',
            'content.required'  => 'Nội dung sản phẩm là bắt buộc',
            'excerpt.required'  => 'Mô tả sản phẩm là bắt buộc',
            'lat.required' => 'Latitude là bắt buộc',
            'long.required' => 'Longitude là bắt buộc',
            'amount.required' => 'Giá sản phẩm là bắt buộc',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'address.required' => 'Địa chỉ là bắt buộc'
        ];
    }
}
