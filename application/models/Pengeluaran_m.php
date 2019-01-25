<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Pengeluaran_m extends Eloquent
{
	protected $table = 'pengeluaran';
	protected $fillable = ['idKandang', 'tanggalKeluar', 'jenisPengeluaran','jumlahPengeluaran','tipePengeluaran'];
	public $timestamps = false;
	
	public function Kandang_m(){
		return $this->belongsTo('Kandang_m', 'idKandang');
	}
	
	public function getNow($tanggal)
    {
        $data = Pengeluaran_m::selectRaw('idKandang, sum(jumlahPengeluaran) as sum')
			->where('tipePengeluaran', 'rutin')
			->where('tanggalKeluar', 'LIKE', $tanggal.'%')->groupBy('idKandang')->get();
		return $data;
    }
	
	public function detailPengeluaran($tgl, $id)
    {
        $data = Pengeluaran_m::where('tanggalKeluar', 'LIKE', $tgl.'%')->where('idKandang', $id.'%')->orderBy('tanggalKeluar', 'ASC')->get();
		return $data;
    }
	
	public function tambahPengeluaran($data)
    {
        $pengeluaran =  new Pengeluaran_m;

		$pengeluaran->idKandang = $data['idKandang'];
		$pengeluaran->jenisPengeluaran = $data['jenisPengeluaran'];
		$pengeluaran->tanggalKeluar = $data['tanggalKeluar'];
		$pengeluaran->jumlahPengeluaran = $data['jumlahPengeluaran'];
		$pengeluaran->tipePengeluaran = $data['tipePengeluaran'];
		
		$result = $pengeluaran->save();
		return $result;
    }
	
	public function ubahPengeluaran($data)
    {		
		$result = Pengeluaran_m::where('idKandang', $data['idKandang'])
						->where('tanggalKeluar', $data['tanggalKeluar'])
						->where('jenisPengeluaran', $data['jenisPengeluaran'])
						->update($data);
		return $result;
    }
	
	public function hapusPengeluaran($id, $tgl, $jns)
    {
    	$result = Pengeluaran_m::where('idKandang',$id)
								->where('tanggalKeluar', $tgl)
								->where('jenisPengeluaran', $jns)
								->delete();
		return $result;
    }
}

?>