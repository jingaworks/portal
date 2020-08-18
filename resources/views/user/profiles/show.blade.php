@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.profile.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.profiles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.profile.fields.id') }}
                        </th>
                        <td>
                            {{ $profile->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profile.fields.phone') }}
                        </th>
                        <td>
                            {{ $profile->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profile.fields.place') }}
                        </th>
                        <td>
                            {{ $profile->place->denloc ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profile.fields.region') }}
                        </th>
                        <td>
                            {{ $profile->region->denj ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.profile.fields.avatar') }}
                        </th>
                        <td>
                            @if($profile->avatar)
                                <a href="{{ $profile->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $profile->avatar->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.profiles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#profile_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#profile_certificates" role="tab" data-toggle="tab">
                {{ trans('cruds.certificate.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="profile_products">
            @includeIf('admin.profiles.relationships.profileProducts', ['products' => $profile->profileProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="profile_certificates">
            @includeIf('admin.profiles.relationships.profileCertificates', ['certificates' => $profile->profileCertificates])
        </div>
    </div>
</div>

@endsection