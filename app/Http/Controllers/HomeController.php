<?php 

namespace App\Http\Controllers;
use App\QuestionModel;
use Session;

class HomeController extends Controller {
	
	public function __construct()
    {
        session()->regenerate();
    }

	public function index()
	{
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();
		
		$mapel = $qModel->getMapelByLimit();
		$mapel = json_decode(json_encode($mapel), true);
		for($x = 0; $x < count($mapel); $x++) {
			$Bab = $qModel->getBabByMapel($mapel[$x]["id_mapel"]);
			$Bab = json_decode(json_encode($Bab), true);
			$jumlahSoal = 0;
			for($y = 0; $y < count($Bab); $y++) {
				$jumlahSoal += $qModel->getJumlahSoalByIdBab($Bab[$y]["id_bab"]);
			}
			$mapel[$x]["jumlahSoal"] = $jumlahSoal;
		}
		$data["mapel"] = json_decode(json_encode($mapel));
		
		if(Session::get('id') != ""){
			$data["id_user"] = Session::get('id');
			return view("home", compact("data"));
		}
		
		return view('home', compact("data"));
	}

}
