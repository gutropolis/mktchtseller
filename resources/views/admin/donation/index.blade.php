@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Donation List
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
    <h1>Donation</h1>
    <ol class="breadcrumb">
        <li>
           <!-- <a href="{{ route('admin.dashboard') }}">-->
           <a href="">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="#"> Donation</a></li>
        <li class="active">Donation List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="seller" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Donation List
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered width100" id="table">
                    <thead>
                        <tr class="filters">
								<th>Id</th>
                                <th>Seller Name</th>
                                <th>Donated Product</th>
                                <th>Units</th>
                                <th>Charity Organization</th>
								<th>Progress %</th>
								<th>Status</th>
                                <th>Created At</th>
                               
                        </tr>
						
						
						
						
						
						
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

<script>
    $(function() {
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
              ajax: '{!! route('admin.donation_list.data') !!}',
            columns: [
            { data: 'id', name: 'id' },
            { data: 'seller', name: 'Seller Name' },
            { data: 'product', name: 'Donated Product' },
            {data: 'units', name: 'units'},
            {data:'charity_organisation', name: 'Charity Name'},
			{data:'progress' ,name: 'Progress'},
			{data:'status',name:'status'},
            { data: 'created_at', name:'created_at'},
                
              
            ]
        });
        table.on( 'draw', function () {
            $('.livicon').each(function(){
                $(this).updateLivicon();
            });
        } );
    });

</script>

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
