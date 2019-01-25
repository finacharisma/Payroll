<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Bonus_m extends Eloquent
{
	protected $table = 'bonus';
	protected $fillable = ['idPegawai', 'ketBonus', 'jumlahBonus'];
	public $timestamps = false;
	
	public function detailBonus($tgl, $id)
    {
        $data = Bonus_m::where('bulanBonus', 'like', $tgl.'%')->where('idPegawai',$id)->get();
        return $data;
    }
	
	
	public function tambahBonus($data)
    {
        $bonus =  new Bonus_m;

		$bonus->idPegawai = $data['idPegawai'];
		$bonus->bulanBonus = $data['bulanBonus'].'-00';
		$bonus->ketBonus = $data['ketBonus'];
		$bonus->jumlahBonus = $data['jumlahBonus'];
		
		$result = $bonus->save();
		return $result;
    }
	
	public function hapusBonus($idPegawai, $bulanBonus, $ketBonus)
    {
    	$result = Bonus_m::where('idPegawai',$idPegawai)
						->where('bulanBonus','like',$bulanBonus.'%')
						->where('ketBonus',$ketBonus)
						->delete();
		return $result;	
    }
}

?>