@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Asset Manufacturers ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Asset Manufacturers

		<div class="pull-right">
			<a href="{{ route('create/manufacturer') }}" class="btn-flat success"><i class="icon-plus-sign icon-white"></i> Create New</a>
		</div>
	</h3>
</div>

@if ($manufacturers->getTotal() > 10)
{{ $manufacturers->links() }}
@endif

<div class="row-fluid table">
<table class="table table-hover">
	<thead>
		<tr>
			<th class="span10">@lang('admin/manufacturers/table.title')</th>
			<th class="span2"><span class="line"></span>@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($manufacturers as $manufacturer)
		<tr>
			<td>{{ $manufacturer->name }}</td>
			<td>
				<a href="{{ route('update/manufacturer', $manufacturer->id) }}" class="btn-flat white">@lang('button.edit')</a>
				<a class="btn-flat danger delete-asset" data-toggle="modal" href="{{ route('delete/manufacturer', $manufacturer->id) }}" data-content="Are you sure you wish to delete the  {{ $manufacturer->name }} manufacturer?" data-title="Delete {{ $manufacturer->name }}?" onClick="return false;">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>

@if ($manufacturers->getTotal() > 10)
{{ $manufacturers->links() }}
@endif

@stop
