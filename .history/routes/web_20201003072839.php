<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=> false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', App\Http\Livewire\Admin\Dashboard::class)->name('admin.beranda');
    Route::get('/setting', App\Http\Livewire\Admin\Setting::class)->name('admin.setting');
    Route::get('/users/admin', App\Http\Livewire\Admin\Users::class)->name('admin.users.admin');
    Route::get('/users/guru', App\Http\Livewire\Admin\Users::class)->name('admin.users.guru');
    Route::get('/users/siswa', App\Http\Livewire\Admin\Users::class)->name('admin.users.siswa');
    Route::get('/users/ortu', App\Http\Livewire\Admin\Users::class)->name('admin.users.ortu');
    Route::get('/users/export/{level}', [App\Http\Livewire\Admin\Users::class, 'export']);

    Route::get('/biodata/guru', App\Http\Livewire\Admin\Guru::class)->name('admin.biodata.guru');
    Route::get('/biodata/guru/export', [App\Http\Livewire\Admin\Guru::class, 'export']);

    Route::get('/biodata/siswa', App\Http\Livewire\Admin\Siswa::class)->name('admin.biodata.siswa');
    Route::get('/biodata/siswa/export', [App\Http\Livewire\Admin\Siswa::class, 'export']);

    Route::get('/data/jurusan', App\Http\Livewire\Admin\Jurusan::class)->name('admin.data.jurusan');

    Route::get('/data/mapel', App\Http\Livewire\Admin\Mapel::class)->name('admin.data.mapel');
    Route::get('/data/mapel/export', [App\Http\Livewire\Admin\Mapel::class, 'export']);

    Route::get('/data/kelas', App\Http\Livewire\Admin\Kelas::class)->name('admin.data.kelas');
    Route::get('/data/kelas/export/{kelasid}', [App\Http\Livewire\Admin\Kelas::class, 'exportsiswa']);

    Route::get('/data/pembelajaran', App\Http\Livewire\Admin\Pembelajaran::class)->name('admin.data.pembelajaran');

});

Route::group(['prefix' => 'taus', 'middleware' => ['role:taus']], function() {

});

Route::group(['prefix' => 'guru', 'middleware' => ['role:guru']], function() {
    Route::get('/', App\Http\Livewire\Guru\Dashboard::class)->name('guru.beranda');
    Route::get('/kelasonline', App\Http\Livewire\Guru\KelasOnline::class)->name('guru.kelasonline');
    Route::get('/kelasonline/detail/{kelonid}', App\Http\Livewire\Guru\DetailKelasOnline::class);
    Route::get('/pengumuman', App\Http\Livewire\Guru\DetailKelasOnline::class)->name('guru.pengumuman');
});

Route::group(['prefix' => 'siswa', 'middleware' => ['role:siswa']], function() {

});

Route::group(['prefix' => 'ortu', 'middleware' => ['role:ortu']], function() {

});
