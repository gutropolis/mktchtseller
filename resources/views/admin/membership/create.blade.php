@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    @lang('Add Membership Pack')
    @parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>
        @lang('Membership Create')
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>@lang('Membership Pack')</li>
        <li class="active">
            @lang('Membership.create')
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('Membership Pack')
                    </h4>
                </div>
                <div class="panel-body">
                  
                    <form class="form-horizontal" role="form" method="post" action="{{ route('admin.membership.store') }}">
                        <!-- CSRF Token -->

                        {{ csrf_field() }}
						
						
                        <div class="form-group ">
                            <label for="package_name" class="col-sm-2 control-label">
                                @lang('Package Name')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="package_name" name="package_name"  class="form-control"
                                       value="{!! old('package_name') !!}">
                            </div>

                        </div>
						  <div class="form-group ">
                            <label for="currency"  class="col-sm-2 control-label">Currency</label>
							<div class="col-sm-5">
                            <select name="currency" class="form-control">
							<option value="">Select...</option>
							<option value="US Dollar">US Dollar</option>
							<option value="Euro">Euro</option>
							<option value="Rupees">Rupeed</option>
							</select>
							</div>
						
                            
                        </div>
						 <div class="form-group">
                            <label for="amount" class="col-sm-2 control-label">
                                @lang('Amount')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="amount"  name="amount" class="form-control"
                                       value="{!! old('amount') !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('amount', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						 <div class="form-group">
                            <label for="credit" class="col-sm-2 control-label">
                                @lang('Credit')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="credit_score"  name="credit_score" class="form-control"
                                       value="{!! old('credit_score') !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('credit', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4"> 
                                <button type="submit" class="btn btn-success">
                                    @lang('Submit')
                                </button>
								<a class="btn btn-danger" href="{{ route('admin.membership.index') }}">
                                    @lang('Cancel')
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>
@stop
