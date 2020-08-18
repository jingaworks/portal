@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.place.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.places.update", [$place->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="denloc">{{ trans('cruds.place.fields.denloc') }}</label>
                <input class="form-control {{ $errors->has('denloc') ? 'is-invalid' : '' }}" type="text" name="denloc" id="denloc" value="{{ old('denloc', $place->denloc) }}">
                @if($errors->has('denloc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('denloc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.place.fields.denloc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="region_id">{{ trans('cruds.place.fields.region') }}</label>
                <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id">
                    @foreach($regions as $id => $region)
                        <option value="{{ $id }}" {{ ($place->region ? $place->region->id : old('region_id')) == $id ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.place.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection