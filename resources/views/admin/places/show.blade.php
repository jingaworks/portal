@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.place.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.places.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.id') }}
                        </th>
                        <td>
                            {{ $place->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.denloc') }}
                        </th>
                        <td>
                            {{ $place->denloc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.region') }}
                        </th>
                        <td>
                            {{ $place->region->denj ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.places.index') }}">
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
            <a class="nav-link" href="#place_certificates" role="tab" data-toggle="tab">
                {{ trans('cruds.certificate.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#place_profiles" role="tab" data-toggle="tab">
                {{ trans('cruds.profile.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#place_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="place_certificates">
            @includeIf('admin.places.relationships.placeCertificates', ['certificates' => $place->placeCertificates])
        </div>
        <div class="tab-pane" role="tabpanel" id="place_profiles">
            @includeIf('admin.places.relationships.placeProfiles', ['profiles' => $place->placeProfiles])
        </div>
        <div class="tab-pane" role="tabpanel" id="place_products">
            @includeIf('admin.places.relationships.placeProducts', ['products' => $place->placeProducts])
        </div>
    </div>
</div>

@endsection