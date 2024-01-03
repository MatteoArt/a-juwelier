<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProposalRequest extends FormRequest
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
            'fullname' => 'required|string|max:200|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:3',
            'city' => 'string|nullable|min:3',
            'address' => 'string|nullable|min:5',
            'informations.*' => 'string|nullable|min:2',
            'photo1' => 'required|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'photo2' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'photo3' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'price' => 'required|string',
            'note' => 'nullable|string|min:10'
        ];
    }
}
