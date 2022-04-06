<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ArticleGetRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'filled|string',
            'author' => 'filled|string',
            'published' => 'filled|boolean',
            'order_by' => [
                'filled',
                'string',
                Rule::in(['name', 'author', 'published', 'rating'])
            ],
            'sort_type' => [
                'filled',
                'string',
                Rule::in(['asc', 'desc'])
            ],
            'relation_weight' => 'filled|int',
            'relation_author' => 'filled|string',
            'page' => 'filled|int',
            'rating_more' => 'filled|int',
            'rating_less' => 'filled|int',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors(), 'status' => true], 422)
        );
    }
}
