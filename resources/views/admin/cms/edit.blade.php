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
                   {!! Form::model($rol, ['url' => URL::to('admin/cms/'. $rol->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                        <!-- CSRF Token -->

                        {{ csrf_field() }}
						
						
                        <div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="title" class="col-sm-2 control-label">
                                @lang('Title')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="title" name="title" class="form-control" placeholder="Title"
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
                                <input type="text" id="description" name="description
								" class="form-control" placeholder="Description"
                                       value="{!! old('description'),$rol->description !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('description', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="meta_keyword" class="col-sm-2 control-label">
                                @lang('Meta Keyword')
                            </label>
                            <div class="col-sm-5">
                                 <textarea name="meta_keyword" id="meta_keyword" required class="form-control resize_vertical"
                                  rows="4">{!! old('meta_keyword'),$rol->meta_keyword !!}</textarea>
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('meta_keyword', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="meta_desc" class="col-sm-2 control-label">
                                @lang('Meta Description')
                            </label>
                            <div class="col-sm-5">
                                 <textarea name="meta_desc" id="meta_desc" required class="form-control resize_vertical"
                                  rows="4">{!! old('meta_desc'),$rol->meta_desc !!}</textarea>
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('meta_desc', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="meta_title" class="col-sm-2 control-label">
                                @lang('Meta Title')
                            </label>
                            <div class="col-sm-5">
                                 <textarea name="meta_title" id="meta_title" required class="form-control resize_vertical"
                                  rows="4">{!! old('meta_title'),$rol->meta_title !!}</textarea>
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('meta_title', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						
						 
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="slug" class="col-sm-2 control-label">
                                @lang('Slug')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="slug" name="slug" class="form-control" placeholder="Add Slug"
                                       value="{!! old('slug'),$rol->slug !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('slug', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						<div class="form-group {{ $errors->
                            first('name', 'has-error') }}">
                            <label for="slug" class="col-sm-2 control-label">
                                @lang('Guide')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="guide" name="guide" class="form-control" placeholder="Add Guide"
                                       value="{!! old('guide'),$rol->guide !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('guide', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						
						
				
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4"> 
                                <button type="submit" class="btn btn-success">
                                    @lang('Update CMS')
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
