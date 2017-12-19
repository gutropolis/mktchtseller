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
        @lang('CMS Edit')
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>@lang('CMS Edit')</li>
        <li class="active">
            @lang('CMS.edit')
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
                        @lang('CMS.edit')
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
					@foreach($cms as $rol) @endforeach
                   {!! Form::model($rol, ['url' => URL::to('admin/sellerproduct/'. $rol->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                        <!-- CSRF Token -->

                        {{ csrf_field() }}
						
						
                        <div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="title" class="col-sm-2 control-label">
                                @lang('Title')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="title" name="title" class="form-control" required placeholder="Title"
                                       value="{!! old('title'),$rol->title !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('title', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="description" class="col-sm-2 control-label">
                                @lang('Description')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="description" required name="description
								" class="form-control" placeholder="Description"
                                       value="{!! old('description'),$rol->description !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('description', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>

						
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="asin_url" class="col-sm-2 control-label">
                                @lang('asin_url')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="asin_url" required name="asin_url" class="form-control" placeholder="asin_url"
                                       value="{!! old('asin_url'),$rol->asin_url !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('asin_url', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						<div class="form-group {{ $errors->first('images', 'has-error') }}">
                                            <label for="images" class="col-sm-2 control-label">Image of Product</label>
                                            <div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                        <img src="{!! url('/').'/uploads/sellerproduct/'.$rol->images !!}" alt="img"
                                                                         class="img-responsive"/>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                    <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                   <input id="images" name="images" type="file"
                                                               class="form-control" required/>
                                </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('images', ':message') }}</span>
                                            </div>
                                        </div>
						
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="reviews" class="col-sm-2 control-label">
                                @lang('Product Review')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="reviews" required name="reviews" class="form-control" placeholder="Product_review"
                                       value="{!! old('reviews'),$rol->reviews !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('reviews', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						
						 
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="user_id" class="col-sm-2 control-label">
                                @lang('User Id')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="user_id" required name="user_id" class="form-control" placeholder="Add User"
                                       value="{!! old('user_id'),$rol->user_id !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('user_id', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						
						
						
				
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4"> 
                                <button type="submit" class="btn btn-success">
                                    @lang('Update Product')
                                </button>
								<a class="btn btn-danger" href="{{ route('admin.sellerproduct.index') }}">
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
