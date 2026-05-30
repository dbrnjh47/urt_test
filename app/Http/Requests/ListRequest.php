<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "page" => ['nullable', 'integer', 'min:1'],
            "search" => ['nullable', 'string', 'min:1', 'max:128'],
            "category_id" => ['nullable', 'integer'],
            "point_id" => ['nullable', 'integer'],

            // можно массивом, но так проще
            "min_price" => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            "max_price" => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
        ];
    }

    protected function passedValidation(): void
    {
        $price = array_filter([
            $this->validated('min_price') ?? 0,
            $this->validated('max_price'),
        ], fn($value) => !is_null($value));

        if (!empty($price)) {
            $this->merge(['price' => $price]);
        }
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();

        if ($this->has('price')) {
            $data['price'] = $this->input('price');
        }

        if ($key !== null) {
            return data_get($data, $key, $default);
        }

        return $data;
    }
}
