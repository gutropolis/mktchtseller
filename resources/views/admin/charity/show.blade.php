@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    View Charity Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>

    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>User Profile</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Charity</a>
            </li>
            <li class="active">Charity Profile</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                           Charity Profile</a>
                    </li>
                   

                </ul>
                <div  class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">

                                            Charity Profile
                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-4">
                                            <div class="img-file">
                                                @if($charity->images)
                                                    <img src="{!! url('/').'/uploads/charity/'.$charity->images !!}" alt="img"
                                                         class="img-responsive"/>
                                               
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>ID</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $charity->id }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Title</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $charity->title }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td>
                                                                {{ $charity->description }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                               location
                                                            </td>
                                                            <td>
                                                                {{ $charity->location }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>year_in_business</td>
                                                            <td>
                                                                {{ $charity->year_in_business }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>start_up_year</td>
                                                            <td>
                                                                {{ $charity->start_up_year }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>business purpose</td>
                                                            <td>
                                                                {{ $charity->business_purpose}}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                {{ $charity->address }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone_number</td>
                                                            <td>
                                                                {{ $charity->phone_number }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Keyword</td>
                                                            <td>
                                                                {{ $charity->keyword }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Vision Statement</td>
                                                            <td>
                                                                {{ $charity->vision_statement }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Mission Statement</td>
                                                            <td>
                                                                {{ $charity->mission_statement }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Tags</td>
                                                            <td>
                                                                {{ $charity->tags }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>user id</td>
                                                            <td>
                                                                {{ $charity->user_id }}
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                        <tr>
                                                            <td>Charity Type</td>
                                                            <td>
                                                                {{ $charity->charity_type }}
                                                            </td>
                                                        </tr>
                                                       
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">
                                <form class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label for="inputpassword" class="col-md-3 control-label">
                                                Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                            </span>
                                                    <input type="password" id="password" placeholder="Password" name="password"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputnumber" class="col-md-3 control-label">
                                                Confirm Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                            </span>
                                                    <input type="password" id="password-confirm" placeholder="Confirm Password" name="confirm_password"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary" id="change-password">Submit
                                            </button>
                                            &nbsp;
                                            <input type="reset" class="btn btn-default" value="Reset"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

