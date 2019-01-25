<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Harga_m extends Eloquent
{
	protected $table = 'harga';
	protected $fillable = ['namaItem', 'harga', 'prioritas'];
	protected $guarded = array('id', 'nama');
	public $timestamps = false;
	
	public function getAll()
    {
        $data = Harga_m::all();
        return $data;
    }
	
	public function hargaPemasukan()
    {
        $data = Harga_m::where('tipe', 'pemasukan')->get();
        return $data;
    }
	
	public function hargaPengeluaran()
    {
        $data = Harga_m::where('tipe', 'pengeluaran')->get();
        return $data;
    }
	
	public function getByNama($nama)
    {
        $data = Harga_m::where('namaItem',$nama)->get();
        return $data;
    }
	
	public function tambahHarga($data)
    {
        $harga =  new Harga_m;

		$harga->namaItem = $data['namaItem'];
		$harga->harga = $data['harga'];
		$harga->tipe = $data['tipe'];
		
		$result = $harga->save();
		return $result;
    }
	
	public function ubahHarga($data)
    {		
		$result = Harga_m::where('namaItem',$data['namaItem'])
						->update($data);
		
		return $result;
    }
	
	public function hapusHarga($nama, $harga)
    {
    	$result = Harga_m::where('namaItem',$nama)
						->where('harga',$harga)
						->delete();
		return $result;	
    }
}

?>