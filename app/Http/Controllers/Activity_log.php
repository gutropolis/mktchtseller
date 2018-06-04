<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Inbox;
use App\Message;
use App\User;
use App\User_Activity;
use App\Sellerproduct;
use App\Charity;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\Events\MessageSent;
use App\Events\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Sentinel;
use App\Settings;
use URL;
use View;
use Yajra\DataTables\DataTables;
use Validator;
Use App\Mail\Restore;
use Tymon\JWTAuth\Facades\JWTAuth;
use stdClass;
	class Activity_log extends Controller
	{
		public function sender_activity()
		{
			$user = JWTAuth::parseToken()->authenticate();
			
		
	
			
				$activity=User_Activity::select('gs_user_activity_feed.created_at','gs_user_activity_feed.post_type','gs_charity_organisation.images','gs_user_activity_feed.subject','users.first_name','users.last_name','gs_charity_organisation.title')->join('gs_charity_organisation','gs_user_activity_feed.post_id','=','gs_charity_organisation.id')->join('users','gs_user_activity_feed.reciever_id','=','users.id')->where('gs_user_activity_feed.sender_id', '=',$user->id)->latest()->get();
				
			
		
		
			
			return($activity);
		}
		
	}