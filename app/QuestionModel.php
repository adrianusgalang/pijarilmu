<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class QuestionModel extends Model {
	
	public function getJenjang() {
		$results = DB::select('select * from jenjang');
		return $results;
	}
	
	public function getMapel(){
		$results = DB::select('select * from mapel');
		return $results;
	}
	
	public function getBabJoinMapel(){
		$results = DB::select('select * from mapel inner join bab on bab.id_mapel = mapel.id_mapel');
		return $results;
	}
	
	public function getMapelByLimit(){
		$results = DB::select('select * from mapel limit 0, 10');
		return $results;
	}
	
	public function getJumlahSoalByIdBab($id_bab) {
		$results = DB::select('select * from soal where id_bab = ?',[$id_bab]);
		return count($results);
	}
	
	public function getMapelByJenjang($jenjang){
		$results = DB::select('select * from mapel where id_jenjang = ?', [$jenjang]);
		return $results;
	}
	
	public function getBabByMapel($mapel){
		$results = DB::select('select * from bab where id_mapel = ?', [$mapel]);
		return $results;
	}
	
	public function saveQuestion($bab, $pertanyaan, $id) {
		DB::insert('insert into soal (soal, id_bab, id_user) values(?,?,?)',[$pertanyaan, $bab, $id]);
	}
	
	public function saveJawaban($jawaban,$id_jawaban,$id_soal,$id_user,$tipejawaban) {
		if($tipejawaban == 0){
			DB::insert('insert into jawaban (jawaban, id_dijawab, id_soal, id_user) values(?,?,?,?)',[$jawaban, $id_jawaban, 0, $id_user]);
		}else{
			DB::insert('insert into jawaban (jawaban, id_dijawab, id_soal, id_user) values(?,?,?,?)',[$jawaban, 0, $id_soal, $id_user]);		
		}
	}
	
	public function getCountQuestion($bab) {
		$results = DB::select('select * from soal where id_bab = ?',[$bab]);
		return count($results);
	}
	
	public function getCountBab() {
		$results = DB::select('select * from bab');
		return count($results);
	}
	
	public function getQuestion($number,$bab) {
		$start = ($number - 1) * 10;
		$results = DB::select('select * from soal where id_bab = ? limit ?, 10', [$bab,$start]);
		return $results;
	}
	
	public function getLastestQuestion() {
		$results = DB::select('select * from soal limit 0, 2');
		return $results;
	}
	
	public function getOneQuestion($number) {
		$results = DB::select('select * from soal where id_soal = ?', [$number]);
		return $results;
	}
	
	public function getBab($bab) {
		$results = DB::select('select * from bab where id_bab = ?', [$bab]);
		return $results;
	}
	
	public function getMapelByBab($mapel) {
		$results = DB::select('select * from mapel where id_mapel = ?', [$mapel]);
		return $results;
	}
	
	public function getJenjangByMapel($jenjang) {
		$results = DB::select('select * from jenjang where id_jenjang = ?', [$jenjang]);
		return $results;
	}
	
	public function getJawabanByIdSoal($q){
		$results = DB::select('select * from jawaban where id_soal = ?', [$q]);
		return $results;
	}
	
	public function getJawabanByIdJawaban($q){
		$results = DB::select('select * from jawaban where id_dijawab = ?', [$q]);
		return $results;
	}
}
