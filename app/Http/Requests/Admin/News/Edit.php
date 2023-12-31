<?php

namespace App\Http\Requests\Admin\News;

use App\Enums\News\Status;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class Edit extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $tableName = (new Category())->getTable();
        return [
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'category_id' => ['required', 'integer', "exists:{$tableName},id"], // "exists:{$tableName},id"] имя таблицы и колонки для сравнения
            'author' => ['required', 'string', 'min:2', 'max:100'],
            'img_url' => ['nullable' /*'someone' поле может отсутствовать (checkbox)*/, 'image'],
            'status' => ['required', new Enum(Status::class)],
            'description' => ['nullable', 'string']
        ];
    }
    
//     public function messages(): array { //в обхоб папки руссификации
//        return [
//            'required' => 'Это уникальное сообщение только для этой формы! Поле :attribute',
//        ];
//    }

    public function attributes(): array {
        return [
            'title' => 'заголовок',
            'description' => 'описание',
            'author' => 'автор',
        ];
    }
}
