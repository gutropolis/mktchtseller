<?php

use Faker\Factory;
use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends DatabaseSeeder {

	public function run()
	{
		DB::table('users')->truncate(); // Using truncate function so all info will be cleared when re-seeding.
		DB::table('roles')->truncate();
		DB::table('role_users')->truncate();
		DB::table('activations')->truncate();
		DB::table('gs_setting')->truncate();
		
		$gs_setting=[
		'site_title'=>'abc',
		'description'=>'charity description',
		'keyword'=>'charity keyword',
		'site_url'=>'localhost:8000/admin/',
		'site_logo'=>'logo.png',
		'base_url'=>'www.charityseller.com',
		'admin_email'=>'admin@admin.com',
		'upload_path'=>'public/charity/',
		'smtp_server'=>'192.168.1.1',
		'smtp_user'=>'admin',
		'smtp_password'=>'admin@123',
		'smtp_host'=>'local'
		
		];
		
		DB::table('gs_setting')->insert($gs_setting);
		
		
		
		$admin = Sentinel::registerAndActivate(array(
			'email'       => 'admin@admin.com',
			'password'    => "admin",
			'first_name'  => 'John',
			'last_name'   => 'Doe',
		));

		$adminRole = Sentinel::getRoleRepository()->createModel()->create([
			'name' => 'Admin',
			'slug' => 'admin',
			'permissions' => array('admin' => 1),
		]);

        $userRole = Sentinel::getRoleRepository()->createModel()->create([
			'name'  => 'Charity',
			'slug'  => 'user',
		]);
		 $userRole = Sentinel::getRoleRepository()->createModel()->create([
			'name'  => 'Seller',
			'slug'  => 'user',
		]);
		

		$admin->roles()->attach($adminRole);

		$this->command->info('Admin User created with username admin@admin.com and password admin');
	}

}