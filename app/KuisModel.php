<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class KuisModel extends Model {

	protected $table = 'K_TEST';

	protected $fillable = ['ID_TEST', 'NAMA_TEST', 'BANYAK_SOAL', 'WAKTU', 'ID_BAB', 'DESKRIPSI', 'T_START','T_END'];
	
	public function saveBuatKuis($namakuis,$deskripsi,$bab,$banyak_soal,$waktu){
		if($namakuis=="" || $deskripsi=="" || $bab=="" || $banyak_soal==0 || $waktu==0){		
		}else{
			DB::insert('insert into K_TEST (NAMA_TEST,BANYAK_SOAL,WAKTU,ID_BAB,DESKRIPSI) values(?,?,?,?,?)',[$namakuis,$banyak_soal,$waktu,$bab,$deskripsi]);
		}
	}
}
