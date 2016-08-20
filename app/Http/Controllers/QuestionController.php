<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\QuestionModel;
use App\UserModel;
use Session;

class QuestionController extends Controller {

	public function __construct()
    {
        session()->regenerate();
    }
	
	public function tambahPertanyaan() {
		if(Session::get('id') == "") {
			return Redirect::to('home');
		}
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();
		
		$qModel = new QuestionModel();
		$data["jenjang"] = $qModel->getJenjang();
		return view('tambahPertanyaan', compact("data"));
	}
	
	public function getMapelByJenjang(Request $request) {
		$jenjang = $request->input('jenjang');
		$qModel = new QuestionModel();
		return $qModel->getMapelByJenjang($jenjang);
	}
	
	public function getBabByMapel(Request $request) {
		$mapel = $request->input('mapel');
		$qModel = new QuestionModel();
		return $qModel->getBabByMapel($mapel);
	}
	
	public function saveQuestion(Request $request) {
		if(Session::get('id') == "") {
			return Redirect::to('home');
		}
		$bab = $request->input('bab');
		$pertanyaan = $request->input('pertanyaan');
		$qModel = new QuestionModel();
		$qModel->saveQuestion($bab, $pertanyaan, Session::get('id'));
		return Redirect::to('daftarpertanyaan');
	}
	
	public function listQuestion(Request $request) {
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();
		
		if($request->input('p')=="") {
			return Redirect::to('categories');
		}
		
		if($request->input('b')=="") {
			return Redirect::to('categories');
		}
		
		if(Session::get('id')!="") {
			$data["id_user"] = Session::get('id');
		}
		$qModel = new QuestionModel();
		$uModel = new UserModel();
		$p = $request->input('p');
		$b = $request->input('b');
		if($p < 1 || $b < 1) {
			return Redirect::to('categories');
		}
		$countQuestion = $qModel->getCountQuestion($b);
		if($countQuestion % 10 > 0) {
			$max = floor($countQuestion / 10) + 1;
		} else {
			$max = floor($countQuestion / 10);
		}
		if($p > $max) {
			return Redirect::to('daftarpertanyaan?p=' . $max .'&b='.$b);
		}
		
		$countBab = $qModel->getCountBab();
		if($b > $countBab){
			return Redirect::to('categories');
		}
		$data["currentBab"] = $b;
		if($p > 1 && $p < $max) {
			$data["prev"] = $p - 1;
			$data["next"] = $p + 1;
		} else if ($p == 1 && $p < $max) {
			$data["next"] = 2;
		} else if ($p > 1 && $p == $max) {
			$data["prev"] = $p - 1;
		}
		$question = $qModel->getQuestion($p,$b);
		$question = json_decode(json_encode($question), true);
		for($x = 0; $x < count($question); $x++) {
			$user = $uModel->getUser($question[$x]["id_user"]);
			$user = json_decode(json_encode($user), true);
			$question[$x]["nama"] = $user[0]["nama"];
			$question[$x]["foto"] = $user[0]["foto"];
			$bab = $qModel->getBab($question[$x]["id_bab"]);
			$bab = json_decode(json_encode($bab), true);
			$question[$x]["id_bab"] = $bab[0]["id_bab"];
			$question[$x]["bab"] = $bab[0]["bab"];
			$mapel = $qModel->getMapelByBab($bab[0]["id_mapel"]);
			$mapel = json_decode(json_encode($mapel), true);
			$question[$x]["id_mapel"] = $mapel[0]["id_mapel"];
			$question[$x]["mapel"] = $mapel[0]["mapel"];
			$jenjang = $qModel->getJenjangByMapel($mapel[0]["id_jenjang"]);
			$jenjang = json_decode(json_encode($jenjang), true);
			$question[$x]["id_jenjang"] = $jenjang[0]["id_jenjang"];
			$question[$x]["jenjang"] = $jenjang[0]["jenjang"];
			$question[$x]["timestamp"] = substr($question[$x]["timestamp"], 8, 2) . "-" . substr($question[$x]["timestamp"], 5, 2) . "-" . substr($question[$x]["timestamp"], 0, 4) . " " . substr($question[$x]["timestamp"], 11, 8);
		}
		$data["question"] = json_decode(json_encode($question));
		return view('daftarPertanyaan', compact("data"));
	}
	
	
	public function viewQuestion(Request $request) {
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();
		
		if($request->input('q') == "") {
			return Redirect::to('daftarpertanyaan?p=1');
		}
		if(Session::get('id') != "") {
			$data["id_user"] = Session::get('id');
		}
		
		$qModel = new QuestionModel();
		$uModel = new UserModel();
		
		$q = $request->input('q');
		if($q < 1) {
			return Redirect::to('daftarpertanyaan?p=1');
		}
		
		$question = $qModel->getOneQuestion($q);
		$question = json_decode(json_encode($question), true);
		$x = 0;
		$user = $uModel->getUser($question[$x]["id_user"]);
		$user = json_decode(json_encode($user), true);
		$question[$x]["nama"] = $user[0]["nama"];
		$question[$x]["foto"] = $user[0]["foto"];
		$bab = $qModel->getBab($question[$x]["id_bab"]);
		$bab = json_decode(json_encode($bab), true);
		$question[$x]["id_bab"] = $bab[0]["id_bab"];
		$question[$x]["bab"] = $bab[0]["bab"];
		$mapel = $qModel->getMapelByBab($bab[0]["id_mapel"]);
		$mapel = json_decode(json_encode($mapel), true);
		$question[$x]["id_mapel"] = $mapel[0]["id_mapel"];
		$question[$x]["mapel"] = $mapel[0]["mapel"];
		$jenjang = $qModel->getJenjangByMapel($mapel[0]["id_jenjang"]);
		$jenjang = json_decode(json_encode($jenjang), true);
		$question[$x]["id_jenjang"] = $jenjang[0]["id_jenjang"];
		$question[$x]["jenjang"] = $jenjang[0]["jenjang"];
		$question[$x]["timestamp"] = substr($question[$x]["timestamp"], 8, 2) . "-" . substr($question[$x]["timestamp"], 5, 2) . "-" . substr($question[$x]["timestamp"], 0, 4) . " " . substr($question[$x]["timestamp"], 11, 8);
		
		//jawaban
		$jawabanSoal = $qModel->getJawabanByIdSoal($q);
		$jawabanSoal = json_decode(json_encode($jawabanSoal), true);
		for($x = 0; $x < count($jawabanSoal); $x++) {
			$user = $uModel->getUser($jawabanSoal[$x]["id_user"]);
			$user = json_decode(json_encode($user), true);
			$jawabanSoal[$x]["nama"] = $user[0]["nama"];
			$jawabJawabanSoal = $qModel->getJawabanByIdJawaban($jawabanSoal[$x]["id_jawaban"]);
			$jawabJawabanSoal = json_decode(json_encode($jawabJawabanSoal), true);
			$jawaban = null;
			for($y = 0; $y < count($jawabJawabanSoal); $y++) {
				$jawaban[$y] = $jawabJawabanSoal[$y];
				$user = $uModel->getUser($jawabJawabanSoal[$y]["id_user"]);
				$user = json_decode(json_encode($user), true);
				$jawaban[$y]["nama"] = $user[0]["nama"];
			}
			$jawabanSoal[$x]["jawabannya"] = $jawaban;
		}
		$data["id_soal"] = $q;
		$data["jawabanSoal"] = json_decode(json_encode($jawabanSoal));
		$data["question"] = json_decode(json_encode($question));
		/*
		$json = json_encode($data);
		$level = 0;
		$in_quotes = false;
		$in_escape = false;
		$ends_line_level = NULL;
		$json_length = strlen( $json );

		for( $i = 0; $i < $json_length; $i++ ) {
			$char = $json[$i];
			$new_line_level = NULL;
			$post = "";
			if( $ends_line_level !== NULL ) {
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}
			if ( $in_escape ) {
				$in_escape = false;
			} else if( $char === '"' ) {
				$in_quotes = !$in_quotes;
			} else if( ! $in_quotes ) {
				switch( $char ) {
					case '}': case ']':
						$level--;
						$ends_line_level = NULL;
						$new_line_level = $level;
						break;

					case '{': case '[':
						$level++;
					case ',':
						$ends_line_level = $level;
						break;

					case ':':
						$post = " ";
						break;

					case " ": case "\t": case "\n": case "\r":
						$char = "";
						$ends_line_level = $new_line_level;
						$new_line_level = NULL;
						break;
				}
			} else if ( $char === '\\' ) {
				$in_escape = true;
			}
			if( $new_line_level !== NULL ) {
				echo  "<br>".str_repeat( " --------- ", $new_line_level );
			}
			echo $char.$post;
		}*/
		
		//print_r($data);
		//echo json_encode($data,true);
		//echo count($data["jawabanSoal"][1]);
		return view('detailQuestion', compact("data"));
	}
	
	public function saveJawaban(Request $request) {
		if(Session::get('id') == "") {
			return Redirect::to('home');
		}
		$tipejawaban = $request->input('tipejawaban');
		$id_jawaban = $request->input('id_jawaban');
		if($tipejawaban == 0){
			$jawaban = $request->input('jawabanjawaban'.$id_jawaban);
		}else{
			$jawaban = $request->input('jawabansoal'.$id_jawaban);
		}
		$id_user = Session::get('id');
		$id_soal = $request->input('id_soal');
		$qModel = new QuestionModel();
		$qModel->saveJawaban($jawaban,$id_jawaban,$id_soal,$id_user,$tipejawaban);
		//$qModel->saveQuestion($bab, $pertanyaan, Session::get('id'));
		return Redirect::to('viewpertanyaan?q='.$id_soal);
	}

	public function categories(Request $request) {
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();

		$data["mapel"] = $qModel->getMapel();
		$data["bab"] = $qModel->getBabJoinMapel();
		
		if($request->input('mapel') != ""){
			$InMapel = $request->input('mapel');
			$data["InMapel"] = $InMapel;
		}else{
			$data["InMapel"] = 0;
		}
		
		if($request->input('jenjang') != ""){
			$InJenjang = $request->input('jenjang');
			$data["InJenjang"] = $InJenjang;
		}else{
			$data["InJenjang"] = 0;
		}
		
		/*if($IMapel == 0){
			$IMapel = "";
		}
		
		if($IJenjang == 0){
			$IJenjang = "";
		}*/

		return view('categories', compact("data"));
	}
}
