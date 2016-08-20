<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\QuestionModel;
use App\UserModel;
use Session;

class UserController extends Controller {
	public function __construct()
    {
        session()->regenerate();
    }
	
	public function register()
	{
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();

		if(Session::get('id')!=""){
			return Redirect::to('home');
		}
		return view('register', compact("data"));
		
	}
	
	public function saveRegister(Request $request){
		if(Session::get('id')!=""){
			return Redirect::to('home');
		}
		$namadepan = $request->input('namadepan');
		$namabelakang = $request->input('namabelakang');
		$nama = $namadepan.' '.$namabelakang;
		$email = $request->input('email');
		$password = $request->input('password');
		$type = $request->input('type');
		$id_sekolah = $request->input('id_sekolah');
		$id_jenjang = $request->input('id_jenjang');
		$foto = $request->input('foto'); 
		
		$imageName = microtime() . '.' . 
        $request->file('foto')->getClientOriginalExtension();

		$request->file('foto')->move(
			base_path() . '/public/images/catalog/', $imageName
		);
		
		$uModel = new UserModel();
		$uModel->saveRegister($nama,$email,$password,$type,$id_sekolah,$id_jenjang,$imageName);
		return Redirect::to('login');
	}
	
	public function cekDoubleEmail(Request $request){
		$email = $request->input('email');
		$uModel = new UserModel();
		return $uModel->cekDoubleEmail($email);
	}
	
	public function login(){
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();

		if(Session::get('id')!=""){
			return Redirect::to('home');
		}
		return view('login', compact("data"));
	}
	
	public function cekLogin(Request $request){

		if(Session::get('id')!=""){
			return Redirect::to('home');
		}
		$email = $request->input('email');
		$password = $request->input('password');
		
		$uModel = new UserModel();
		$status = $uModel->cekLogin($email,$password);
		if($status == 0){
			return Redirect::to('login');
			}
			else{
				$id = $uModel->getId($email);
				Session::put('id', $id);
				return Redirect::to('home');
				}
	}
	
	public function logout(){
		Session::flush();
		return Redirect::to('home');
	}
	
	public function cekSekolah(Request $request){
		$sekolah = $request->input('sekolah');
		$uModel = new UserModel();
		return $uModel->cekSekolah($sekolah);
	}
	
	public function cekValidSekolah(Request $request){
		$sekolah = $request->input('sekolah');
		$uModel = new UserModel();
		return $uModel->cekValidSekolah($sekolah);
	}
	
	public function getKabupaten(Request $request){
		$provinsi = $request->input('provinsi');
		$uModel = new UserModel();
		return $uModel->getKabupaten($provinsi);
	}
	
	public function tambahkanSekolah(Request $request){
		$nama =  $request->input('nama');
		$kabupaten =  $request->input('kabupaten');
		$uModel = new UserModel();
		$uModel->tambahkanSekolah($nama,$kabupaten);
	}
	
	public function profile(Request $request) {
		//header
		$qModel = new QuestionModel();
		$data["mapelSd"] = $qModel->getMapelByJenjang(1);
		$data["mapelSmp"] = $qModel->getMapelByJenjang(2);
		$data["mapelSma"] = $qModel->getMapelByJenjang(3);
		$data["mapelUmum"] = $qModel->getMapelByJenjang(4);
		$data["lastesQuestion"] = $qModel->getLastestQuestion();

		if(Session::get('id') != "") {
			$uModel = new UserModel();
			$user = $uModel->getUser(Session::get('id'));
			$user = json_decode(json_encode($user), true);
			$sekolah = $uModel->getSekolah($user[0]["id_sekolah"]);
			$sekolah = json_decode(json_encode($sekolah), true);
			$user[0]["namaSekolah"] = $sekolah[0]["nama"];
			$user = json_decode(json_encode($user));
			$data["user"] = $user;
			return view('profileForm', compact("data"));
		} else {
			$id_user = $request->input('id');
			$uModel = new UserModel();
			$user = $uModel->getUser($id_user);
			$user = json_decode(json_encode($user), true);
			if(count($user) == 0) {
				return Redirect::to('home');
			}
			$sekolah = $uModel->getSekolah($user[0]["id_sekolah"]);
			$sekolah = json_decode(json_encode($sekolah), true);
			$user[0]["namaSekolah"] = $sekolah[0]["nama"];
			$user = json_decode(json_encode($user));
			$data["user"] = $user;
			return view('profile', compact("data"));
		}
	}
	
	public function cekPassword(Request $request){
		$password = $request->input('password');
		$uModel = new UserModel();
		return $uModel->cekPassword($password, Session::get('id'));
	}
	
	public function editUser(Request $request) {
		if(Session::get('id') == ""){
			return Redirect::to('home');
		}
		$uModel = new UserModel();
		$nama = $request->input('nama');
		$password = $request->input('password');
		$about = $request->input('about');
		$id_jenjang = $request->input('id_jenjang');
		if($request->input('id_sekolah') != "") {
			$id_sekolah = $uModel->getIdSekolah($request->input('id_sekolah'));
		} else {
			$id_sekolah = "";
		}
		if($request->input('photoName') != "") {
			$foto = $request->input('foto');
			$imageName = microtime() . '.' . 
			$request->file('foto')->getClientOriginalExtension();
			$request->file('foto')->move(
				base_path() . '/public/images/catalog/', $imageName
			);
		} else {
			$imageName = "";
		}
		$uModel->editProfile($nama, $password, $about, $id_jenjang, $id_sekolah, $imageName, Session::get('id'));
		return Redirect::to('profile');
	}
}
