@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Settings
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
        <h1>Settings</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">charity</a></li>
            <li class="active">Settings</li>
        </ol>
    </section>
<!--section ends-->
 <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Settings
                        </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('admin.settings.store') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                              
                                <div class="tab-content">
                                   
                                        <h2 class="hidden">&nbsp;</h2>
										
                                        <div class="form-group {{ $errors->first('site_title', 'has-error') }}">
                                            <label for="site_title" class="col-sm-2 control-label">WebSite Title *</label>
                                            <div class="col-sm-10">
                                                <input id="site_title" name="site_title" type="text"
                                                       placeholder="WebSite Title" class="form-control required"
                                                       value="{!! old('site_title',$settings->site_title) !!}" required />

                                                {!! $errors->first('site_title', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('description', 'has-error') }}">
                                            <label for="description" class="col-sm-2 control-label">Description *</label>
                                            <div class="col-sm-10">
                                                <input id="description" name="description" type="text" placeholder="description"
                                                       class="form-control required" value="{!! old('description',$settings->description) !!}" required/>

                                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('keyword', 'has-error') }}">
                                            <label for="keyword" class="col-sm-2 control-label">Keyword *</label>
                                            <div class="col-sm-10">
                                                <input id="keyword" name="keyword" type="text" placeholder="keyword"
                                                       class="form-control required" value="{!! old('keyword',$settings->keyword) !!}" required />

                                                {!! $errors->first('keyword', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                       
                                    </div>
                                   

										
										 <div class="form-group {{ $errors->first('site_url', 'has-error') }}">
                                            <label for="site_url" class="col-sm-2 control-label">WebSite Url *</label>
                                            <div class="col-sm-10">
                                                <input id="site_url" name="site_url" type="text" placeholder="Website Url"
                                                       class="form-control required" value="{!! old('site_url',$settings->site_url) !!}"  required/>

                                                {!! $errors->first('site_url', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										
										
										 
											    <div class="form-group {{ $errors->first('image', 'has-error') }}">
                                                    <label for="image" class="col-sm-2 control-label">WebSite Logo *</label>
                                                    <div class="col-sm-10">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                @if($settings->site_logo)
                                                                    <img src="{!! url('/').'/uploads/charity/'.$settings->site_logo !!}" alt="logo"
                                                                         class="img-responsive"/>
                                                               
                                                                @endif
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                            <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select Logo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="image" name="image" type="file" 
                                                               class="form-control" />
                                                    </span>
                                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput" style="color: black !important;">Remove</a>
                                                            </div>
                                                        </div>
                                                        {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
                                                    </div>
                                                </div>
										
										<div class="form-group {{ $errors->first('base_url', 'has-error') }}">
                                            <label for="base_url" class="col-sm-2 control-label">Base Url*</label>
                                            <div class="col-sm-10">
                                                <input id="base_url" name="base_url" type="text" placeholder="base_url"
                                                       class="form-control required" value="{!! old('base_url',$settings->base_url) !!}"required />

                                                {!! $errors->first('base_url', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
									
										
										
                                       <div class="form-group {{ $errors->first('admin_email', 'has-error') }}">
                                            <label for="admin_email" class="col-sm-2 control-label">Admin Email*</label>
                                            <div class="col-sm-10">
                                                <input id="admin_email" name="admin_email" type="text" placeholder="admin_email"
                                                       class="form-control required" value="{!! old('admin_email',$settings->admin_email) !!}" required/>

                                                {!! $errors->first('admin_email', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                    
									
                                   
                                      <div class="form-group {{ $errors->first('upload_path', 'has-error') }}">
                                            <label for="upload_path" class="col-sm-2 control-label">Upload Path*</label>
                                            <div class="col-sm-10">
                                                <input id="upload_path" name="upload_path" type="text" placeholder="upload_path"
                                                       class="form-control required" value="{!! old('upload_path',$settings->upload_path) !!}" required/>

                                                {!! $errors->first('upload_path', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                       
                                       
										 
                                      <div class="form-group {{ $errors->first('smtp_server', 'has-error') }}">
                                            <label for="smtp_server" class="col-sm-2 control-label">Smtp Server*</label>
                                            <div class="col-sm-10">
                                                <input id="smtp_server" name="smtp_server" type="text" placeholder="smtp_server"
                                                       class="form-control required" value="{!! old('smtp_server',$settings->smtp_server) !!}" required/>

                                                {!! $errors->first('smtp_server', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('smtp_user', 'has-error') }}">
                                            <label for="smtp_user" class="col-sm-2 control-label">Smtp User*</label>
                                            <div class="col-sm-10">
                                                <input id="smtp_user" name="smtp_user" type="text" placeholder="smtp_user"
                                                       class="form-control required" value="{!! old('smtp_user',$settings->smtp_user) !!}"required/>

                                                {!! $errors->first('smtp_user', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                         <div class="form-group {{ $errors->first('smtp_password', 'has-error') }}">
                                            <label for="smtp_password" class="col-sm-2 control-label">Smtp Password*</label>
                                            <div class="col-sm-10">
                                                <input id="smtp_password" name="smtp_password" type="text" placeholder="smtp_password"
                                                       class="form-control required" value="{!! old('smtp_password',$settings->smtp_password) !!}"required />

                                                {!! $errors->first('smtp_password', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										  <div class="form-group {{ $errors->first('smtp_host', 'has-error') }}">
                                            <label for="smtp_host" class="col-sm-2 control-label">Smtp Host*</label>
                                            <div class="col-sm-10">
                                                <input id="smtp_host" name="smtp_host" type="text" placeholder="smtp_host"
                                                       class="form-control required" value="{!! old('smtp_host',$settings->smtp_host) !!}" required />

                                                {!! $errors->first('smtp_host', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										 <ul class="pager wizard">
                                       
                                        <li >
										<input type="submit" class="btn btn-success" value="Update"/></li>
                                    </ul>
                                    </div>
                                 
                                   
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
<!-- begining of page level js -->
<!--edit blog-->
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}" type="text/javascript" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_newblog.js') }}" type="text/javascript"></script>
@stop
