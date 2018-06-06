@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    @lang('Add Membership')
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
        <li>@lang('Membership TITLE')</li>
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
                        Edit Package
                    </h4>
                </div>
                <div class="panel-body">
                   
                     {!! Form::model($membership, ['url' => URL::to('admin/membership/'. $membership->id.''), 'method' => 'put', 'class' => 'form-horizontal','id'=>'commentForm', 'enctype'=>'multipart/form-data','files'=> true]) !!}
                        <!-- CSRF Token -->

                        {{ csrf_field() }}
						
						
                        <div class="form-group ">
                            <label for="package_name" class="col-sm-2 control-label">
                                @lang('Package Name')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="package_name" name="package_name"  class="form-control" placeholder="package_name"
                                       value="{!! old('package_name',$membership->package_name) !!}">
                            </div>
                            
                        </div>
						  <div class="form-group ">
						  <label for="package_name" class="col-sm-2 control-label">
                                @lang('Package Name')
                            </label>
							  <div class="col-sm-5">
                        <textarea name="description" id="description" class="form-control resize_vertical" placeholder="Description"
                                  rows="4">{!! old('description',$membership->description) !!}</textarea>
								   <span class="help-block">{{ $errors->first(
								   'description', ':message') }}</span>
                                            </div>
											</div>
						 <div class="form-group ">
                            <label for="currency"  class="col-sm-2 control-label">Currency</label>
							<div class="col-sm-5">
                            <select name="currency" class="form-control">
							<option value="">Select...</option>
							<option value="US Dollar" @if($membership->currency === 'US Dollar') selected="selected" @endif>US Dollar</option>
							<option value="Euro" @if($membership->currency === 'Euro') selected="selected" @endif>Euro</option>
							<option value="Rupees" @if($membership->currency === 'Rupees') selected="selected" @endif>Rupees</option>
							</select>
							</div>
						
                            
                        </div>
						 <div class="form-group">
                            <label for="amount" class="col-sm-2 control-label">
                                @lang('Amount')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="amount"  name="amount" class="form-control" placeholder="amount"
                                       value="{!! old('amount',$membership->amount) !!}">
                            </div>
                           
                        </div>
						 <div class="form-group">
                            <label for="credit_score" class="col-sm-2 control-label">
                                Credit
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="credit_score"  name="credit_score" class="form-control" placeholder="credit_score"
                                       value="{!! old('credit_score',$membership->credit_score) !!}">
                            </div>
                            
                        </div>
						

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4"> 
                                <button type="submit" class="btn btn-success">
                                    @lang('Update Package')
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
