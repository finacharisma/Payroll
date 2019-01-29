<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Gaji_m extends Eloquent
{
	protected $table = 'gaji';
	protected $fillable = ['idPegawai', 'tanggalGaji', 'totalHutang', 'totalGaji','flag'];
	public $timestamps = false;
	
	public function searchByTgl($tgl)
    {
        $data = Gaji_m::where('tanggalGaji', 'like', $tgl.'%')
			->get();
        return $data;
    }
	
	public function searchByTglId($tgl,$id)
    {
        $data = Gaji_m::where('tanggalGaji', 'like', $tgl.'%')
			->where('idPegawai', $id)
			->get();
        return $data;
    }
	
	public function searchByTglIdFlag($tgl, $id)
    {
        $data = Gaji_m::where('tanggalGaji', 'like', $tgl.'%')->where('idPegawai', $id)->where('flag', 1)->get();
        return $data;
    }
	
	public function simpanGaji($data)
    {
        $gaji =  new Gaji_m;

		$gaji->idPegawai = $data['idPegawai'];
		$gaji->tanggalGaji = $data['tanggalGaji'];
		$gaji->totalHutang = $data['totalHutang'];
		$gaji->totalGaji = $data['totalGaji'];
		$gaji->flag = $data['flag'];
		
		$result = $gaji->save();
		return $result;
    }
	
	public function ubahGaji($data)
    {
		$result = Gaji_m::where('idPegawai', $data['idPegawai'])
						->where('tanggalGaji', $data['tanggalGaji'])
						->update($data);
		return $result;
    }
	
	public function resetGaji($tgl, $id)
    {
    	$result = Gaji_m::where('tanggalGaji', 'like', $tgl.'%')
			->where('idPegawai', $id)
			->update(['flag' => 0]);
		return $result;
    }
}

?>