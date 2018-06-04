@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    @lang('admin/Membership/plan.create')
    @parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>
       Edit Payments
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>Update Payments Setting</li>
        <li class="active">
				Edit Paymenst Settings
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
                      Edit Payments Setting
                    </h4>
                </div>
                <div class="panel-body">
                   @foreach($payments as $payment) 
				 
				   
				   @endforeach
               {!! Form::model($payments, ['url' => URL::to('admin/payments/'. $payment->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                        <!-- CSRF Token -->

                        {{ csrf_field() }}
							
                        <div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">
                              Email
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Package Name"
                                       value="{!! old('email'),$payment->email !!}">
                            </div>
							
                        </div>
						<div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">
                              Stripe Secret Key
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="stripe_secret_key" name="stripe_secret_key" class="form-control" placeholder="stripe_secret_key"
                                       value="{!! old('stripe_secret_key'),$payment->stripe_secret_key !!}">
                            </div>
                          
                        </div>
						<div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">
                              Stripe Publishable Key
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="stripe_publishable_key" name="stripe_publishable_key" class="form-control" placeholder="Package Name"
                                       value="{!! old('stripe_publishable_key'),$payment->stripe_publishable_key !!}">
                            </div>
							
                        </div>
						 <div class="form-group ">
                            <label for="title" class="col-sm-2 control-label">
                              Currency
                            </label>
                            <div class="col-sm-5">
                              <select class="form-control required" title="Select currency..." name="currency"
                                                        id="currency">
                                                     <option value="{{$payment->currency}}">{{$payment->currency}}</option>
                                                    <option value="doller"
                                                            @if(old('currency') === '1') selected="selected" @endif >US Doller
                                                    </option>
                                                    
                                                    <option value="euro"
                                                            @if(old('currency') === '2') selected="selected" @endif >Euro
                                                    </option>
                                                </select>
                            </div>
                            
                        </div>
						
							
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
							 <button type="submit" class="btn btn-success">
                                   Submit
                                </button>
                                <a class="btn btn-danger" href="{{ route('admin.payments.index') }}">
                                    Cancel
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
