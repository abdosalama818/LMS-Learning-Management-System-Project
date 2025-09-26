<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
       switch($this->method()){
            case 'POST':
                return [
                    'name' => 'required|unique:categories,name',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|unique:categories,name,'.$this->route('category'),
                    'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ];
            default:
                return [];
        }
    }
}
