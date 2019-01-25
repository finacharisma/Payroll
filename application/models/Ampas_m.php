<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Ampas_m extends Eloquent
{
	protected $table = 'ampas';
	protected $fillable = ['bulanPengambilan', 'idPegawai', 'tunggal','tunggalPlus','ganda','gandaPlus'];
	public $timestamps = false;
	
	public function getAll($tgl)
    {
        $data = Ampas_m::where('bulanPengambilan', 'like', $tgl.'%')
			->orderBy('idPegawai','asc')
			->get();
        return $data;
    }
	
	public function getById($id, $tgl)
    {
        $data = Ampas_m::where('bulanPengambilan', 'like', $tgl.'%')
			->where('idPegawai',$id)
			->get();
        return $data;
    }
	
	public function cek($id, $tgl)
    {
        $data = Ampas_m::where('idPegawai',$id)
			->where('bulanPengambilan','like',$tgl.'%')
			->get();
        return $data;
    }
	
	public function tambahAmpas($data)
    {
        $ampas =  new Ampas_m;

		$ampas->bulanPengambilan = $data['bulanPengambilan'].'-00';
		$ampas->idPegawai = $data['idPegawai'];
		$ampas->tunggal = $data['tunggal'];
		$ampas->tunggalPlus = $data['tunggalPlus'];
		$ampas->ganda = $data['ganda'];
		$ampas->gandaPlus = $data['gandaPlus'];
		$ampas->tonase = $data['tonase'];
		
		$result = $ampas->save();
		return $result;
    }
	
	public function ubahAmpas($tgl,$id,$data)
    {
		$result = Ampas_m::where('idPegawai', $id)
						->where('bulanPengambilan','like', $tgl.'%')
						->update($data);
		return $result;
    }
}

?>