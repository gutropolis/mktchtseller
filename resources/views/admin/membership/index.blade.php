@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Membership List
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
    <h1>Membership</h1>
    <ol class="breadcrumb">
        <li>
           <!-- <a href="{{ route('admin.dashboard') }}">-->
		   <a href="">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="#"> Membership</a></li>
        <li class="active">Membership List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="membership" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('Membership List')
                    </h4>
                    <div class="pull-right">
                    <a href="{{ URL::to('admin/membership/create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span>Create Pack</a>
                    </div>
                </div>
            <br />
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="table">
                     <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Package Name</th>
							<th>Currency</th>
                            <th>Price</th>
                            <th>Credit Score</th>
                             <th>Actions</th>
                        </tr>
                    </thead>
                       <tbody>
                    @if(!empty($memberships))
                        @foreach ($memberships as $membership)
                            <tr>
                                <td>{{ $membership->id }}</td>
                                <td>{{ $membership->package_name }}</td>
                                <td>{{ $membership->currency }}</td>
								 <td>{{ $membership->amount }}</td>
								  <td>{{ $membership->credit_score }}</td>
                                <td>{{ $membership->created_at->diffForHumans() }}</td>
								    <td>
                                   
                                    <a href="{{ URL::to('admin/membership/' . $membership->id . '/edit' ) }}"><i class="livicon"
                                                                                                     data-name="edit"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
                                                                                                     title="@lang('Update')"></i></a>
                                    <a href="{{ route('admin.membership.confirm-delete', $membership->id) }}" data-toggle="modal"
                                       data-target="#delete_confirm"><i class="livicon" data-name="remove-alt"
                                                                        data-size="18" data-loop="true" data-c="#f56954"
                                                                        data-hc="#f56954"
                                                                        title="@lang('membership Delete')"></i></a>
                                </td>
                           
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
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
