@extends('layouts.admin')
@section('content')
@can('profile_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.profiles.create') }}">
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
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.profile.fields.id') }}
                    </th>
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <!-- <input class="search" type="text" placeholder="{{ trans('global.search') }}"> -->
                    </td>
                    <td>
                    @can('user_management_access')
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    @endcan
                    </td>
                    <td>
                    @can('user_management_access')
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($places as $key => $item)
                                <option value="{{ $item->denloc }}">{{ $item->denloc }}</option>
                            @endforeach
                        </select>
                    @endcan
                    </td>
                    <td>
                    @can('user_management_access')
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($regions as $key => $item)
                                <option value="{{ $item->denj }}">{{ $item->denj }}</option>
                            @endforeach
                        </select>
                    @endcan
                    </td>
                    <td>
                    </td>
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
@can('profile_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.profiles.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.profiles.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'phone', name: 'phone' },
        { data: 'place_denloc', name: 'place.denloc' },
        { data: 'region_denj', name: 'region.denj' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Profile').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
});

</script>
@endsection