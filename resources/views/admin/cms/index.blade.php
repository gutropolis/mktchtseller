@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('groups/title.management')
@parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>@lang('CMS Mangement')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="cms" data-size="14" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li><a href="#"> @lang('groups/title.cms')</a></li>
        <li class="active">@lang('groups/title.cms_list')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="cms" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        @lang('CMS')
                    </h4>
                    <div class="pull-right">
                    <a href="{{ route('admin.cms.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('cms.create')</a>
                    </div>
                </div>
                <br />
                <div class="panel-body">
                    
                        <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('ID')</th>
                                    
                                    <th>@lang('Title')</th>
                                    <th>@lang('Description')</th>
									<th>@lang('Meta_keyword')</th>
									<th>@lang('Meta_title')</th>
									<th>@lang('created_at')</th>
									<th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cms as $role)
								
                                <tr>
                                    <td>{!! $role->id !!}</td>
                                   
									<td>{!! $role->title!!}</td>
									<td>{!! $role->description !!}</td>
									<td>{!! $role->meta_keyword !!}</td>
									<td>{!! $role->meta_title !!}</td>
									
                                    <td>{!! $role->created_at!!}</td>
                                    <td>
                                    
                                    <a href="{{ URL::to('admin/cms/' . $role->id . '/edit' ) }}"><i class="livicon"
                                                                                                     data-name="edit"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
                                                                                                     title="@lang('cms update')"></i></a>
                                    <a href="{{ route('admin.cms.confirm-delete', $role->id) }}" data-toggle="modal"
                                       data-target="#delete_confirm"><i class="livicon" data-name="remove-alt"
                                                                        data-size="18" data-loop="true" data-c="#f56954"
                                                                        data-hc="#f56954"
                                                                        title="@lang('cms/table.delete-blog')"></i></a>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                 
                        @lang('general.noresults')
                    
                </div>
            </div>
        </div>
    </div>    <!-- row-->
</section>




@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<div class="modal fade" id="users_exists" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                @lang('groups/message.users_exists')
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});
    $(document).on("click", ".users_exists", function () {

        var group_name = $(this).data('name');
        $(".modal-header h4").text( group_name+" Group" );
    });</script>
@stop
