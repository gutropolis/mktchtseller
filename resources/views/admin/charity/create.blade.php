@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Add Charity
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Add New Charity</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">charity</a></li>
            <li class="active">Add New Charity</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Add New Charity
                        </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('admin.charity.store') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    <li><a href="#tab1" data-toggle="tab">STEP-1</a></li>
                                    <li><a href="#tab2" data-toggle="tab">STEP-2</a></li>
                                    <li><a href="#tab3" data-toggle="tab">STEP-3</a></li>
                                   
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group {{ $errors->first('title', 'has-error') }}">
                                            <label for="title" class="col-sm-2 control-label">Title *</label>
                                            <div class="col-sm-10">
                                                <input id="title" name="title" type="text"
                                                       placeholder="title" class="form-control required"
                                                       value="{!! old('title') !!}" />

                                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('description', 'has-error') }}">
                                            <label for="description" class="col-sm-2 control-label">Description *</label>
                                            <div class="col-sm-10">
                                                <input id="description" name="description" type="text" placeholder="description"
                                                       class="form-control required" value="{!! old('description') !!}"/>

                                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('location', 'has-error') }}">
                                            <label for="location" class="col-sm-2 control-label">Location *</label>
                                            <div class="col-sm-10">
                                                <input id="location" name="location" placeholder="location" type="text"
                                                       class="form-control required" value="{!! old('location') !!}"/>
                                                {!! $errors->first('location', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                       
                                    </div>
                                    <div class="tab-pane" id="tab2" disabled="disabled">
                                        


                                        <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                            <label for="pic_file" class="col-sm-2 control-label">Image</label>
                                            <div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                        <img src="http://placehold.it/200x200" alt="image">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                    <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input id="pic" name="pic_file" type="file" class="form-control"/>
                                </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('images', ':message') }}</span>
                                            </div>
                                        </div>
										
										 <div class="form-group {{ $errors->first('year_in_business', 'has-error') }}">
                                            <label for="year_in_business" class="col-sm-2 control-label">Year In Business *</label>
                                            <div class="col-sm-10">
                                                <input id="year_in_business" name="year_in_business" type="text" placeholder="year_in_business"
                                                       class="form-control required" value="{!! old('year_in_business') !!}"/>

                                                {!! $errors->first('year_in_business', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										
										
										 <h2 class="hidden">&nbsp;</h2>
											<div class="form-group  {{ $errors->first('start_up_year', 'has-error') }}">
                                            <label for="start_up_year" class="col-sm-2 control-label">Start Up Year *</label>
                                            <div class="col-sm-10">
                                                <input id="dob" name="start_up_year" type="text" class="form-control"
                                                       data-date-format="YYYY"
                                                       placeholder="yyyy"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('start_up_year', ':message') }}</span>
                                        </div>
										
										<div class="form-group {{ $errors->first('business_purpose', 'has-error') }}">
                                            <label for="business_purpose" class="col-sm-2 control-label">Business Purpose*</label>
                                            <div class="col-sm-10">
                                                <input id="business_purpose" name="business_purpose" type="text" placeholder="business_perpose"
                                                       class="form-control required" value="{!! old('business_purpose') !!}"/>

                                                {!! $errors->first('business_purpose', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
									
										
										
                                        <div class="form-group">
                                            <label for="address" class="col-sm-2 control-label">Address *</label>
                                            <div class="col-sm-10">
                        <textarea name="address" id="bio" class="form-control resize_vertical"
                                  rows="4">{!! old('address') !!}</textarea>
                                            </div>
                                            {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
									
                                    <div class="tab-pane" id="tab3" disabled="disabled">
                                       
										<div class="form-group {{ $errors->first('phone_number', 'has-error') }}">
                                            <label for="phone_number" class="col-sm-2 control-label">Phone Number*</label>
                                            <div class="col-sm-10">
                                                <input id="phone_number" name="phone_number" type="number" placeholder="phone_number"
                                                       class="form-control required" value="{!! old('phone_number') !!}"/>

                                                {!! $errors->first('phone_number', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="keyword" class="col-sm-2 control-label">Keyword*</label>
                                            <div class="col-sm-10">
                                                <input id="keyword" name="keyword" type="text" class="form-control"
                                                       value="{!! old('keyword') !!}"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('keyword', ':message') }}</span>
                                        </div>
										  <div class="form-group">
                                            <label for="vision_statement" class="col-sm-2 control-label">Vision Statement *</label>
                                            <div class="col-sm-10">
                        <textarea name="vision_statement" id="vision_statement" class="form-control resize_vertical"
                                  rows="4">{!! old('vision_statement') !!}</textarea>
                                            </div>
                                            {!! $errors->first('vision_statement', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="mission_statement" class="col-sm-2 control-label">Mission Statement *</label>
                                            <div class="col-sm-10">
                        <textarea name="mission_statement" id="mission_statement" class="form-control resize_vertical"
                                  rows="4">{!! old('mission_statement') !!}</textarea>
                                            </div>
                                            {!! $errors->first('mission_statement', '<span class="help-block">:message</span>') !!}
                                        </div>

                                        <div class="form-group">
                                            <label for="tags" class="col-sm-2 control-label">Tags*</label>
                                            <div class="col-sm-10">
                                                <input id="tags" name="tags" type="text" class="form-control"
                                                       value="{!! old('tags') !!}"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('tags', ':message') }}</span>
                                        </div>

                                        
                                    </div>
                                 
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="#">Previous</a></li>
                                        <li class="next"><a href="#">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/adduser.js') }}"></script>
   
@stop
