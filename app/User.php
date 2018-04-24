<?php namespace App;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable {
	use Notifiable;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'users';

	/**
	 * The attributes to be fillable from the model.
	 *
	 * A dirty hack to allow fields to be fillable by calling empty fillable array
	 *
	 * @var array
	 */
    use Taggable;

	protected $fillable =['id','first_name', 'last_name', 'email', 'status','role','phone','avatar', 'password'];
	protected $guarded = ['id'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	protected $casts = [
    'settings' => 'array'
];

	/**
	* To allow soft deletes
	*/
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = ['full_name'];
    public function getFullNameAttribute()
    {
        return str_limit($this->first_name . ' ' . $this->last_name, 30);
    }
    public function country() {
        return $this->belongsTo( Country::class );
    }
public function profile()
    {
        return $this->hasOne('App\Profile');
    }
	public function author()
		{
			return $this->belongsTo('user_id','user_name');
		}
		public function messages()
{
  return $this->hasMany(Message::class);
}
}
