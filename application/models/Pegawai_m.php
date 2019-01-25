<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Pegawai_m extends Eloquent
{
	protected $table = 'pegawai';
	protected $primaryKey = 'idPegawai';
	protected $fillable = ['idPegawai', 'username', 'password','namaPegawai','tahunMasuk', 'telepon', 'bonusBeras', 'bonusMasaKerja', 'tipePegawai'];
	//protected $guarded = ['idr', 'password'];
	public $timestamps = false;
	
	public function Hutang_m()
	{
		return $this->hasMany('Hutang_m','idPegawai');
	}
	
	public function PegawaiKandang_m()
	{
		return $this->hasOne('PegawaiKandang_m','idPegawai');
	}
	
	public function PegawaiAmpas_m()
	{
		return $this->hasOne('PegawaiAmpas_m','idPegawai');
	}
	
	public function masuk($username, $password){
		$data = Pegawai_m::where('username','=',$username)->where('password','=',$password)->get();
		return $data;
	}
	
	public function getAllPegawai()
    {
        $data = Pegawai_m::all();
        return $data;
    }
	
	public function getAllPKandang()
    {
        $data = Pegawai_m::where('tipePegawai','Kandang')->get();
        return $data;
    }
	
	public function getAllPAmpas()
    {
        $data = Pegawai_m::where('tipePegawai','Ampas')->get();
        return $data;
    }
	
	public function getNamaPegawai()
    {
        $data = Pegawai_m::orderBy('namaPegawai', 'asc')->groupBy('namaPegawai')->select('idPegawai','namaPegawai','telepon')->get();
        return $data;
    }

	//username udah ada apa belom
	public function cekusername($username)
    {
        $data = Pegawai_m::where('username',$username)->get();
        return $data;
    }
	
	//ambil id buat masukin data pegawai ampas
	public function cekbeforeadd($username)
    {
        $data = Pegawai_m::select('idPegawai')
			->where('username',$username)->get();
        return $data;
    }
	
	public function tambahPegawai($data)
    {
        $pegawai =  new Pegawai_m;

		$pegawai->username = $data['username'];
		$pegawai->password = $data['password'];
		$pegawai->namaPegawai = $data['namaPegawai'];
		$pegawai->tahunMasuk = $data['tahunMasuk'];
		$pegawai->telepon = $data['telepon'];
		$pegawai->bonusBeras = $data['bonusBeras'];
		$pegawai->bonusMasaKerja = $data['bonusMasaKerja'];
		$pegawai->tipePegawai = $data['tipePegawai'];
		
		$result = $pegawai->save();
		return $result;
    }
	
	public function ubahPegawai($id, $data)
    {
		$result = Pegawai_m::where('idPegawai',$id)->update($data);
		return $result;
    }
	
	public function hapusPegawai($id)
    {
    	$result = Pegawai_m::where('idPegawai',$id)->delete();
		return $result;
    }
	
		
	//Sayur
	public function getNamaPegawaiKandang()
    {
        $data = Pegawai_m::where('tipePegawai', 'Kandang')->select('idPegawai','namaPegawai')->orderBy('idPegawai','asc')->get();
        return $data;
    }
	
	//Ampas
	public function getNamaPegawaiAmpas()
    {
        $data = Pegawai_m::select('idPegawai','namaPegawai')
			->where('tipePegawai', 'Ampas')
			->orderBy('idPegawai','asc')
			->get();
        return $data;
    }
	
	//Gaji
	public function detailGaji($id)
    {
        $data = Pegawai_m::where('idPegawai',$id)->get();
        return $data;
    }
	
	public function sumPAmpas()
    {
        $data = Pegawai_m::where('tipePegawai','Ampas')->count();
        return $data;
    }
}

?>