<?php
 namespace App\Http\Controllers;

use App\Http\Requests;
use App\Message;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
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


class MessageController extends Controller
{

   
public function index(){
 $message=Message::all();
		

        return response()->json($message);
		
	}


     
   
    public function create()
    {
        
    }

  
    public function store(Request $request)
    {
      $message = Validator::make($request->all(), [
            
			
			'msgtitle' => 'required',
			'message'=>'required',
			
        ]);
		if($message->fails())
            return response()->json(['message' => $message->messages()->first()],422);
			$message=\App\Message::create([
			'title'=> request('msgtitle'),
			'message'=>request('message'),
			'reciever_id'=>request('user_id'),
			'post_id'=>request('id'),
			'post_type'=>request('post_type'),
			'reciever'=>request('updated_by'),
			
			
			]);
			
			$user = JWTAuth::parseToken()->authenticate();
			
			$message->sender_id=$user->id;
			$message->sender=$user->first_name;
			//$message->post_type=$user->role;
			
        $message->save();
		
        return response()->json(['message' => 'Message sent  Successfully']);  
       

      
    }

    
    public function edit(User $user)
    {

       
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
