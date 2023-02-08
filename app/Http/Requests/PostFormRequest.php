<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:255|unique:posts,title,' . $this->id,
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'minutes_to_read' => 'numeric|min:1|max:60',
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|mimes:jpg,jpeg,png|max:2048';
        }

        return $rules;
    }
}
