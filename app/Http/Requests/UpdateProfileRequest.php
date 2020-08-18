<?php

namespace App\Http\Requests;

use App\Models\Profile;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'phone'     => [
                'string',
                'required',
                'unique:profiles,phone,' . request()->route('profile')->id,
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
