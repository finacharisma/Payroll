<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class PegawaiKandang_m extends Eloquent
{
	protected $table = 'pegawaikandang';
	protected $primaryKey = 'idPegawai';
	protected $fillable = ['idPegawai', 'idKandang', 'gajipokok', 'bonuskeluarga', 'bonusUsaha'];
	public $timestamps = false;
	
	public function Pegawai_m()
	{
		return $this->belongsTo('Pegawai_m','idPegawai');
	}
	
	public function Kandang_m()
	{
		return $this->belongsTo('Kandang_m','idKandang');
	}
	
	public function tambahPegawaiKandang($data)
    {
        $pegawai =  new PegawaiKandang_m;

		$pegawai->idPegawai = $data['idPegawai'];
		$pegawai->idKandang = $data['idKandang'];
		$pegawai->gajiPokok = $data['gajiPokok'];
		$pegawai->bonusKeluarga = $data['bonusKeluarga'];
		$pegawai->bonusUsaha = $data['bonusUsaha'];
		
		$result = $pegawai->save();
		return $result;
    }
	
	public function ubahPegawaiKandang($id, $data)
    {
		$result = PegawaiKandang_m::where('idPegawai',$id)->update($data);
		return $result;
    }
	
	public function cekid($id)
    {
		$result = PegawaiKandang_m::where('idPegawai',$id)->get();
		return $result;
    }
	
	//gaji
	public function pegawaidiKandang($id)
    {
		$result = PegawaiKandang_m::where('idKandang',$id)->where('bonusUsaha','ya')->count();
		return $result;
    }
	
	public function namaPegawaiDiKandang($id)
    {
		$result = PegawaiKandang_m::where('idKandang',$id)->where('bonusUsaha','ya')->get();
		return $result;
    }
	
	//keuntungan
	public function PKDiKandang($id)
    {
		$result = PegawaiKandang_m::where('idKandang',$id)->get();
		return $result;
    }
	
	public function hapusPegawai($id)
    {
    	$result = PegawaiKandang_m::where('idPegawai',$id)->delete();
		return $result;
    }
}

?>