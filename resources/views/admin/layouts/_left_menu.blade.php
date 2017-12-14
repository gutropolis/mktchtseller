<ul id="menu" class="page-sidebar-menu">

  <li {!! (Request::is('admin/activity_log') ? 'class="active"' : '') !!}>
        <a href="{{  URL::to('admin/activity_log') }}">
            <i class="livicon" data-name="eye-open" data-size="18" data-c="#F89A14" data-hc="#F89A14"
               data-loop="true"></i>
            Activity Log
        </a>
    </li>
	<li {!! (Request::is('admin/inbox') || Request::is('admin/compose') || Request::is('admin/view_mail') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="mail" data-size="18" data-c="#67C5DF" data-hc="#67C5DF"
               data-loop="true"></i>
            <span class="title">Email</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/inbox') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/inbox') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Inbox
                </a>
            </li>
            <li {!! (Request::is('admin/compose') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/compose') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Compose
                </a>
            </li>
            <li {!! (Request::is('admin/view_mail') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/view_mail') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Single Mail
                </a>
            </li>
        </ul>
    </li>
   

   
 
    <li {!! (Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/user_profile') || Request::is('admin/users/*') || Request::is('admin/deleted_users') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Users</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/users') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Users
                </a>
            </li>
            <li {!! (Request::is('admin/users/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/users/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New User
                </a>
            </li>
            <li {!! ((Request::is('admin/users/*')) && !(Request::is('admin/users/create')) ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::route('admin.users.show',Sentinel::getUser()->id) }}">
                    <i class="fa fa-angle-double-right"></i>
                    View Profile
                </a>
            </li>
            <li {!! (Request::is('admin/deleted_users') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/deleted_users') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Deleted Users
                </a>
            </li>
        </ul>
		</li>
		 <li {!! (Request::is('admin/charity') || Request::is('admin/charity/create') || Request::is('admin/user_profile') || Request::is('admin/charity/*') || Request::is('admin/deleted_users') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="charity" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Charity</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
		 <li {!! (Request::is('admin/charitycategory') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/charitycategory') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Category
                </a>
            </li>
            <li {!! (Request::is('admin/charity') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/charity') }}">
                    <i class="fa fa-angle-double-right"></i>
                    charity
                </a>
            </li>
            <li {!! (Request::is('admin/charity/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/charity/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New charity
                </a>
            </li>
            <li {!! ((Request::is('admin/charity/*')) && !(Request::is('admin/charity/create')) ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::route('admin.charity.show',Sentinel::getUser()->id) }}">
                    <i class="fa fa-angle-double-right"></i>
                    View cahrity Profile
                </a>
            </li>

	<li {!! (Request::is('admin/seller') || Request::is('admin/seller/create') || Request::is('admin/seller_profile') || Request::is('admin/seller/*') || Request::is('admin/deleted_seller') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="seller" data-size="18" data-c="#6CC66C" data-hc="#6CC66C"
               data-loop="true"></i>
            <span class="title">Seller</span>
            <span class="fa arrow"></span>
        </a>
		 <ul class="sub-menu">
            <li {!! (Request::is('admin/sellercategory') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/sellercategory') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Seller Category
                </a>
            </li>
			
			
			
			<li {!! (Request::is('admin/seller') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/seller') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Seller
                </a>
            </li>
            <li {!! (Request::is('admin/seller/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/seller/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Seller
                </a>
            </li>
            <li {!! ((Request::is('admin/seller/*')) && !(Request::is('admin/seller/create')) ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::route('admin.seller.show',Sentinel::getUser()) }}">
                    <i class="fa fa-angle-double-right"></i>
                    View Profile
                </a>
            </li>
            <li {!! (Request::is('admin/deleted_seller') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/deleted_seller') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Deleted Seller
                </a>
            </li>
        </ul>
    </li>
    <li {!! (Request::is('admin/groups') || Request::is('admin/groups/create') || Request::is('admin/groups/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA"
               data-loop="true"></i>
            <span class="title">Groups</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/groups') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/groups') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Group List
                </a>
            </li>
            <li {!! (Request::is('admin/groups/create') ? 'class="active" id="active"' : '') !!}>
                <a href="{{ URL::to('admin/groups/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Group
                </a>
            </li>
        </ul>
    </li>
	<li {!! ((Request::is('admin/blogcategory') || Request::is('admin/blogcategory/create') || Request::is('admin/blog') ||  Request::is('admin/blog/create')) || Request::is('admin/blog/*') || Request::is('admin/blogcategory/*') ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="comment" data-c="#F89A14" data-hc="#F89A14" data-size="18"
               data-loop="true"></i>
            <span class="title">Blog</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/blogcategory') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/blogcategory') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Blog Category List
                </a>
            </li>
            <li {!! (Request::is('admin/blog') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/blog') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Blog List
                </a>
            </li>
            <li {!! (Request::is('admin/blog/create') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/blog/create') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Add New Blog
                </a>
            </li>
        </ul>
    </li>
    <li {!! (Request::is('admin/news') || Request::is('admin/news_item')  ? 'class="active"' : '') !!}>
        <a href="#">
            <i class="livicon" data-name="move" data-c="#ef6f6c" data-hc="#ef6f6c" data-size="18"
               data-loop="true"></i>
            <span class="title">News</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/news') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/news') }}">
                    <i class="fa fa-angle-double-right"></i>
                    News
                </a>
            </li>
            <li {!! (Request::is('admin/news_item') ? 'class="active"' : '') !!}>
                <a href="{{ URL::to('admin/news_item') }}">
                    <i class="fa fa-angle-double-right"></i>
                    News Details
                </a>
            </li>
        </ul>
    </li>
   
    
    
    
    
    
    <!-- Menus generated by CRUD generator -->
    @include('admin/layouts/menu')
</ul>