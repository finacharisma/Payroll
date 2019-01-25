<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
	/*class Login_m extends CI_Model {
		public function masuk($username, $password){
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where('username',$username);
			$this->db->where('password',$password);
			return $this->db->get();
		}
	}*/
	class Login_m extends Eloquent
	{
		protected $table = 'admin';
		protected $fillable = ['username','password'];
		public $timestamps = false;
		
		public function masuk($username, $password){
			$data = Login_m::where('username','=',$username)->where('password','=',md5($password))->get();
			return $data;
		}
	}
?>