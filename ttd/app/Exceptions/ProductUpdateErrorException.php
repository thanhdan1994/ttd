<?php
namespace App\Exceptions;

use Exception;

class ProductUpdateErrorException extends Exception
{
    public function rules()
    {
        return [
            'featured_image' => 'exists:media,id',
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return string
     */
    public function messages()
    {
        return [
            'featured_image.exists' => 'image didn\'t exists'
        ];
    }
}
