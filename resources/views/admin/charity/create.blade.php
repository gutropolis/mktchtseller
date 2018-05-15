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
										 <div class="form-group {{ $errors->first('charity_type', 'has-error') }}">
                                            <label for="charity_type" class="col-sm-2 control-label">Charity Type *</label>
                                            <div class="col-sm-10">
                                                <select name="charity_type" class="form-control required" required>
												
                                                <option value="">Select charity_type</option>

                                                @foreach($charityparcategory as $parent)
                                                <option value="" disabled>*{{$parent->title}}</option>

												@foreach($charitycategory as $charitycat)
                                                @if($parent->id==$charitycat->parent_id)
												<option value="{{$charitycat->title}}">--{{$charitycat->title}}</option>
												@endif
                                                   @endforeach  
                                                   @endforeach  
												</select>
                                                {!! $errors->first('charity_type', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->first('title', 'has-error') }}">
                                            <label for="title" class="col-sm-2 control-label">Title *</label>
                                            <div class="col-sm-10">
                                                <input id="title" name="title" type="text"
                                                       placeholder="title" class="form-control required"
                                                       value="{!! old('title') !!}" required/>

                                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('description', 'has-error') }}">
                                            <label for="description" class="col-sm-2 control-label">Description *</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" id="description" rows="7" name="description" type="text" placeholder="description"
                                                       class="form-control required"  required/>{!! old('description') !!}</textarea>

                                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        

                                       
                                    </div>
                                    <div class="tab-pane" id="tab2" disabled="disabled">
                                        


                                        <div class="form-group {{ $errors->first('pic_file', 'has-error') }}">
                                            <label for="pic_file" class="col-sm-2 control-label">Logo Of Organization</label>
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
                                    <input id="images" name="pic_file" type="file" class="form-control"  required/>
                                </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('images', ':message') }}</span>
                                            </div>
                                        </div>
										<div class="form-group {{ $errors->first('country', 'has-error') }}">
                                            <label for="country" class="col-sm-2 control-label">Country *</label>
                                            <div class="col-sm-10">
                                                <input id="country" name="country" type="text" placeholder="country"
                                                       class="form-control required" value="{!! old('country') !!}"  required/>

                                                {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										 <div class="form-group {{ $errors->first('state', 'has-error') }}">
                                            <label for="state" class="col-sm-2 control-label">State*</label>
                                            <div class="col-sm-10">
                                                <input id="state" name="state" type="text" placeholder="state"
                                                       class="form-control required" value="{!! old('state') !!}"  required/>

                                                {!! $errors->first('state', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										 <div class="form-group {{ $errors->first('city', 'has-error') }}">
                                            <label for="city" class="col-sm-2 control-label">City *</label>
                                            <div class="col-sm-10">
                                                <input id="city" name="city" type="text" placeholder="city"
                                                       class="form-control required" value="{!! old('city') !!}"  required/>

                                                {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
										
										
										 <h2 class="hidden">&nbsp;</h2>
											
										
										
									
										
										
                                         <div class="form-group">
                                            <label for="address" class="col-sm-2 control-label">Phone Number </label>
                                            <div class="col-sm-10">
											 <input type="text" id="area_code" placeholder="+91" name="area_code" class="login__element--box--input_areacode" required>
											  <input type="number" id="phone_number" name="phone_number" placeholder="9999999999" class="login__element--box--input_phone_number" required>
							
								  
                                            </div>
                                            {!! $errors->first('phone_number', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    </div>
									
                                    <div class="tab-pane" id="tab3" disabled="disabled">
                                       
										<div class="form-group {{ $errors->first('postal_code', 'has-error') }}">
                                            <label for="postal_code" class="col-sm-2 control-label">Postal Code*</label>
                                            <div class="col-sm-10">
                                                <input id="postal_code" name="postal_code" type="number" placeholder="postal_code"
                                                       class="form-control required" value="{!! old('postal_code') !!}" required/>

                                                {!! $errors->first('postal_code', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                       
                                         <div class="form-group">
                                            <label for="keywords" class="col-sm-2 control-label">Website *</label>
                                            <div class="col-sm-10">
                                                <input id="website" name="website" type="text" class="form-control"
                                                      placeholder="www.abc.com" value="{!! old('website') !!}" required/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('tags', ':message') }}</span>
                                        </div>
										  <div class="form-group">
                                            <label for="vision_statement" class="col-sm-2 control-label">Vision Statement *</label>
                                            <div class="col-sm-10">
                        <textarea name="vision_statement"  id="vision_statement"  placeholder="Vision_statement" required  class="form-control resize_vertical"
                                  rows="4">{!! old('vision_statement') !!}</textarea>
                                            </div>
                                            {!! $errors->first('vision_statement', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="mission_statement" class="col-sm-2 control-label">Mission Statement *</label>
                                            <div class="col-sm-10">
                        <textarea name="mission_statement" id="mission_statement" placeholder="Mission_statement" required class="form-control resize_vertical"
                                  rows="4">{!! old('mission_statement') !!}</textarea>
                                            </div>
                                            {!! $errors->first('mission_statement', '<span class="help-block">:message</span>') !!}
                                        </div>

                                        <div class="form-group">
                                            <label for="tags" class="col-sm-2 control-label">Tags*</label>
                                            <div class="col-sm-10">
                                                <input id="tags" name="tags" type="text" class="form-control"
                                                      placeholder="Tags" value="{!! old('tags') !!}" required/>
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
<script>
      // This example requires the Geometry library. Include the libraries=geometry
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=geometry">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 24.886, lng: -70.269},
          zoom: 5,
        });

        var triangleCoords = [
          {lat: 25.774, lng: -80.19},
          {lat: 18.466, lng: -66.118},
          {lat: 32.321, lng: -64.757}
        ];

        var bermudaTriangle = new google.maps.Polygon({paths: triangleCoords});

        google.maps.event.addListener(map, 'click', function(e) {
          var resultColor =
              google.maps.geometry.poly.containsLocation(e.latLng, bermudaTriangle) ?
              'blue' :
              'red';

          var resultPath =
              google.maps.geometry.poly.containsLocation(e.latLng, bermudaTriangle) ?
              // A triangle.
              "m 0 -1 l 1 2 -2 0 z" :
              google.maps.SymbolPath.CIRCLE;

          new google.maps.Marker({
            position: e.latLng,
            map: map,
            icon: {
              path: resultPath,
              fillColor: resultColor,
              fillOpacity: .2,
              strokeColor: 'white',
              strokeWeight: .5,
              scale: 10
            }
          });
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuEAajyWgD8-WPkSdpjGjvILZR6pgI9Go&libraries=geometry&callback=initMap"
         async defer></script>
  </body>
</html>