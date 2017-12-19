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
                        @lang('Membership.create')
                    </h4>
                </div>
                <div class="panel-body">
                   
                     {!! Form::model($membership, ['url' => URL::to('admin/membership/'. $membership->id.''), 'method' => 'put', 'class' => 'form-horizontal','id'=>'commentForm', 'enctype'=>'multipart/form-data','files'=> true]) !!}
                        <!-- CSRF Token -->

                        {{ csrf_field() }}
						
						
                        <div class="form-group {{ $errors->
                            first('title', 'has-error') }}">
                            <label for="title" class="col-sm-2 control-label">
                                @lang('Title')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="title" name="title"  class="form-control" placeholder="Title"
                                       value="{!! old('title',$membership->title) !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('title', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						 <div class="form-group {{ $errors->
                            first('description', 'has-error') }}">
                            <label for="description" class="col-sm-2 control-label">
                                @lang('Description')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="description"  name="description" class="form-control" placeholder="Description"
                                       value="{!! old('description',$membership->description) !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('description', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						 <div class="form-group {{ $errors->
                            first('duration', 'has-error') }}">
                            <label for="duration" class="col-sm-2 control-label">
                                @lang('Duration')
                            </label>
                            <div class="col-sm-5">
                                <input type="text" id="duration"  name="duration" class="form-control" placeholder="duration"
                                       value="{!! old('duration',$membership->duration) !!}">
                            </div>
                            <div class="col-sm-4">
                                {!! $errors->first('duration', '<span class="help-block">:message</span> ') !!}
                            </div>
                        </div>
						

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4"> 
                                <button type="submit" class="btn btn-success">
                                    @lang('Update Membership')
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
