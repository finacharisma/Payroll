<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class PegawaiAmpas_m extends Eloquent
{
	protected $table = 'pegawaiampas';
	protected $primaryKey = 'idPegawai';
	protected $fillable = ['idPegawai', 'tunggal', 'tunggalPlus','ganda','gandaPlus'];
	public $timestamps = false;
	
	public function PegawaiAmpas_m()
	{
		return $this->belongsTo('Pegawai_m','idPegawai');
	}
	
	public function tambahPegawaiAmpas($data)
    {
        $pegawai =  new PegawaiAmpas_m;

		$pegawai->idPegawai = $data['idPegawai'];
		$pegawai->tunggal = $data['tunggal'];
		$pegawai->tunggalPlus = $data['tunggalPlus'];
		$pegawai->ganda = $data['ganda'];
		$pegawai->gandaPlus = $data['gandaPlus'];
		
		$result = $pegawai->save();
		return $result;
    }
	
	public function ubahPegawaiAmpas($id, $data)
    {
		$result = PegawaiAmpas_m::find($id)->update($data);
		return $result;
    }
	
	public function cekid($id)
    {
		$result = PegawaiAmpas_m::where('idPegawai',$id)->get();
		return $result;
    }
	
	public function hapusPegawai($id)
    {
    	$result = PegawaiAmpas_m::where('idPegawai',$id)->delete();
		return $result;
    }
}

?>