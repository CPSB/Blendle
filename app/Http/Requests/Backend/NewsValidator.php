<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsValidator
 *
 * @package App\Http\Requests\Backend
 */
class NewsValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // TODO: Implement validation rules.
        ];
    }
}
