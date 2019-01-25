<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
	class Admin_m extends Eloquent
	{
		protected $table = 'admin';
		protected $fillable = ['username','password'];
		public $timestamps = false;
		
		public function masuk($username, $password){
			$data = Admin_m::where('username','=',$username)->where('password','=',md5($password))->get();
			return $data;
		}
		
		public function ubahPassword($password){
			$data = Admin_m::where('username','=','admin')
				->update(['password'=>md5($password)]);
			return $data;
		}
	}
?>