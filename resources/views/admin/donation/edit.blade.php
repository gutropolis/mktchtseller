@extends('admin/layouts/default')
{{-- Web site Title --}}
@section('title')
@lang('admin/edit')
@parent
@stop
{{-- Content --}}
@section('content')
<section class="content-header">
   <h1>
      @lang('Donation Edit')
   </h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
         @lang('general.dashboard')
         </a>
      </li>
      <li>@lang('Donation Edit')</li>
      <li class="active">
         @lang('Donation.edit')
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
                  @lang('donation.edit')
               </h4>
            </div>
            <div class="panel-body">
               {!! $errors->first('slug', '<span class="help-block">Another role with same slug exists, please choose another name</span> ') !!}
               @if (count($errors) > 0)
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               @foreach($donation as $rol) @endforeach
               {!! Form::model($rol, ['url' => URL::to('admin/donation/'. $rol->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
               <!-- CSRF Token -->
               {{ csrf_field() }}
              
               <div class="form-group {{ $errors->
                  first('name', 'has-error') }}">
                  <label for="seller" class="col-sm-2 control-label">
                  @lang('Seller Name')
                  </label>
                  <div class="col-sm-5">
                     <input type="text" name="seller" id="seller" required class="form-control resize_vertical"
                        rows="4" value="{!! old('seller'),$rol->seller !!}">
                  </div>
                  <div class="col-sm-4">
                     {!! $errors->first('seller', '<span class="help-block">:message</span> ') !!}
                  </div>
               </div>
                <div class="form-group {{ $errors->first('product', 'has-error') }}">
                  <label for="Product" class="col-sm-2 control-label">Select Product *</label>
                  <div class="col-sm-10">
                     <select name="product" class="form-control required" required>
                        <option value="{{$rol->product}}">{{$rol->product}}</option>
                        @foreach($product as $sellerproduct)
                        <option value="{{$sellerproduct->title}}">--{{$sellerproduct->title}}</option>
                        @endforeach  
                     </select>
                     {!! $errors->first('product', '<span class="help-block">:message</span>') !!}
                  </div>
               </div>
               <div class="form-group {{ $errors->
                  first('name', 'has-error') }}">
                  <label for="Seller" class="col-sm-2 control-label">
                  @lang('Charity Owner')
                  </label>
                  <div class="col-sm-5">
                     <input type="text" name="charity" id="charity" required class="form-control resize_vertical"
                        rows="4" value="{!! old('charity'),$rol->owner_charity !!}">
                  </div>
                  <div class="col-sm-4">
                     {!! $errors->first('charity', '<span class="help-block">:message</span> ') !!}
                  </div>
               </div>
               <div class="form-group {{ $errors->first('charity_organisation', 'has-error') }}">
                  <label for="Charity" class="col-sm-2 control-label">Select Charity *</label>
                  <div class="col-sm-10">
                     <select name="charity_organisation" class="form-control required" required>
                        <option value="{{$rol->charity_organisation}}">{{$rol->charity_organisation}}</option>
                        @foreach($charity as $charity_organsation)
                        <option value="{{$charity_organsation->title}}">--{{$charity_organsation->title}}</option>
                        @endforeach  
                     </select>
                     {!! $errors->first('charity_organisation', '<span class="help-block">:message</span>') !!}
                  </div>
               </div>
               <div class="form-group {{ $errors->
                  first('name', 'has-error') }}">
                  <label for="Units" class="col-sm-2 control-label">
                  @lang('Units')
                  </label>
                  <div class="col-sm-5">
                     <input type="text" name="units" id="units" required class="form-control resize_vertical"
                        rows="4" value="{!! old('units'),$rol->units !!}">
                  </div>
                  <div class="col-sm-4">
                     {!! $errors->first('units', '<span class="help-block">:message</span> ') !!}
                  </div>
               </div>
               <div class="form-group {{ $errors->first('status', 'has-error') }}">
                  <label for="Status" class="col-sm-2 control-label">Status *</label>
                  <div class="col-sm-10">
                     <select name="status" class="form-control required" required>
                        <option value="{{$rol->status}}">{{$rol->status}}</option>
                     
                        <option value="0">--Pending</option>
                         <option value="1">--Accept</option>
                          <option value="2">--No Thanks</option>
                       
                     </select>
                     {!! $errors->first('product', '<span class="help-block">:message</span>') !!}
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4"> 
                     <button type="submit" class="btn btn-success">
                     @lang('Update Donation')
                     </button>
                     <a class="btn btn-danger" href="{{ route('admin.cms.index') }}">
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