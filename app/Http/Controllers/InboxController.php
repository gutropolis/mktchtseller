<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Inbox;
use App\Message;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Sentinel;
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
		]);
	}
		
		return response()->json(['message' => 'Message sent  Successfully']);  
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
		 broadcast(new MessageSent($user, $message))->toOthers();
		return response()->json(['message' => 'Message sent  Successfully']);
	}
	public function user_id()
	{
		$user = JWTAuth::parseToken()->authenticate();
		return response()->json($user); 
	}
	public function getDeletedUsers()
	{
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