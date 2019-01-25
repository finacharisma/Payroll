<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Keuntungan_m extends Eloquent
{
	protected $table = 'keuntungan';
	protected $fillable = ['keuntunganTanggal', 'idKandang', 'totalKeuntungan'];
	public $timestamps = false;
	
	public function Kandang_m(){
		return $this->belongsTo('Kandang_m','idKandang');
	}
	
	public function viewByTgl($tgl)
    {
		$result = Keuntungan_m::where('keuntunganTanggal', 'like', $tgl.'%')->orderBy('idKandang','desc')->get();
		return $result;
    }
	
	public function viewByIdkandangTgl($idKandang,$tgl)
    {
		$result = Keuntungan_m::where('keuntunganTanggal', 'like', $tgl.'%')
				->where('idKandang', $idKandang)->get();
		return $result;
    }
	
	public function simpanKeuntungan($data)
    {
        $untung =  new Keuntungan_m;

		$untung->keuntunganTanggal = $data['keuntunganTanggal'].'-00';
		$untung->idKandang = $data['idKandang'];
		$untung->totalKeuntungan = $data['totalKeuntungan'];
		
		$result = $untung->save();
		return $result;
    }
	
	public function resetKeuntungan($tgl)
    {
    	$result = Keuntungan_m::where('keuntunganTanggal', 'like', $tgl.'%')->delete();
		return $result;
    }
}

?>