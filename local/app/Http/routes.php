<?php
use Illuminate\Support\Facades\Input;
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
Route::get('/',function(){
	return view('index');
});
//Route::group(['middleware' => 'web'],function(){
	
	Route::auth();
	Route::get('/home', 'HomeController@index');
	
	Route::get('login-mahasiswa','AuthMahasiswa\AuthController@showLoginForm');
	Route::post('login-mahasiswa',['as'=>'login-mahasiswa','uses'=>'AuthMahasiswa\AuthController@mahasiswaLoginPost']);
	Route::get('/logout-mahasiswa','AuthMahasiswa\AuthController@logoutmahasiswa');
	//dosen
	Route::get('login-dosen','AuthDosen\AuthController@showLoginForm');
	Route::post('login-dosen',['as'=>'login-dosen','uses'=>'AuthDosen\AuthController@DosenLoginPost']);
	Route::get('/logout-dosen','AuthDosen\AuthController@logoutdosen');
	
	//error
	Route::get('/503',function(){
		abort(503);
	});
	
	
	//menu mahasiswa
	Route::get('menu_mahasiswa','Menu_MahasiswaController@index');
	//menudosen
	Route::get('menu_mahasiswa','Menu_DosenController@index');
	
	
//});
Route::group(['middleware'=>'auth'],function(){
	
	//matakuliah
	Route::get('/home/showmatakuliah','MataKuliahController@index');
	Route::get('/home/addmatakuliah','MataKuliahController@add');
	//simpan matakuliah
	Route::post('/home/storematakuliah','MataKuliahController@store');
	//autocomplete cek kode mata kuliah
	Route::post('/home/kodemk_autocomplete','MataKuliahController@autocomplete');
	//getdatatable matakuliah
	Route::controller('/home/datatablesmatakuliah', 'MataKuliahController', [
		'getData'  => 'datatablesmatakuliah.data',
		'getIndex' => 'datatablesmatakuliah',
	]);
	Route::post('/home/check_kodekmk','MataKuliahController@check');
	//hapus matakuliah
	Route::post('/home/deletematakuliah','MataKuliahController@destroy');
	//edit matakuliah
	Route::get('/home/edit_matakuliah/{kodemk}','MataKuliahController@edit');
	//update matakuliah
	Route::post('/home/updatematakuliah','MataKuliahController@updatematakuliah');
	//delete detail matakuliah
	Route::post('/home/delete_dosen_detailmatakuliah','MataKuliahController@delete_dosen_detailmatakuliah');
	
	Route::get('/home/detailmatakuliah/{kodemk}','MataKuliahController@detail');
	//mahasiswa
	Route::get('/home/showmahasiswa','MahasiswaController@index');
	Route::get('/home/deletemahasiswa/{nim}','MahasiswaController@destroy');
	Route::get('/home/detailmahasiswa/{nim}','MahasiswaController@detail');
	
	Route::post('/home/nim_autocomplete','MahasiswaController@autocomplete');
	Route::get('/home/addmahasiswa','MahasiswaController@add');
	Route::post('/home/addmahasiswa','MahasiswaController@store');
	
	Route::get('/home/editmahasiswa/{nim}','MahasiswaController@edit');
	Route::post('/home/editmahasiswa/{nim}','MahasiswaController@update');
	Route::get('/home/datamahasiswa','MahasiswaController@show');
	//periode
	Route::get('/home/showperiode','PeriodeController@index');
	Route::get('/home/addperiode','PeriodeController@add');
	//simpan periode
	Route::post('/home/storeperiode','PeriodeController@store');
	//show periode
	Route::controller('/home/datatablesperiode', 'PeriodeController', [
		'getData'  => 'datatablesperiode.data',
		'getIndex' => 'datatablesperiode',
	]);
	//hapus periode
	Route::post('/home/deleteperiode','PeriodeController@destroy');
	//edit periode
	Route::get('/home/edit_periode/{idperiode}','PeriodeController@edit');
	//update periode
	Route::post('/home/updateperiode','PeriodeController@updateperiode');
	
	//dosen
	Route::get('/home/showdosen','DosenController@index');
	Route::get('/home/showdatadosen','DosenController@show');
	Route::get('/home/editdosen/{iddosen}','DosenController@edit');
	Route::post('/home/editdosen/{iddosen}','DosenController@update');
	Route::get('/home/adddosen','DosenController@add');
	Route::post('/home/adddosen','DosenController@store');
	Route::get('/home/deletedosen/{iddosen}','DosenController@destroy');
	Route::get('/home/getdosenpengampu','DosenController@getDataDosenPengampu');
	Route::post('/home/check_nidn','DosenController@check_nidn');
	Route::get('/home/detaildosen/{iddosen}','DosenController@detail');
	//kelas dosen
	Route::get('/home/addkelasdosen','KelasDosenController@add');
	Route::get('/home/showkelasdosen','KelasDosenController@index');
	Route::get('/home/showdatakelasdosen','KelasDosenController@show');
	Route::post('/home/addkelasdosen','KelasDosenController@store');
	Route::get('/home/getdatadosen/{idkelas}','KelasDosenController@datadosen');
	Route::post('/home/editkelasdosen/{idkelasdosen}','KelasDosenController@update');
	Route::get('/home/editkelasdosen/{idkelasdosen}','KelasDosenController@edit');
	Route::get('/home/deletekelasdosen/{idkelasdosen}','KelasDosenController@destroy');
	//kelas
	Route::get('/home/showkelas','KelasController@index');
	Route::get('/home/edit_kelas/{id}','KelasController@edit');
	Route::post('/home/editkelas','KelasController@update');
	Route::get('/home/addkelas','KelasController@add');
	Route::post('/home/storekelas','KelasController@store');
	Route::post('/home/kode_kelas_autocomplete','KelasController@autocomplete');
	Route::controller('/home/datatableskelas', 'KelasController', [
		'getData'  => 'datatableskelas.data',
		'getIndex' => 'datatableskelas',
	]);
	Route::post('/home/deletekelas','KelasController@destroy');
	//kelas mahasiswa
	Route::get('/home/showkelasmahasiswa','KelasMahasiswaController@index');
	Route::get('/home/addkelasmahasiswa','KelasMahasiswaController@add');
	Route::post('/home/storekelasmahasiswa','KelasMahasiswaController@store');
	Route::get('/home/editkelasmahasiswa/{id}','KelasMahasiswaController@edit');
	Route::post('/home/updatekelasmahasiswa','KelasMahasiswaController@update');
	Route::get('/home/deletekelasmahasiswa/{id}','KelasMahasiswaController@destroy');
	Route::get('/home/getdatamahasiswa/{tahunajaran}','MahasiswaController@getdatamahasiswa');
	Route::post('/home/check_kelasmahasiswa','KelasMahasiswaController@checking');
	Route::get('/home/datakelasmahasiswa','KelasMahasiswaController@getKelasMahasiswa');
	//ganti password admin
	Route::get('/home/changepassword_admin','UserController@changepassword_admin');
	Route::post('/home/changepassword_admin','UserController@post_changepassword_admin');
	Route::post('/home/admin/TempUpload','UserController@uploadimage');
	//ubah penilaian mahasiswa
	Route::get('/home/shownilai','PenilaianAdminController@shownilai');
	Route::get('/home/getsemmk/{sem}', 'PenilaianAdminController@getsemmk');
	Route::get('/home/editnilai/{idkhs}', 'PenilaiaAdminController@editnilai');
	Route::post('/home/editnilai/{idkhs}', 'PenilaianAdminController@update');
	Route::get('/home/deletenilai/{idkhs}', 'PenilaianAdminController@destroy');
	Route::get('/home/getdatakhsadmin/{kelas}/{sem}/{matkul}', 'PenilaianAdminController@datakhs');
});
Route::group(['middleware' => ['auth', 'isAdmin']], function () {
   //here 
   //mahasiswa user register
	Route::get('/home/register_mahasiswa', 'UserController@add_user_mahasiswa');
	Route::post('/home/store_register_mahasiswa', 'UserController@store_user_mahasiswa');
	Route::post('/home/mahasiswa_user_autocomplete','UserController@autocomplete_mahasiswa_checknim');
	Route::controller('/home/datatables_usermahasiswa', 'UserController', [
		'getData_usermahasiswa'  => 'datatables_usermahasiswa.data',
		'getIndex_usermahasiswa' => 'datatables_usermahasiswa',
	]);
	Route::get('/home/show_users_mahasiswa',function(){
		return view('user_mahasiswa.show_users_mahasiswa');
	});
	Route::post('/home/delete_usermahasiswa','UserController@delete_usermahasiswa');
	Route::get('/home/edit_usermahasiswa/{id}','UserController@edit_usermahasiswa');
	Route::post('/home/update_user_mahasiswa','UserController@update_usermahasiswa');
	//update all user mahasiswa
	Route::get('/home/update_all_mahasiswa','UpdateAllUserMahasiswaController@showform');
	Route::post('/home/update_all_user_mahasiswa','UpdateAllUserMahasiswaController@postUpdate');
	//dosen user register
	Route::get('/home/register_dosen', 'UserController@add_user_dosen');
	Route::post('/home/store_register_user_dosen', 'UserController@store_user_dosen');
	Route::get('/home/show_users_dosen','UserController@show_user_dosen');
	Route::get('/home/getdata_userdosen','UserController@getDataDosen');
	Route::get('/home/edit_users_dosen/{id}','UserController@edit_user_dosen');
	Route::post('/home/update_users_dosen','UserController@update_dosen');
	Route::post('/home/delete_userdosen','UserController@destroy_dosen');
	Route::post('/home/dosen_user_autocomplete','UserController@autocomplete_dosen');
	Route::post('/home/check_iddosen','UserController@check_iddosen');
	//administrator user
	Route::get('/home/show_useradmin','UserController@show_admin');
	Route::get('/home/register_admin', 'UserController@add_user_admin');
	Route::post('/home/store_register_user_admin', 'UserController@store_user_admin');
	Route::get('/home/edit_useradmin/{id}','UserController@edit_admin');
	Route::post('/home/update_useradmin','UserController@update_admin');
	Route::get('/home/data_user_admin','UserController@getDataAdmin');
	Route::post('/home/delete_user_admin','UserController@destroy_admin');
});
Route::group(['middleware' => ['usermahasiswas']],function(){
	Route::get('/home/menu_mahasiswa/{nim}','UserMahasiswaController@index');
	Route::get('/home/menu_mahasiswa/changepassword/{nim}',
	['uses'=>'UserMahasiswaController@changepassword',
	'as'=>'mahasiswa-changepassword']);
	Route::post('/home/mahasiswa/changepasswords','UserMahasiswaController@postchangepassword');
	
	Route::post('/home/mahasiswa/TempUpload','UserMahasiswaController@TempUpload');
	// KRS
	Route::get('/home/addkrs','DaftarKrsController@index');
	Route::get('/home/listkrs','DaftarKrsController@listkrs');
	Route::get('/home/listkrs/{sem}','DaftarKrsController@showkrs');
	Route::get('/home/printkrs/{sem}','DaftarKrsController@printkrs');
	Route::get('/home/datamk/{sem}','DaftarKrsController@datamk');
	Route::get('/home/storekrs','DaftarKrsController@store');
	// KHS
	Route::get('/home/showkhs','KhsController@index');
	Route::get('/home/datakhs/{sem}','KhsController@datakhs');
	Route::get('/home/printkhs/{sem}','KhsController@printkhs');
});
Route::group(['middleware' => ['userdosens']],function(){
	Route::get('/home/menu_dosen/{iddosen}','UserDosenController@index');
	Route::get('/home/menu_dosen/changepassword/{iddosen}',
	['uses'=>'UserDosenController@changepassword',
	'as'=>'dosen-changepassword']);
	Route::post('/home/dosen/changepasswords','UserDosenController@postchangepassword');
	
	Route::post('/home/dosen/TempUpload','UserDosenController@TempUpload');
	//penilaian mahasiswa
	Route::get('/home/addpenilaian','PenilaianController@add');
	Route::post('/home/addpenilaian','PenilaianController@store');
	Route::get('/home/getdatamhs/{kelas}/{sem}/{matkul}','PenilaianController@getdatamhs');
	Route::get('/home/showpenilaian', 'PenilaianController@show');
	Route::get('/home/getdatakhs/{kelas}/{sem}/{matkul}', 'PenilaianController@datakhs');
	Route::get('/home/getsem/{kelas}', 'PenilaianController@getsem');
	Route::get('/home/getmk/{kelas}/{sem}', 'PenilaianController@getmk');
});
