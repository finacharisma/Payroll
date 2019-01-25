<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Sayur_m extends Eloquent
{
	protected $table = 'sayur';
	protected $fillable = ['bulanPengambilan', 'idPegawai', 'totalKarung','karungPokok'];
	public $timestamps = false;
	
	public function getAll($tgl)
    {
        $data = Sayur_m::where('bulanPengambilan', 'like', $tgl.'%')
			->orderBy('idPegawai','asc')
			->get();
        return $data;
    }
	
	public function getById($id, $tgl)
    {
        $data = Sayur_m::where('idPegawai',$id)
			->where('bulanPengambilan','like',$tgl.'%')
			->get();
        return $data;
    }
	
	public function tambahSayur($data)
    {
        $sayur =  new Sayur_m;

		$sayur->bulanPengambilan = $data['bulanPengambilan'].'-00';
		$sayur->idPegawai = $data['idPegawai'];
		$sayur->totalKarung = $data['totalKarung'];
		$sayur->karungPokok = $data['karungPokok'];
		
		$result = $sayur->save();
		return $result;
    }
	
	public function ubahSayur($tgl,$id,$data)
    {
		$result = Sayur_m::where('idPegawai', $id)
						->where('bulanPengambilan','like', $tgl.'%')
						->update($data);
		return $result;
    }
}

?>