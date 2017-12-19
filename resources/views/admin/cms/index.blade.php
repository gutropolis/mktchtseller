@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('CMS ')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>@lang('CMS Content')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li><a href="#">@lang('CMS')</a></li>
        <li class="active">@lang('CMS Content')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    @lang('CMS Content')
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.cms.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('cms.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="table">
                    <thead>
                       <tr>
                                    <th>@lang('ID')</th>
                                    
                                    <th>@lang('Title')</th>
                                    <th>@lang('Description')</th>
									<th>@lang('Meta_keyword')</th>
									<th>@lang('Meta_title')</th>
									<th>@lang('created_at')</th>
									<th>@lang('Actions')</th>
                                </tr>
                    </thead>
                    <tbody>
                    
                            @foreach ($cms as $role)
                             <tr>
                                    <td>{!! $role->id !!}</td>
                                   
									<td>{!! $role->title!!}</td>
									<td>{!! $role->description !!}</td>
									<td>{!! $role->meta_keyword !!}</td>
									<td>{!! $role->meta_title !!}</td>
									
                                    <td>{!! $role->created_at!!}</td>
                                    <td>
                                    
                                    <a href="{{ URL::to('admin/cms/' . $role->id . '/edit' ) }}"><i class="livicon"
                                                                                                     data-name="edit"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
                                                                                                     title="@lang('cms update')"></i></a>
                                    <a href="{{ route('admin.cms.confirm-delete', $role->id) }}" data-toggle="modal"
                                       data-target="#delete_confirm"><i class="livicon" data-name="remove-alt"
                                                                        data-size="18" data-loop="true" data-c="#f56954"
                                                                        data-hc="#f56954"
                                                                        title="@lang('cms/table.delete-blog')"></i></a>
                                </td>
                                </tr>
                                @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content"></div>
  </div>
</div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
</script>
@stop
