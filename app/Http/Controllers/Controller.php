<?php

namespace App\Http\Controllers;
use App\User;
use App\Events\DonationStatusChanged;
use App\Events\MessageStatus;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function AddMessageActivityFeed($sender_id, $reciever_id, $subject, $post_id,$link) {
					

					$read_to= '0';
					$read_by_admin='0';
					$created_at=date('Y-m-d h:i:s');
		
					$activityfeed = \App\User_Activity::create([
						   'sender_id'=> $sender_id,
						   'reciever_id'=> $reciever_id,
						   'subject'=> $subject,
						   'post_id'=> $post_id,
						    'link'=> $link,
						   'read_to'=>  intval('0'),
						   'read_by_admin'=>  intval('0'),
						   'created_on'=> date('Y-m-d h:i:s') 
					]);
					$activityfeed->save();
					$sender_user=User::where('id',$activityfeed->sender_id)->first();
					
					event(new MessageStatus($activityfeed,$sender_user));
					//  event(new DonationStatusChanged($activityfeed,$sender_user));
					 return($activityfeed);
	   
					$insertedId = $activityfeed->id;
					 return intval($insertedId);
					 
	}
	public function AddUserActivityFeed($sender_id, $reciever_id, $subject, $post_id,$link) {
					

					$read_to= '0';
					$read_by_admin='0';
					$created_at=date('Y-m-d h:i:s');
		
					$activityfeed = \App\User_Activity::create([
						   'sender_id'=> $sender_id,
						   'reciever_id'=> $reciever_id,
						   'subject'=> $subject,
						   'post_id'=> $post_id,
						    'link'=> $link,
						   'read_to'=>  intval('0'),
						   'read_by_admin'=>  intval('0'),
						   'created_on'=> date('Y-m-d h:i:s') 
					]);
					$activityfeed->save();
					$sender_user=User::where('id',$activityfeed->sender_id)->first();
					
				//	event(new MessageStatus($activityfeed,$sender_user));
					  event(new DonationStatusChanged($activityfeed,$sender_user));
					 return($activityfeed);
	   
					$insertedId = $activityfeed->id;
					 return intval($insertedId);
					 
	}
		
	
	
	
	
}
