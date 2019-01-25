<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Hutang_m extends Eloquent
{
	protected $table = 'hutang';
	protected $fillable = ['tanggalHutang', 'idPegawai', 'jumlahHutang','sisaHutang','tanggalLunas'];
	public $timestamps = false;
	
	public function belumLunas()
    {
        $data = Hutang_m::where('tanggalLunas', '0000-00-00')
						->where('sisaHutang','!=',0)->orderBy('tanggalHutang', 'asc')->get();
        return $data;
    }
	
	public function lunas()
    {
        $data = Hutang_m::where('sisaHutang',0)->get();
        return $data;
    }
	
	public function getAll()
    {
        $data = Hutang_m::all();
        return $data;
    }
	
	public function Pegawai_m()
	{
		return $this->belongsTo('Pegawai_m','idPegawai');
	}
	
	public function tambahHutang($data)
    {
        $hutang =  new Hutang_m;

		$hutang->tanggalHutang = $data['tanggalHutang'];
		$hutang->idPegawai = $data['idPegawai'];
		$hutang->jumlahHutang = $data['jumlahHutang'];
		$hutang->sisaHutang = $data['jumlahHutang'];
		
		$result = $hutang->save();
		return $result;
    }
	
	public function ubahHutang($data)
    {
		$result = Hutang_m::where('idPegawai', $data['idPegawai'])
						->where('tanggalHutang', $data['tanggalHutang'])
						->update($data);
		return $result;
    }
	
	public function hapusHutang($id, $tgl)
    {
    	$result = Hutang_m::where('idPegawai',$id)
					->where('tanggalHutang',$tgl.'-00')
					->delete();
		return $result;
    }
	
	//Gaji
	public function detailHutang($id)
    {
    	$result = Hutang_m::selectRaw('sum(sisaHutang) as hutang')
			->where('idPegawai',$id)
			->where('sisaHutang', '!=', 0)
			->get();
		return $result;
    }
	
	public function hutangBulanIni($id, $tgl)
    {
    	$result = Hutang_m::selectRaw('sum(sisaHutang) as hutang')
			->where('idPegawai',$id)
			->where('tanggalHutang', 'like', $tgl.'%')
			->where('sisaHutang', '!=', 0)
			->get();
		return $result;
    }
	
	public function updateHutangFromGaji($id, $tgl)
    {
		$result = Hutang_m::where('idPegawai', $id)
			->where('tanggalHutang', 'like', $tgl.'%')
			->where('tanggalLunas', '0000-00-00')
			->update(['sisaHutang'=>0, 'tanggalLunas'=>$tgl.'-00']);
		return $result;
    }

	public function insertHutangFromGaji($id, $tgl, $jmlHutang)
    {
		$tanggal = explode('-', $tgl);
        $hutang =  new Hutang_m;
		
		if($tanggal[1] == 12){
			$hutang->tanggalHutang = $tanggal[0].'-01-00';
		}else{
			$hutang->tanggalHutang = $tanggal[0].'-'.($tanggal[1]+1).'-00';
		}
		
		$hutang->idPegawai = $id;
		$hutang->jumlahHutang = $jmlHutang;
		$hutang->sisaHutang = $jmlHutang;
		
		$result = $hutang->save();
		return $result;
    }
	
	public function searchHutangByTglId($tgl,$id)
    {
        $data = Hutang_m::where('idPegawai', $id)
			->where('tanggalHutang','like',$tgl.'%')
			->orderBy('tanggalHutang', 'asc')
			->limit(1)
			->get();
        return $data;
    }
	
	public function resetHutang($tglHutang, $idPegawai, $totalHutang)
    {
        $result = Hutang_m::where('tanggalHutang', 'like', $tglHutang.'%')
						->where('idPegawai', $idPegawai)
						->update(['jumlahHutang'=>$totalHutang, 'sisaHutang'=>$totalHutang, 'tanggalLunas'=>'0000-00-00']);
		return $result;
    }
}

?>