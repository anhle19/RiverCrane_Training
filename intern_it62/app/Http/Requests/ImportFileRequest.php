<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportFileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file' => 'required|file|mimes:xlsx,xls'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Không được để trống file',
            'file.file' => 'File phải là xlsx, xls',
            'file.mimes' => 'File phải là xlsx, xls'
        ];
    }
}
