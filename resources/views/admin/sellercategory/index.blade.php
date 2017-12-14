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
    <h1>@lang('Add Seller Category')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">@lang('Category')</a>
        </li>
        <li class="active">@lang('Add category ')</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            <!-- errors -->
            {!! Form::open(array('url' => URL::to('admin/sellercategory'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                 <div class="row">
                    <div class="col-sm-8">
					
						 <div class="form-group {{ $errors->first('parent_id', 'has-error') }}">
                            <label for="parent_id" class="">Parent Category *</label>
                            <select name="parent_id" class="form-control">
							<option value="0">Select Category...
							@foreach($sellercategories as $cat)
							<option value="{{$cat->parent_id}}">{{$cat->title}}</option>
							</option>
							@endforeach
							</select>
                            
                        </div>
					
                        <div class="form-group {{ $errors->first('title', 'has-error') }}">
                          <input type="text" name="title" placeholder="Title" class="form-control" value="{!! old('title') !!}"/> 
						   <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                        </div>
                          <div class="form-group ">
                        <textarea name="description" id="description" class="form-control resize_vertical" placeholder="Description"
                                  rows="4">{!! old('description') !!}</textarea>
								   <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                                            </div>
                 
                       
                       
                       
                       
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">@lang('publish')</button>
                            <a href="{!! URL::to('admin/charitycategory/index') !!}"
                               class="btn btn-danger">@lang('discard')</a>
                        </div>
                    </div>
                    <!-- /.col-sm-4 -->
                {!! Form::close() !!}
				
				
				
			
				
        
    </div>
	<div class="panel panel-primary ">
	 <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left">
                    @lang('Seller Category List')
                </h4>
               </div>
           
            
			
	    <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="filters">
						<th>@lang('id')</th>
                            <th>@lang('Title')</th>
                            <th>@lang('Description')</th>
							<th>@lang('Created_at')</th>
							<th>@lang('parent_id')</th>
							<th>@lang('Action')</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                 
                       	@foreach($sellercategories as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->title }}</td>
                                <td>{{ $cat->description }}</td>
								
                                <td>{{ $cat->created_at }}</td>
								<td>{{$cat->parent_id}}</td>
								 
								 <td>
                                    <a href="{{ URL::to('admin/sellercategory/' . $cat->id ) }}"></a>
                                    <a href="{{ URL::to('admin/sellercategory/' . $cat->id . '/edit' ) }}"><i class="livicon"
                                                                                                     data-name="edit"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
                                                                                                     title="@lang('seller/table.update-seller')"></i></a>
                                    <a href="{{ route('admin.sellercategory.delete', $cat->id) }}"><i class="livicon" data-name="remove-alt"
                                                                        data-size="18" data-loop="true" data-c="#f56954"
                                                                        data-hc="#f56954"
                                                                        title="@lang('charitycategories/table.delete-blog')"></i></a>
                                </td>
                                
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
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
<!--edit 
-->
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}" type="text/javascript" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_newblog.js') }}" type="text/javascript"></script>
@stop
