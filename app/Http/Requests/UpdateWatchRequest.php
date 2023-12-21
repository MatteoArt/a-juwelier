<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|string|max:150',
            'model' => 'required|string|max:200',
            'price' => 'required|numeric',
            'ref' => 'required|string|max:100',
            'characteristics.0' => 'required|string|max:150',
            'characteristics.1' => 'required|string|max:200',
            'characteristics.2' => 'required|string|max:100',
            'characteristics.3' => 'string|nullable|max:100',
            'characteristics.4' => 'string|nullable|max:100',
            'characteristics.5' => 'string|nullable|max:100',
            'characteristics.6' => 'string|nullable|max:100',
            'characteristics.7' => 'string|nullable|max:100',
            'characteristics.8' => 'string|nullable|max:100',
            'characteristics.9' => 'string|nullable|max:100',
            'images' => 'nullable',
            'images.*' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
        ];
    }


    public function messages(): array
    {
        return [
            'images.*.image' => 'Uploaded files can only be images.',
            'images.*.mimes' => 'The images must be a file of type: png, jpg, jpeg, gif, svg, webp.',
            'images.*.max' => 'The images must not be greater than 2048 KB.'
        ];
    }


    public function attributes(): array
    {
        return [
            'characteristics.0' => 'brand',
            'characteristics.1' => 'model',
            'characteristics.2' => 'ref. no.',
            'characteristics.3' => 'case size',
            'characteristics.4' => 'case material',
            'characteristics.5' => 'bezel',
            'characteristics.6' => 'bracelet material',
            'characteristics.7' => 'box',
            'characteristics.8' => 'cards/papers',
            'characteristics.9' => 'condition'
        ];
    }
}
