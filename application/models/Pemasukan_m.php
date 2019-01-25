<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Pemasukan_m extends Eloquent
{
	protected $table = 'pemasukan';
	protected $fillable = ['idKandang', 'tanggalMasuk', 'jenisPemasukan','jumlahPemasukan','tipePemasukan'];
	public $timestamps = false;
	
	public function Kandang_m()
    {
        return $this->belongsTo('Kandang_m','idKandang');
    }
	
	public function getNow($tanggal)
    {
        $data = Pemasukan_m::selectRaw('idKandang, sum(jumlahPemasukan) as sum')
						   ->where('tipePemasukan', 'rutin')
						   ->where('tanggalMasuk', 'LIKE', $tanggal.'%')
						   ->groupBy('idKandang')
						   ->get();
		return $data;
    }
	
	public function detailPemasukan($tgl, $id)
    {
        $data = Pemasukan_m::where('tanggalMasuk', 'LIKE', $tgl.'%')
						   ->where('idKandang', $id.'%')
						   ->get();
		return $data;
    }
	
	public function tambahPemasukan($data)
    {
        $pemasukan =  new Pemasukan_m;

		$pemasukan->idKandang = $data['idKandang'];
		$pemasukan->jenisPemasukan = $data['jenisPemasukan'];
		$pemasukan->tanggalMasuk = $data['tanggalMasuk'];
		$pemasukan->jumlahPemasukan = $data['jumlahPemasukan'];
		$pemasukan->tipePemasukan = $data['tipePemasukan'];
		
		$result = $pemasukan->save();
		return $result;
    }
	
	public function ubahPemasukan($data)
    {		
		$result = Pemasukan_m::where('idKandang', $data['idKandang'])
						->where('tanggalMasuk', $data['tanggalMasuk'])
						->where('jenisPemasukan', $data['jenisPemasukan'])
						->update($data);
		return $result;
    }
	
	public function hapusPemasukan($id, $tgl, $jns)
    {
    	$result = Pemasukan_m::where('idKandang',$id)
								->where('tanggalMasuk', $tgl)
								->where('jenisPemasukan', $jns)
								->delete();
		return $result;
    }
}

?>