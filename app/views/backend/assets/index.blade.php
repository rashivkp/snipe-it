@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Assets ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		Assets

		<div class="pull-right">
			<a href="{{ route('create/asset') }}" class="btn-flat success"><i class="icon-plus-sign icon-white"></i> Create New</a>
		</div>
	</h3>
</div>

@if ($assets->getTotal() > 10)
	{{ $assets->links() }}
@endif
<div class="row-fluid table">
<table class="table table-hover">
	<thead>
		<tr>
			<th class="span2">@lang('admin/assets/table.asset_tag')</th>
			<th class="span2"><span class="line"></span>@lang('admin/assets/table.title')</th>
			<th class="span2"><span class="line"></span>@lang('admin/assets/table.serial')</th>
			<th class="span2"><span class="line"></span>@lang('admin/assets/table.checkoutto')</th>
			<th class="span2"><span class="line"></span>@lang('admin/assets/table.location')</th>
			<th class="span1"><span class="line"></span>@lang('admin/assets/table.change')</th>
			<th class="span2"><span class="line"></span>@lang('table.actions')</th>
		</tr>
	</thead>
	<tbody>

		@foreach ($assets as $asset)
		<tr>
			<td><a href="{{ route('view/asset', $asset->id) }}">{{ $asset->asset_tag }}</a></td>
			<td><a href="{{ route('view/asset', $asset->id) }}">{{ $asset->name }}</a></td>
			<td>{{ $asset->serial }}</td>
			<td>
			@if ($asset->assigned_to != 0)
				<a href="{{ route('view/user', $asset->assigned_to) }}">
				{{ $asset->assigneduser->fullName() }}
				</a>
			@endif
			</td>
			<td>
			@if (($asset->assigned_to > 0) && ($asset->assigneduser->location_id > 0))
					{{ Location::find($asset->assigneduser->location_id)->name }}
			@endif
			</td>
			<td>
			@if ($asset->assigned_to != 0)
				<a href="{{ route('checkin/asset', $asset->id) }}" class="btn-flat info">Checkin</a>
			@else
				<a href="{{ route('checkout/asset', $asset->id) }}" class="btn-flat success">Checkout</a>
			@endif
			</td>
			<td nowrap="nowrap">
				<a href="{{ route('update/asset', $asset->id) }}" class="btn-flat white">@lang('button.edit')</a>
				<a class="btn-flat danger delete-asset" data-toggle="modal" href="{{ route('delete/asset', $asset->id) }}" data-content="Are you sure you wish to delete asset {{ $asset->asset_tag }}?" data-title="Delete {{ $asset->asset_tag }}?" onClick="return false;">@lang('button.delete')</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>


@if ($assets->getTotal() > 10)
{{ $assets->links() }}
@endif
@stop
