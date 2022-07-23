<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * @return bool
     * @author <ferasbbm>
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * @return array
     * @author <ferasbbm>
     */
    public function rules():array
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }
}
