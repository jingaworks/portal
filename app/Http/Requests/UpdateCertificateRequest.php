<?php

namespace App\Http\Requests;

use App\Models\Certificate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCertificateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('certificate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'      => [
                'string',
                'required',
            ],
            'serie'     => [
                'string',
                'required',
                'unique:certificates,serie,' . request()->route('certificate')->id,
            ],
            'place_id'  => [
                'required',
                'integer',
            ],
            'region_id' => [
                'required',
                'integer',
            ],
        ];
    }
}