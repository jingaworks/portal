@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.certificate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.certificates.update", [$certificate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.certificate.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $certificate->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="serie">{{ trans('cruds.certificate.fields.serie') }}</label>
                <input class="form-control {{ $errors->has('serie') ? 'is-invalid' : '' }}" type="text" name="serie" id="serie" value="{{ old('serie', $certificate->serie) }}" required>
                @if($errors->has('serie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('serie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.serie_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="region_id">{{ trans('cruds.certificate.fields.region') }}</label>
                <select class="form-control select2 {{ $errors->has('region') ? 'is-invalid' : '' }}" name="region_id" id="region_id" required>
                    @foreach($regions as $id => $region)
                        <option value="{{ $id }}" {{ ($certificate->region ? $certificate->region->id : old('region_id')) == $id ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place_id">{{ trans('cruds.certificate.fields.place') }}</label>
                <select class="form-control select2 {{ $errors->has('place') ? 'is-invalid' : '' }}" name="place_id" id="place_id" required>
                    @foreach($places as $id => $place)
                        <option value="{{ $id }}" {{ ($certificate->place ? $certificate->place->id : old('place_id')) == $id ? 'selected' : '' }}>{{ $place }}</option>
                    @endforeach
                </select>
                @if($errors->has('place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="validation_images">{{ trans('cruds.certificate.fields.validation_images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('validation_images') ? 'is-invalid' : '' }}" id="validation_images-dropzone">
                </div>
                @if($errors->has('validation_images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('validation_images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.certificate.fields.validation_images_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedValidationImagesMap = {}
Dropzone.options.validationImagesDropzone = {
    url: '{{ route('admin.certificates.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="validation_images[]" value="' + response.name + '">')
      uploadedValidationImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedValidationImagesMap[file.name]
      }
      $('form').find('input[name="validation_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($certificate) && $certificate->validation_images)
      var files = {!! json_encode($certificate->validation_images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="validation_images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection