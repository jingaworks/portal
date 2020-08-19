@extends('layouts.user')
@section('content')
@can('profile_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('user.profiles.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.profile.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.profile.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Profile">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.profile.fields.phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.profile.fields.place') }}
                    </th>
                    <th>
                        {{ trans('cruds.profile.fields.region') }}
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
    ajax: "{{ route('user.profiles.index') }}",
    columns: [
        { data: 'phone', name: 'phone' },
        { data: 'place_denloc', name: 'place.denloc' },
        { data: 'region_denj', name: 'region.denj' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: false,
    pageLength: 25,
  };
  let table = $('.datatable-Profile').DataTable(dtOverrideGlobals);
});

</script>
@endsection