<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Inbox;
use App\Message;
use App\User;
use App\User_Activity;
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
	class InboxController extends Controller
	{
	public function index()
		{
			$inbox=Inbox::pluck('reciever_id'); 
			return response()->json($inbox);
		}
	public function fetch()
		{
			$user = JWTAuth::parseToken()->authenticate();
			$inboxes=Inbox::where('reciever_id',$user->id)->orwhere('sender_id',$user->id)->orderBy('updated_at','asc')->get();
			$msgInbox=array();
			foreach($inboxes as $inbox)
			{ 
			//return($inbox);
				$block = array();
				if(intval($inbox->id) > 0){
				$block= Message::where('inbox_id', $inbox->id)->groupBy('inbox_id')->first();
				$user = JWTAuth::parseToken()->authenticate();
				$receiver_userid=0;
				if($user->id==$inbox->reciever_id)
				{
				$receiver_userid=$inbox->sender_id;
				}
				else
				{
				$receiver_userid=$inbox->reciever_id;
				}
				$user=User::where('id',$receiver_userid)->get();
				//return($block);
				//var_dump($block);exit;
				if(count($block) > 0 ){
				$userArr = array();
				$userArr['sender_detail']=$user;
				$inbox['sender_detail']=$user;
				array_push($msgInbox,$inbox);
				}
				}
			} 
	//return($msgInbox->id);
		return response()->json($msgInbox); 
	}
	public  function detail(Request $request,$id)
	{
		$user = JWTAuth::parseToken()->authenticate();
		//update receiver_read message
		$update=Message::where('inbox_id',$id)->where('reciever_id',$user->id)->update(['reciever_read' => 1 ]);
		
		
		
		$messages=Message::where('inbox_id',$id)->get();
		$msgInbox=array();
		foreach($messages as $message)
		{
			$user=User::where('id',$message->sender_id)->get();
			$userArr = array();
			$userArr['sender_detail']=$user;
			$message['sender_detail']=$user;
			array_push($msgInbox,$message);
		}
		return response()->json($msgInbox);
	}
	public  function senderinfo(Request $request,$id)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$messages=Message::where('inbox_id',$id)->get();
		
		foreach($messages as $message)
		{
				$receiver_userid=0;
			if($user->id==$message->reciever_id)
				{
				$receiver_userid=$message->sender_id;
				}
				else
				{
				$receiver_userid=$message->reciever_id;
				}
				
			$user=User::where('id',$receiver_userid)->get();
			
			return response()->json($user);
			
			
		}
		
	}
	public function store(Request $request)
	{
		$validation = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
            
        ]);
        if($validation->fails())
        	return response()->json(['message' => $validation->messages()->first()],422);
		
		
		$post_id=request('post_id');
		$post_type=request('post_type');
		$user = JWTAuth::parseToken()->authenticate();
		//$inbox->id=0;
		$inboxmsg=Inbox::where('sender_id',$user->id)->orwhere('reciever_id',$user->id)->where('post_id',$post_id)->where('post_type',$post_type)->first();
		if ($inboxmsg != null) {
		$inbox=Inbox::where('sender_id',$user->id)->orwhere('reciever_id',$user->id)->where('post_id',$post_id)->where('post_type',$post_type)->first();
		if(count($inbox->id) > 0)
		{
		$message=\App\Message::create([
		$inbox_receiver_id=intval($inbox->reciever_id),
		$inbox_sender_id=intval($inbox->sender_id),
		/*if($user->id == $inbox_sender_id){
		'reciever_id'=>$inbox_receiver_id,
		'sender_id' => $user->id,
		}*/
		'message'=>request('message'),
		'reciever_id'=>$inbox_receiver_id,
		'sender_id' => $inbox_sender_id,
		'inbox_id' => $inbox->id,
		]);
		}
	}	
	else{
		$message=\App\Inbox::create([
		'subject'=>request('title'),
		'reciever_id'=>request('user_id'),
		'post_id'=>request('id'),
		'post_type'=>request('post_type'),
		'reciever'=>request('updated_by'),
		'sender_id' => $user->id,
		'status' => '1',
		
		]);
		$message->save();
		$insertedId = $message->id;
		$message=\App\Message::create([
		$inbox_receiver_id=intval(request('user_id')),
		$inbox_sender_id=intval($user->id),
		/*if($user->id == $inbox_sender_id){
		'reciever_id'=>$inbox_receiver_id,
		'sender_id' => $user->id,
		}*/
		'message'=>request('title'),
		'reciever_id'=>$inbox_receiver_id,
		'sender_id' => $inbox_sender_id,
		'inbox_id' => $insertedId,
		'receiver_read' => '0',
		]);
		$admin_email=Settings::first();
		
		
		$sender_user=User::where('id',$message->sender_id)->first();
		$reciever_user=User::where('id',$message->reciever_id)->first();
		
		$admin_email=Settings::pluck('admin_email');
		$admin=$admin_email[0];
		
		 $data = array('message'=>$message, 'sender_user'=>$sender_user,'reciever_user'=>$reciever_user);
		 
		Mail::send('emails.message', $data , function($message) use($admin)
		{
			$message->to($admin)->subject('Request For Communication!');
		});
		 
		Mail::send('emails.message', $data , function($message) use ($reciever_user)
		{
			$message->to($reciever_user->email)->subject('Communicate!');
		});
		
	}
	
		return response()->json(['message' => 'Message sent  Successfully']);  
	}
	
		public function message_notification()
	{
		
		$user = JWTAuth::parseToken()->authenticate();
		if(intval($user->id)> 0 ){
				
		$query=Message::select('gs_message.created_at','gs_message.reciever_id','users.role','gs_message.inbox_id','gs_message.sender_id','users.first_name','users.last_name','users.avatar')->join('users','gs_message.sender_id','=','users.id')->where('gs_message.reciever_read','0')->where('gs_message.reciever_id',$user->id)->get();
		
			return($query);
		}else{
			return 0;
		}
	}
		public function user_notification()
	{
		
	/*	select 
`gs_user_activity_feed`.`created_on`, 
`gs_user_activity_feed`.`from`, 
`gs_user_activity_feed`.`to`, 
`gs_user_activity_feed`.`subject`, 
`gs_user_activity_feed`.`link`,
`gs_user_activity_feed`.`read_to`,
`gs_user_activity_feed`.`post_id`,
`users`.`first_name` 
from `gs_user_activity_feed` 
inner join `users` 
on `gs_user_activity_feed`.`from` = `users`.`id` 
where `gs_user_activity_feed`.`read_to` = 0 and `gs_user_activity_feed`.`to` = '3'*/
		
		
		
		$user = JWTAuth::parseToken()->authenticate();
		if(intval($user->id)> 0 ){
				
		$query=User_Activity::select('gs_user_activity_feed.created_at','gs_user_activity_feed.from','gs_user_activity_feed.link','gs_user_activity_feed.read_to','gs_user_activity_feed.post_id','users.role','gs_user_activity_feed.to','gs_user_activity_feed.subject','users.first_name','users.last_name','users.avatar')->join('users','gs_user_activity_feed.from','=','users.id')->where('gs_user_activity_feed.read_to','0')->where('gs_user_activity_feed.to',$user->id)->get();
		
			return($query);
		}else{
			return 0;
		}
	}
	
	 
	
	
	
	
	
	public function message(Request $request,$id)
	{
		$user = JWTAuth::parseToken()->authenticate();
		$inboxes=Inbox::get();
		foreach($inboxes as $inbox)
		{
		$receiver_userid=0;
		if($user->id==$inbox->reciever_id)
		{
		$receiver_userid=$inbox->sender_id;
		}
		else
		{
		$receiver_userid=$inbox->reciever_id;
		}
		}
		$message=\App\Message::create([
		'message'=>request('message'),
		'sender_id' => $user->id,
		'reciever_id' => $receiver_userid,
		'inbox_id' => $id,
		]);
		$user_reciever=User::where('id', $receiver_userid)->get();
		
		
		 broadcast(new MessageSent($user, $message,$user_reciever));
		return response()->json(['message' => 'Message sent  Successfully']);
	}
	public function user_id()
	{
		$user = JWTAuth::parseToken()->authenticate();
		return response()->json($user); 
	}
	
	public function unread_message()
	{
			$user = JWTAuth::parseToken()->authenticate();
			$inboxes=Inbox::where('reciever_id',$user->id)->orwhere('status','1')->count();
			
			
			return response()->json($inboxes); 
	}
	
	
	
	public function unread()
	{
			$user = JWTAuth::parseToken()->authenticate();
			$inboxes=Inbox::where('reciever_id',$user->id)->orwhere('sender_id',$user->id)->get();
			foreach($inboxes as $inbox)
			{
			$query=Message::where('inbox_id',$inbox->id)->where('reciever_read',0)->where('reciever_id',$user->id)->count();
			}
			
			return response()->json($query); 
	}
	 public function count()
	 {
		 $user = JWTAuth::parseToken()->authenticate();
		 $count=Inbox::where('status','1')->where('reciever_id',$user->id)->count();
		
		return($count);
		 
		 
	 }	
	 public function read($id)
	 {
		 	//$update=Message::where('inbox_id',$id)->where('reciever_id',$user->id)->update(['reciever_read' => 1 ]);
			$update=Inbox::where('id',$id)->update(['status'=> 0]);
			return($update);
		 
	 }	
	 
	
		 
	 
	public function getModalDelete($id)
	{
	}
	public function destroy($id)
	{
	}
	public function getRestore($id)
	{
	}
	public function show($id)
	{
	}
}