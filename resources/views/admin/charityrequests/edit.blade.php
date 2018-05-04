@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('Seller Category') :: @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/summernote/summernote.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/blog.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')

<section class="content-header">
    <!--section starts-->
    <h1>@lang('Edit Product Category')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">@lang('Category')</a>
        </li>
        <li class="active">@lang('Edit category ')</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            <!-- errors -->
            {!! Form::model($charityrequest, ['url' => URL::to('admin/charityrequests/' . $charityrequest->id), 'method' => 'put', 'class' => 'bf', 'files'=> true]) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                 <div class="row">
                    <div class="col-sm-8">
					
						 
					
                        <div class="form-group ">
                                            <label for="title" class="col-sm-2 control-label">Title *</label>
                                            <div class="col-sm-10">
                                                <input id="title" name="title" type="text"
                                                       placeholder="title" class="form-control required"
                                                       value="{!! old('title',$charityrequest->title) !!}" required/>

                                                <span class="help-block">{{ $errors->first(
								   'title', ':message') }}</span>
                                            </div>
                        </div>
                          <div class="form-group ">
						   <label for="title" class="col-sm-2 control-label">Description </label>
						   <div class="col-sm-10">
                        <textarea name="description" id="description" class="form-control resize_vertical" placeholder="Description"
                                  rows="4">{!! old('description',$charityrequest->description) !!}</textarea>
								   <span class="help-block">{{ $errors->first(
								   'description', ':message') }}</span>
                       </div>
                 </div>
				 {{--   <div class="form-group {{ $errors->first('image', 'has-error') }}">
                                                    <label for="pic" class="col-sm-2 control-label">Image </label>
                                                    <div class="col-sm-10">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                @if($charityrequest->image)
                                                                    <img src="{!! url('/').'/images/charityads/'.$charityrequest->image !!}" alt="img"
                                                                         class="img-responsive"/>
                                                               
                                                                @endif
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                            <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="image" name="image" type="file" class="form-control" />
                                                    </span>
                                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" style="color: black !important;">Remove</a>
                                                            </div>
                                                        </div>
                                                        {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                                                    </div>
				 </div> --}}
                       
                       
                       
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">@lang('Update')</button>
                            <a href="#"
                               class="btn btn-danger">@lang('Cancel')</a>
                        </div>
                   
                    <!-- /.col-sm-4 --> 
                {!! Form::close() !!}
				
	</div>
	 </div>
    </div>
	</div>
	 
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<!--edit blog-->
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}" type="text/javascript" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_newblog.js') }}" type="text/javascript"></script>
@stop
