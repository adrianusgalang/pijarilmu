<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\QuestionModel;
use App\KuisModel;
use Session;

class QuisController extends Controller {

	public function __construct()
    {
        session()->regenerate();

    }
	
	public function buatKuis()
	{
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();

		return view('buatkuis', compact("data"));		
	}
	
	public function saveBuatKuis(Request $request){
		if(Session::get('id') == "") {
			return Redirect::to('home');
		}

		$namakuis = $request->input('nama_kuis');
		$deskripsi = $request->input('deskripsi');
		$bab = $request->input('bab');
		$banyak_soal = $request->input('banyak_soal');
		$waktu = $request->input('waktu');
		
		$kModel = new KuisModel();
		$kModel->saveBuatKuis($namakuis,$deskripsi,$bab,$banyak_soal,$waktu);
		return Redirect::to('buatkuis');
	}
}
