<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserModel extends Model {

	protected $table = 'user';

	protected $fillable = ['id_user', 'nama', 'id_jenjang', 'foto', 'email', 'id_sekolah', 'type','password'];
	
	public function saveRegister($nama,$email,$password,$type,$id_sekolah,$id_jenjang,$imageName){
			
		$results = DB::select('select * from sekolah where nama = ? ', [$id_sekolah]);
		$result = json_decode(json_encode($results), true);
		$id_sekolah = $result[0]['id_sekolah'];
		
		if($nama=="" || $email=="" || $password=="" || $type=="" || $id_sekolah=="" || $id_jenjang=="" || $imageName==""){		
		}else{
			DB::insert('insert into user (nama,id_jenjang,foto,email,id_sekolah,type,password) values(?,?,?,?,?,?,?)',[$nama,$id_jenjang,$imageName,$email,$id_sekolah,$type,$password]);
		}
	}
	
	public function getIdSekolah($sekolah){
		$results = DB::select('select * from sekolah where nama = ? ', [$sekolah]);
		$result = json_decode(json_encode($results), true);
		return $result[0]['id_sekolah'];
	}
	
	public function cekDoubleEmail($email){
		$results = DB::select('select * from user where email = ?', [$email]);
		return count($results);
	}
	
	public function cekLogin($email,$password){
		$results = DB::select('select * from user where email = ? and password = ?', [$email,$password]);
		return count($results);
	}
	
	public function getId($email){
		$results = DB::select('select * from user where email = ? ', [$email]);
		$result = json_decode(json_encode($results), true);
		return $result[0]['id_user'];
	}
	
	public function cekSekolah($sekolah){
		$results = DB::table('sekolah')->where('nama','like','%'.$sekolah.'%')->skip(0)->take(5)->get();
		return $results;
	}
	
	public function cekValidSekolah($sekolah){
		$results = DB::select('select * from sekolah where nama = ?', [$sekolah]);
		return count($results);
	}
	
	public function getKabupaten($provinsi){
		$results = DB::select('select id_kabupaten,kabupaten from kabupaten where id_provinsi = ?', [$provinsi]);
		return $results;
	}
	
	public function tambahkanSekolah($nama,$kabupaten){
		DB::insert('insert into sekolah (nama,id_provinsi_kabupaten) values (?, ?)', [$nama, $kabupaten]);
	}
	
	public function getUser($id_user) {
		$results = DB::select('select * from user where id_user = ?', [$id_user]);
		return $results;
	}
	
	public function cekPassword($password, $id_user){
		$results = DB::select('select * from user where id_user = ? and password = ?', [$id_user, $password]);
		return count($results);
	}
	
	public function getSekolah($id_sekolah) {
		$results = DB::select('select * from sekolah where id_sekolah = ?', [$id_sekolah]);
		return $results;
	}
	
	public function editProfile($nama, $password, $about, $id_jenjang, $id_sekolah, $foto, $id_user) {
		if($id_sekolah == "" && $foto == "") {
			DB::update('update user set nama = ?, password = ?, about = ?, id_jenjang = ? where id_user = ?', [$nama, $password, $about, $id_jenjang, $id_user]);
		} else if($id_sekolah == "") {
			DB::update('update user set nama = ?, password = ?, about = ?, id_jenjang = ?, foto = ? where id_user = ?', [$nama, $password, $about, $id_jenjang, $foto, $id_user]);
		} else if($foto == "") {
			DB::update('update user set nama = ?, password = ?, about = ?, id_jenjang = ?, id_sekolah = ? where id_user = ?', [$nama, $password, $about, $id_jenjang, $id_sekolah, $id_user]);
		} else {
			DB::update('update user set nama = ?, password = ?, about = ?, id_jenjang = ?, id_sekolah = ?, foto = ? where id_user = ?', [$nama, $password, $about, $id_jenjang, $id_sekolah, $foto, $id_user]);
		}
	}
}
