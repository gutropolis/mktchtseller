@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Charity Requests
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
    <h1>Charity Requests</h1>
    <ol class="breadcrumb">
        <li>
           <!-- <a href="{{ route('admin.dashboard') }}">-->
		   <a href="">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="#"> charity Request</a></li>
        <li class="active">charity Request List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="charity Request" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                   Charity Requests List
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered width100" id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            
                            <th>Created At</th>
                            <th>Status</th>
							<th>Action</th>
                        </tr>
						<tr>
						@foreach($request as $cat)
						<td>{{ $no++ }}</td>
						<td>{{ $cat->title }}</td>
						<td>{{ $cat->description }}</td>
						<td>
                           <div class="img-file">
                             <img src="{{ asset('images/charityads/' . $cat->image) }}" alt="img"
                                 height="60px" width="60px" />
                           </div>
                        </td>
						<td>{{ $cat->created_at }}</td>
						
						 <td>
						 @if(  $cat->status =="0")
							<a class="active_icon" href="{{ URL::to('admin/charityrequests/' . $cat->id . '/accept' ) }}"><i class="fa fa-check-square " title="Click To Activate charity request"></i></a>	
							@else
								
								<a class="active_icon" href="{{ URL::to('admin/charityrequests/' . $cat->id . '/deactivate' ) }}"><i class="active_icon fa fa-times" title="Click To Deactivate Charity request"></i></a>
							
							 @endif
								</a>
							</td>
						 <td>
    
	 <a href="{{ URL::to('admin/charityrequests/' . $cat->id . '/edit' ) }}"><i class="livicon"
                                                                                                     data-name="edit"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
	title="@lang('CharityRequest/table.update')"></i></a> 
    
    
    
    
    
    <a href="{{ route('admin.charityrequests.delete', $cat->id) }}"><i class="livicon" data-name="remove-alt"
                                                                        data-size="18" data-loop="true" data-c="#f56954"
                                                                        data-hc="#f56954"
                                                                        title="@lang('Charity Request/table.delete')"></i></a></td>
						
						</tr>
						 @endforeach
  
						
                    </thead>
                    <tbody>


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
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>



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
	$('#facebookicon').click(function() {
  $(this).find('i').toggleClass('fa-times fa-check-square')
});
	
});
</script>
<style>
.active_icon
{
	font-size:20px;
}
.active_icon .fa-times{
	color:red;
}
.active_icon .fa-check-square
{
	color:green;
}
</style>
@stop
