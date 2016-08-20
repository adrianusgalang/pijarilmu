<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::resource('home', 'HomeController');
Route::resource('register', 'UserController@register');
Route::resource('saveregister', 'UserController@saveRegister');
Route::resource('cekdoubleemail', 'UserController@cekDoubleEmail');
Route::resource('login', 'UserController@login');
Route::resource('ceklogin', 'UserController@cekLogin');
Route::resource('logout', 'UserController@logout');
Route::resource('ceksekolah', 'UserController@cekSekolah');
Route::resource('cekvalidsekolah', 'UserController@cekValidSekolah');
Route::resource('getkabupaten', 'UserController@getKabupaten');
Route::resource('tambahkansekolah', 'UserController@tambahkanSekolah');

Route::resource('profile', 'UserController@profile');
Route::resource('cekpassword', 'UserController@cekPassword');
Route::resource('edituser', 'UserController@editUser');

Route::resource('tambahpertanyaan', 'QuestionController@tambahPertanyaan');
Route::resource('getmapelbyjenjang', 'QuestionController@getMapelByJenjang');
Route::resource('getbabbymapel', 'QuestionController@getBabByMapel');
Route::resource('savequestion', 'QuestionController@saveQuestion');
Route::resource('daftarpertanyaan', 'QuestionController@listQuestion');
Route::resource('viewpertanyaan', 'QuestionController@viewQuestion');
Route::resource('savejawaban', 'QuestionController@saveJawaban');
Route::resource('categories', 'QuestionController@categories');
//tentang kuis
Route::resource('buatkuis', 'QuisController@buatKuis');
//->getMapelByJenjang pake controller questioncontroller
Route::resource('savebuatkuis', 'QuisController@saveBuatKuis');


