<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Kandang_m extends Eloquent
{
	protected $table = 'kandang';
	protected $primaryKey = 'idKandang';
	protected $fillable = ['idKandang', 'namaKandang', 'lokasi'];
	public $timestamps = false;
	
	public function Pemasukan_m()
    {
        return $this->hasMany('Pemasukan_m','idKandang');
    }
	
	public function Pengeluaran_m()
    {
        return $this->hasMany('Pengeluaran_m','idKandang');
    }
	
	public function Keuntungan_m(){
		return $this->hasMany('Keuntungan_m','idKandang');
	}
	
	public function PegawaiKandang_m()
    {
        return $this->hasMany('PegawaiKandang_m','idKandang');
    }
	
	public function getAll()
    {
        $data = Kandang_m::all();
        return $data;
    }
	
	public function getNama()
    {
        $data = Kandang_m::select('idKandang', 'namaKandang')->orderBy('idKandang', 'desc')->get();
        return $data;
    }
	
	public function getById($idKandang)
    {
        $data = Kandang_m::find($idKandang);
        return $data;
    }
	
	public function tambahKandang($data)
    {
        $kandang =  new Kandang_m;

		$kandang->lokasi = $data['lokasi'];
		$kandang->namaKandang = $data['namaKandang'];
		
		$result = $kandang->save();
		return $result;
    }
	
	public function ubahKandang($idKandang, $data)
    {
		$result = Kandang_m::find($idKandang)->update($data);
		return $result;
    }
	
	public function hapusKandang($idKandang)
    {
    	$result = Kandang_m::where('idKandang',$idKandang)->delete();
		return $result;
		
    }
}

?>