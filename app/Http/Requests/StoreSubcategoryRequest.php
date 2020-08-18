<?php

namespace App\Http\Requests;

use App\Models\Subcategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubcategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
                'unique:subcategories',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
