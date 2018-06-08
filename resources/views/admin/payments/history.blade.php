@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Payment History
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
    <h1>Payment History</h1>
    <ol class="breadcrumb">
        <li>
           <!-- <a href="{{ route('admin.dashboard') }}">-->
		   <a href="">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
      
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="seller" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Payment History
                </h4>
				
            </div>
            <br />
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered width100" id="table">
                    <thead>
                        <tr class="filters">
							<th>Id</th>
                            <th>User Email</th>
                            <th>Plan Name</th>
                            <th>Stripe ID</th>
							<th>Credit</th>
							<th>Remaning Credit</th>
                            <th>Paid Amount</th>
							<th>Status</th>
                           
                        </tr>
						<tr>
							@foreach($subscription as $cat)
							<td>{{ $no++ }}</td>
						<td>{{ $cat->stripe_email }}</td>
						<td>{{ $cat->package_name }}</td>
						<td>{{ $cat->stripe_id }}</td>
						<td>{{ $cat->credit }}</td>
						<td>{{ $cat->remaining_credit}}
						<td>${{ $cat->amount }}</td>
						<td> @if($cat->status == '1') Active @endif
						@if($cat->status=='0')Deactive @endif</td>
						 
						
						
						</tr>
							 @endforeach
						
                    </thead>
                    <tbody>
							

                    </tbody>
                </table>
				{!! $subscription->links('pagination') !!}
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



<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="seller_delete_confirm_title" aria-hidden="true">
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
