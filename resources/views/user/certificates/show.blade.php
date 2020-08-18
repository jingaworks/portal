@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.certificate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.certificates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.id') }}
                        </th>
                        <td>
                            {{ $certificate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.name') }}
                        </th>
                        <td>
                            {{ $certificate->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.serie') }}
                        </th>
                        <td>
                            {{ $certificate->serie }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.region') }}
                        </th>
                        <td>
                            {{ $certificate->region->denj ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.place') }}
                        </th>
                        <td>
                            {{ $certificate->place->denloc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.certificate.fields.validation_images') }}
                        </th>
                        <td>
                            @foreach($certificate->validation_images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.certificates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection