@extends('layouts.user')
@section('content')
@can('certificate_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('user.certificates.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.certificate.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.certificate.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Certificate">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.certificate.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.certificate.fields.serie') }}
                    </th>
                    <th>
                        {{ trans('cruds.certificate.fields.region') }}
                    </th>
                    <th>
                        {{ trans('cruds.certificate.fields.place') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('user.certificates.index') }}",
    columns: [
        { data: 'name', name: 'name' },
        { data: 'serie', name: 'serie' },
        { data: 'region_denj', name: 'region.denj' },
        { data: 'place_denloc', name: 'place.denloc' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    pageLength: 25,
  };
    let table = $('.datatable-Certificate').DataTable(dtOverrideGlobals);
});

</script>
@endsection