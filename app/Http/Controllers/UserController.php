<?php
 namespace App\Http\Controllers;

use App\Http\Requests;
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


class UserController extends Controller
{
 protected $avatar_path = 'images/user/';
    /**
     * Show a list of all the users.
     *
     * @return View
     */
public function index(){
  $users=User::all();
		

        return response()->json($users);
		
	}


 
   public function updateAvatar(Request $request){
        $validation = Validator::make($request->all(), [
            'avatar' => 'required|image'
        ]);

        if ($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);

        $user = JWTAuth::parseToken()->authenticate();
   

        if($user->avatar && \File::exists($this->avatar_path.$user->avatar))
            \File::delete($this->avatar_path.$user->avatar);

        $extension = $request->file('avatar')->getClientOriginalExtension();
        $filename = uniqid();
        $file = $request->file('avatar')->move($this->avatar_path, $filename.".".$extension);
        $img = \Image::make($this->avatar_path.$filename.".".$extension);
        $img->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($this->avatar_path.$filename.".".$extension);
        $user->avatar = $filename.".".$extension;
        $user->save();

        return response()->json(['message' => 'Avatar updated!','profile' => $user]);
    }
	
	public function role(Request $request)
	{
		 $user = JWTAuth::parseToken()->authenticate();
		$user->role = request('role');
		$user->save();
		return response()->json(['message' => 'Role Selected']);
	}
	
	
	
	

    public function removeAvatar(Request $request){

        $user = JWTAuth::parseToken()->authenticate();

 
        if(!$user->avatar)
            return response()->json(['message' => 'No avatar uploaded!'],422);

        if(\File::exists($this->avatar_path.$user->avatar))
            \File::delete($this->avatar_path.$user->avatar);

        $user->avatar = null;
        $user->save();

        return response()->json(['message' => 'Avatar removed!']);
    }

      public function updateProfile(Request $request){

        $validation = Validator::make($request->all(),[
			
        ]);

        if($validation->fails())
            return response()->json(['message' => $validation->messages()->first()],422);

        $user = JWTAuth::parseToken()->authenticate();
         $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->dob = request('dob');
        $user->gender = request('gender');
		$user->address= request('address');
		$user->postal= request('postal');
		$user->bio = request('bio');
	
      
		  $user->save();
        return response()->json(['message' => 'Your profile has been updated!','user' => $user]);
    }
    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.users.create', compact('groups', 'countries'));
    }

    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(Request $request)
    {
        $data = new stdClass();
        //upload image
        if ($file = $request->file('pic_file')) {
            $extension = $file->extension()?: 'png';
            $destinationPath = public_path() . '/uploads/users/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic'] = $safeName;
        }
        //check whether use should be activated by default or not
        $activate = $request->get('activate') ? true : false;

        try {
            // Register the user
            $user = Sentinel::register($request->except('_token', 'password_confirm', 'group', 'activate', 'pic_file'), $activate);

            //add user to 'User' group
            $role = Sentinel::findRoleById($request->get('group'));
            if ($role) {
                $role->users()->attach($user);
            }
            //check for activation and send activation mail if not activated by default
            if (!$request->get('activate')) {
                // Data to be used on the email view
                $data->user_name =$user->first_name .' '. $user->last_name;
                $data->activationUrl = URL::route('activate', [$user->id, Activation::create($user)->code]);

                // Send the activation code through email
                Mail::to($user->email)
                    ->send(new Restore($data));
            }
            // Activity log for New user create
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('New User Created by '.Sentinel::getUser()->full_name);
            // Redirect to the home page with success menu
            return Redirect::route('admin.users.index')->with('success', trans('users/message.success.create'));

        } catch (LoginRequiredException $e) {
            $error = trans('admin/users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = trans('admin/users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = trans('admin/users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit(User $user)
    {

        // Get this user groups
        $userRoles = $user->getRoles()->pluck('name', 'id')->all();
        // Get a list of all the available groups
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($user);

        $countries = $this->countries;

        // Show the page
        return view('admin.users.edit', compact('user', 'roles', 'userRoles', 'countries', 'status'));
    }

    /**
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
   
    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedUsers()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_users', compact('users'));
    }


    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id)
    {
        $model = 'users';
        $confirm_route = $error = null;
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = trans('users/message.error.delete');

                return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.users.delete', ['id' => $user->id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id)
    {
        try {
            // Get user information
            $user = Sentinel::findById($id);
            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = trans('admin/users/message.error.delete');
                // Redirect to the user management page
                return Redirect::route('admin.users.index')->with('error', $error);
            }
            // Delete the user
            //to allow soft deleted, we are performing query on users model instead of Sentinel model
            User::destroy($id);
            Activation::where('user_id',$user->id)->delete();
            // Prepare the success message
            $success = trans('users/message.success.delete');
            //Activity log for user delete
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User deleted by '.Sentinel::getUser()->full_name);
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('admin/users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
    }

    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id)
    {
        $data = new stdClass();
        try {
            // Get user information
            $user = User::withTrashed()->find($id);
            info($user);
            // Restore the user
            $user->restore();
            // create activation record for user and send mail with activation link
            $data->user_name = $user->first_name .' '. $user->last_name;
            $data->activationUrl = URL::route('activate', [$user->id, Activation::create($user)->code]);
            // Send the activation code through email
            Mail::to($user->email)
                ->send(new Restore($data));
            // Prepare the success message
            $success = trans('users/message.success.restored');
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User restored by '.Sentinel::getUser()->full_name);
            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('error', $error);
        }
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            // Get the user information
            $user = Sentinel::findUserById($id);
            //get country name
            if ($user->country) {
                $user->country = $this->countries[$user->country];
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = trans('users/message.user_not_found', compact('id'));
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
        // Show the page
        return view('admin.users.show', compact('user'));

    }

    public function passwordreset( Request $request)
    {
        $id = $request->id;
        $user = Sentinel::findUserById($id);
        $password = $request->get('password');
        $user->password = Hash::make($password);
        $user->save();
    }

    public function lockscreen($id){

        if (Sentinel::check()) {
            $user = Sentinel::findUserById($id);
            return view('admin.lockscreen',compact('user'));
        }
        return view('admin.login');
    }

    public function postLockscreen(Request $request){
        $password = Sentinel::getUser()->password;
        if(Hash::check($request->password,$password)){
            return 'success';
        } else{
            return 'error';
        }
    }
}
