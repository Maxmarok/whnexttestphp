<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:10',
                'max:200',
            ],

            'description' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],

            'price' => [
                'required',
                'int',
                'min:1',
                'max:10000000',
            ],

            'photos' => [
                'nullable',
                'array',
                'min:1',
                'max:3',
            ],

            'photos.*' => [
                'required',
                'url',
            ],
        ];
    }

    /**
     * Обработка массива фотографий
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key = null, $default = null);

        if(array_key_exists('photos', $validated)) {
            $photos = $validated['photos'];
            $validated = array_merge($validated, [
                'photo' => array_shift($photos),
                'photos' => implode(',', $photos),
            ]);
        }

        return $validated;
    }
}
