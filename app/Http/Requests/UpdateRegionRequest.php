<?php

namespace App\Http\Requests;

use App\Models\Region;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('region_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'denj'     => [
                'string',
                'nullable',
            ],
            'mnemonic' => [
                'string',
                'nullable',
            ],
        ];
    }
}
